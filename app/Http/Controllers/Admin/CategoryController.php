<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Category::select(['id', 'name', 'slug', 'image', 'status']);
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
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $formFields = [
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        $imageHashName = $request->file('image')->hashName();
        $filePath = $request->file('image')->storeAs('category', $imageHashName, 'public');
        $formFields['image'] = $imageHashName;

        Category::create($formFields);

        return redirect()->back()->with('success', 'Category is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back()->with('success', 'Category is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
