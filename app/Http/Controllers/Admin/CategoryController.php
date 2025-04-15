<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Category::select(['id', 'name', 'slug', 'image', 'is_home', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.category.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
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
                                        return '<img src="'.asset('storage/category/' . $row->image).'" class="img-40 img-radius">';
                                    } else {
                                        return 'NA';
                                    }
                                })
                                ->editColumn('is_home', function($row){
                                    if($row->is_home === 1) {
                                        return 'Yes';
                                    } else {
                                        return 'No';
                                    }
                                        
                                })
                                ->filter(function($query) use ($request){
                                    $array = [0, 1];
                                    if(Arr::has($array, $request->is_home)) {
                                        $query->where('is_home', $request->is_home);
                                    }
                                    if($request->status) {
                                        $query->where('status', $request->status);
                                    }
                                }, true) 
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.category.categories', [
            'exp' => 'index',
            'title' => 'Manage Category'
        ]);
    }

    public function create()
    {
        return view('admin.category.categories', [
            'exp' => 'create',
            'title' => 'Create Category'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $formFields = [
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'is_home' => $request->is_home,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        $imageHashName = $request->file('image')->hashName();
        $filePath = $request->file('image')->storeAs('category', $imageHashName, 'public');
        $formFields['image'] = $imageHashName;

        Category::create($formFields);

        session()->flash('success', 'Category is created successfully.');

        return response()->json(['success' => true], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.category.categories', [
            'category' => $category,
            'exp' => 'edit',
            'title' => 'Update Category'
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required|unique:categories,slug,' . $category->id,
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $formFields = [
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'is_home' => $request->is_home,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        if($request->hasFile('image')) {
            $imageHashName = $request->file('image')->hashName();
            $filePath = $request->file('image')->storeAs('category', $imageHashName, 'public');
            $formFields['image'] = $imageHashName;

            #delete old file
            if(!empty($category->image) && $filePath) {
                if(Storage::disk('public')->exists('category/'. $category->image)) {
                    Storage::disk('public')->delete('category/' . $category->image);
                }
            }
        }

        $category->update($formFields);

        session()->flash('success', 'Category is updated successfully.');

        return response()->json(['success' => true], 200);
    }

    public function destroy($id)
    {
        //
    }
}
