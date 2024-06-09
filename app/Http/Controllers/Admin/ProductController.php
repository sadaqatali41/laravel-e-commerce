<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ProductAttribute;
use App\Models\Admin\ProductImage;
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
            'tech_spec' => 'required',
            'used_for' => 'required',
            'warranty' => 'required',
            'lead_time' => 'required',
            'tax' => 'required',
            'tax_type' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sku_no.*' => 'required',
            'mrp.*' => 'required',
            'price.*' => 'required',
            'qty.*' => 'required',
            'image_attr' => 'required',
            'image_attr.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'category_id.required' => 'Category name is required.',
            'prod_name.required' => 'Product Name is required.',
            'brand_id.required' => 'Brand Name is required.',
            'brand_id.integer' => 'Brand Name must be an integer.',
            'model_id.required' => 'Model Name is required.',
            'model_id.integer' => 'Model Name must be an integer.',
            'short_desc.required' => 'Short Description is required.',
            'tech_spec.required' => 'Technical Specification is required.',
            'used_for.required' => 'Uses is required.',
            'sku_no.*.required' => 'SKU No is required.',
            'mrp.*.required' => 'MRP is required.',
            'price.*.required' => 'Price is required.',
            'qty.*.required' => 'Quantity is required.',
            'image_attr.required' => 'Image is required.',
            'image_attr.*.image' => 'File must be an Image.'
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
            'tech_spec' => $request->tech_spec,
            'used_for' => $request->used_for,
            'warranty' => $request->warranty,
            'lead_time' => $request->lead_time,
            'tax' => $request->tax,
            'tax_type' => $request->tax_type,
            'is_promo' => $request->is_promo,
            'is_featured' => $request->is_featured,
            'is_discounted' => $request->is_discounted,
            'is_trending' => $request->is_trending,
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        $imageHashName = $request->file('image')->hashName();
        $filePath = $request->file('image')->storeAs('product', $imageHashName, 'public');
        $formFields['image'] = $imageHashName;

        $product = Product::create($formFields);
        $product_id = $product->id;

        #product attributes
        $skuArr = $request->sku_no;

        foreach($skuArr as $key => $value) {
            $productAttr['product_id'] = $product_id;
            $productAttr['sku_no'] = $request->sku_no[$key];
            $productAttr['mrp'] = $request->mrp[$key];
            $productAttr['price'] = $request->price[$key];
            $productAttr['qty'] = $request->qty[$key];
            $productAttr['size_id'] = $request->size_id[$key];
            $productAttr['color_id'] = $request->color_id[$key];

            if($request->hasFile('image_attr.' . $key)) {
                $imageHashName = $request->file('image_attr.' . $key)->hashName();
                $filePath = $request->file('image_attr.' . $key)->storeAs('product/product_attr', $imageHashName, 'public');
                $productAttr['image'] = $imageHashName;
            }
            ProductAttribute::create($productAttr);
        }

        #product child images
        if($request->hasFile('images')) {
            $images = $request->file('images');
            foreach($images as $singleImage) {
                $imageHashName = $singleImage->hashName();
                $filePath = $singleImage->storeAs('product', $imageHashName, 'public');
                $productImage['product_id'] = $product_id;
                $productImage['image'] = $imageHashName;

                ProductImage::create($productImage);
            }
        }

        return redirect()->back()->with('success', 'Product is created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $product->load(['category', 'attributes', 'images', 'brand']);
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
            'tech_spec' => 'required',
            'used_for' => 'required',
            'warranty' => 'required',
            'lead_time' => 'required',
            'tax' => 'required',
            'tax_type' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'sku_no.*' => 'required',
            'mrp.*' => 'required',
            'price.*' => 'required',
            'qty.*' => 'required',
            'image_attr.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'category_id.required' => 'Category name is required.',
            'prod_name.required' => 'Product Name is required.',
            'brand_id.required' => 'Brand Name is required.',
            'brand_id.integer' => 'Brand Name must be an integer.',
            'model_id.required' => 'Model Name is required.',
            'model_id.integer' => 'Model Name must be an integer.',
            'short_desc.required' => 'Short Description is required.',
            'tech_spec.required' => 'Technical Specification is required.',
            'used_for.required' => 'Uses is required.',
            'sku_no.*.required' => 'SKU No is required.',
            'mrp.*.required' => 'MRP is required.',
            'price.*.required' => 'Price is required.',
            'qty.*.required' => 'Quantity is required.',
            'image_attr.*.image' => 'File must be an Image.'
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
            'tech_spec' => $request->tech_spec,
            'used_for' => $request->used_for,
            'warranty' => $request->warranty,
            'lead_time' => $request->lead_time,
            'tax' => $request->tax,
            'tax_type' => $request->tax_type,
            'is_promo' => $request->is_promo,
            'is_featured' => $request->is_featured,
            'is_discounted' => $request->is_discounted,
            'is_trending' => $request->is_trending,
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

        #product attributes
        $skuArr = $request->sku_no;

        foreach($skuArr as $key => $value) {
            $productAttr['product_id'] = $product->id;
            $productAttr['sku_no'] = $request->sku_no[$key];
            $productAttr['mrp'] = $request->mrp[$key];
            $productAttr['price'] = $request->price[$key];
            $productAttr['qty'] = $request->qty[$key];
            $productAttr['size_id'] = $request->size_id[$key];
            $productAttr['color_id'] = $request->color_id[$key];
            $attr_id = $request->attr_id[$key];

            if($request->hasFile('image_attr.' . $key)) {
                $imageHashName = $request->file('image_attr.' . $key)->hashName();
                $filePath = $request->file('image_attr.' . $key)->storeAs('product/product_attr', $imageHashName, 'public');
                $productAttr['image'] = $imageHashName;
            }
            if(empty($attr_id)) {
                ProductAttribute::create($productAttr);
            } else {
                ProductAttribute::where(['id' => $attr_id])->update($productAttr);
            }
        }

        #product child images
        if($request->hasFile('images')) {
            $images = $request->file('images');
            foreach($images as $singleImage) {
                $imageHashName = $singleImage->hashName();
                $filePath = $singleImage->storeAs('product', $imageHashName, 'public');
                $productImage['product_id'] = $product->id;
                $productImage['image'] = $imageHashName;

                ProductImage::create($productImage);
            }
        }

        return redirect()->back()->with('success', 'Product is updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
