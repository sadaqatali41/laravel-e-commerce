<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = SubCategory::select(['id', 'category_id', 'name', 'slug', 'image', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->editColumn('category_id', function($row){
                                    return $row->category->name;
                                })
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.subcategory.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
                                })
                                ->editColumn('status', function($row){
                                    if($row->status === 'A') {
                                        return '<span class="badge badge-success">Active</span>';
                                    } else {
                                        return '<span class="badge badge-danger">Inactive</span>';
                                    }
                                })
                                ->editColumn('image', function($row){
                                    if(isset($row->image)) {
                                        return '<img src="'.asset('storage/subcategory/' . $row->image).'" class="img-40 img-radius">';
                                    } else {
                                        return 'NA';
                                    }
                                })
                                ->filter(function($query) use ($request){
                                    if($request->category_id) {
                                        $query->where('category_id', $request->category_id);
                                    }
                                    if($request->status) {
                                        $query->where('status', $request->status);
                                    }
                                }) 
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.subcategory.subcategories', [
            'exp'=> 'index',
            'title' => 'Manage Sub Category'
        ]);
    }

    public function create()
    {
        return view('admin.subcategory.subcategories', [
            'exp' => 'create',
            'title' => 'Create Sub Category'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories,name',
            'slug' => 'required|unique:sub_categories,slug',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'category_id.required' => 'Category name is required'
        ]);

        $formFields = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        $imageHashName = $request->file('image')->hashName();
        $filePath = $request->file('image')->storeAs('subcategory', $imageHashName, 'public');
        $formFields['image'] = $imageHashName;

        SubCategory::create($formFields);

        session()->flash('success', 'Sub Category is created successfully.');

        return response()->json(['success' => true], 200);
    }

    public function show(SubCategory $subCategory)
    {
        //
    }

    public function edit(SubCategory $subcategory)
    {
        $subcategory->load('category');
        return view('admin.subcategory.subcategories', [
            'subcategory' => $subcategory,
            'exp' => 'edit',
            'title' => 'Update Sub Category'
        ]);
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories,name,' . $subcategory->id,
            'slug' => 'required|unique:sub_categories,slug,' . $subcategory->id,
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'category_id.required'=> 'Category name is required'
        ]);

        $formFields = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        if($request->hasFile('image')) {
            $imageHashName = $request->file('image')->hashName();
            $filePath = $request->file('image')->storeAs('subcategory', $imageHashName, 'public');
            $formFields['image'] = $imageHashName;

            #delete old file
            if(!empty($subcategory->image) && $filePath) {
                if(Storage::disk('public')->exists('subcategory/'. $subcategory->image)) {
                    Storage::disk('public')->delete('subcategory/' . $subcategory->image);
                }
            }
        }

        $subcategory->update($formFields);

        session()->flash('success', 'Sub Category is updated successfully.');

        return response()->json(['success' => true], 200);
    }

    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
