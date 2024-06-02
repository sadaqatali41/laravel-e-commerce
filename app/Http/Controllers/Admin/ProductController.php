<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Product::select(['id', 'prod_name', 'category_id', 'slug', 'image', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->editColumn('category_id', function($row){
                                    return $row->category->name;
                                })
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.product.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
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
                                        return '<img src="'.asset('storage/product/' . $row->image).'" class="img-40 img-radius">';
                                    } else {
                                        return 'NA';
                                    }
                                })
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.product.products', [
            'exp' => 'index',
            'title' => 'Manage Product'
        ]);
    }

    public function create()
    {
        return view('admin.product.products', [
            'exp' => 'create',
            'title' => 'Create Product'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'prod_name' => 'required|unique:products,prod_name',
            'slug' => 'required|unique:products,slug',
            'brand_id' => 'required|integer',
            'model_id' => 'required|integer',
            'keywords' => 'required',
            'description' => 'required',
            'short_desc' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'category_id.required' => 'Category name is required.',
            'prod_name.required' => 'Product Name is required.',
            'brand_id.required' => 'Brand Name is required.',
            'brand_id.integer' => 'Brand Name must be an integer.',
            'model_id.required' => 'Model Name is required.',
            'model_id.integer' => 'Model Name must be an integer.',
            'short_desc.required' => 'Short Description is required.'
        ]);

        $formFields = [
            'category_id' => $request->category_id,
            'prod_name' => $request->prod_name,
            'slug' => Str::slug($request->slug),
            'brand_id' => $request->brand_id,
            'model_id' => $request->model_id,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'short_desc' => $request->short_desc,
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        $imageHashName = $request->file('image')->hashName();
        $filePath = $request->file('image')->storeAs('product', $imageHashName, 'public');
        $formFields['image'] = $imageHashName;

        Product::create($formFields);

        return redirect()->back()->with('success', 'Product is created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $product->load('category');
        return view('admin.product.products', [
            'product' => $product,
            'exp' => 'edit',
            'title' => 'Update Product'
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'prod_name' => 'required|unique:products,prod_name,' . $product->id,
            'slug' => 'required|unique:products,slug,' . $product->id,
            'brand_id' => 'required|integer',
            'model_id' => 'required|integer',
            'keywords' => 'required',
            'description' => 'required',
            'short_desc' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'category_id.required' => 'Category name is required.',
            'prod_name.required' => 'Product Name is required.',
            'brand_id.required' => 'Brand Name is required.',
            'brand_id.integer' => 'Brand Name must be an integer.',
            'model_id.required' => 'Model Name is required.',
            'model_id.integer' => 'Model Name must be an integer.',
            'short_desc.required' => 'Short Description is required.'
        ]);

        $formFields = [
            'category_id' => $request->category_id,
            'prod_name' => $request->prod_name,
            'slug' => Str::slug($request->slug),
            'brand_id' => $request->brand_id,
            'model_id' => $request->model_id,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'short_desc' => $request->short_desc,
            'status' => $request->status,
            'updated_by' => Auth::guard('admin')->user()->id
        ];

        if($request->hasFile('image')) {
            $imageHashName = $request->file('image')->hashName();
            $filePath = $request->file('image')->storeAs('product', $imageHashName, 'public');
            $formFields['image'] = $imageHashName;

            #delete old file
            if(!empty($product->image) && $filePath) {
                if(Storage::disk('public')->exists('product/'. $product->image)) {
                    Storage::disk('public')->delete('product/' . $product->image);
                }
            }
        }

        $product->update($formFields);

        return redirect()->back()->with('success', 'Product is updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
