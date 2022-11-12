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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.subcategory.subcategory', [
            'exp'=> 'index',
            'title' => 'Manage Sub Category'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategory.subcategory', [
            'exp' => 'create',
            'title' => 'Create Sub Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back()->with('success', 'Sub Category is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $subcategory->load('category');
        return view('admin.subcategory.subcategory', [
            'subcategory' => $subcategory,
            'exp' => 'edit',
            'title' => 'Update Sub Category'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back()->with('success', 'SUb Category is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
