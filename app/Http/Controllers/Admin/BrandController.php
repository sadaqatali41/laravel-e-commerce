<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Brand;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Brand::select(['id', 'name', 'image', 'is_home', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.brand.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
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
                                        return '<img src="'.asset('storage/brand/' . $row->image).'" class="img-40 img-radius">';
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
                                }) 
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.brand.brands', [
            'exp' => 'index',
            'title' => 'Manage Brand'
        ]);
    }

    public function create()
    {
        return view('admin.brand.brands', [
            'exp' => 'create',
            'title' => 'Create Brand'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands,name',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $formFields = [
            'name' => $request->name,
            'status' => $request->status,
            'is_home' => $request->is_home,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        $imageHashName = $request->file('image')->hashName();
        $filePath = $request->file('image')->storeAs('brand', $imageHashName, 'public');
        $formFields['image'] = $imageHashName;

        Brand::create($formFields);

        session()->flash('success', 'Brand is created successfully.');

        return response()->json(['success' => true], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.brands', [
            'brand' => $brand,
            'exp' => 'edit',
            'title' => 'Update Brand'
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands,name,' . $brand->id,
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $formFields = [
            'name' => $request->name,
            'status' => $request->status,
            'is_home' => $request->is_home,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        if($request->hasFile('image')) {
            $imageHashName = $request->file('image')->hashName();
            $filePath = $request->file('image')->storeAs('brand', $imageHashName, 'public');
            $formFields['image'] = $imageHashName;

            #delete old file
            if(!empty($brand->image) && $filePath) {
                if(Storage::disk('public')->exists('brand/'. $brand->image)) {
                    Storage::disk('public')->delete('brand/' . $brand->image);
                }
            }
        }

        $brand->update($formFields);

        session()->flash('success', 'Brand is updated successfully.');

        return response()->json(['success' => true], 200);
    }

    public function destroy($id)
    {
        //
    }
}
