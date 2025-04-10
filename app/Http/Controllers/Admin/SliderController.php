<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Slider::with('category')
                            ->select(['id', 'category_id', 'title', 'short_title', 'image', 'description', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.slider.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
                                })
                                ->editColumn('category_id', function($row){
                                    return $row->category->name ?? '';
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
                                        return '<img src="'.asset('storage/slider/' . $row->image).'" class="img-40 img-radius">';
                                    } else {
                                        return 'NA';
                                    }
                                })                                
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.slider.sliders', [
            'exp' => 'index',
            'title' => 'Manage Slider'
        ]);
    }

    public function create()
    {
        return view('admin.slider.sliders', [
            'exp' => 'create',
            'title' => 'Create Slider'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|numeric',
            'title' => 'required|max:30',
            'short_title' => 'required|max:20',
            'description' => 'required|max:80',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:width=1920,min_height=700'
        ]);

        $formFields = [
            'title' => $request->title,            
            'short_title' => $request->short_title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'created_by' => Auth::guard('admin')->user()->id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        $imageHashName = $request->file('image')->hashName();
        $filePath = $request->file('image')->storeAs('slider', $imageHashName, 'public');
        $formFields['image'] = $imageHashName;

        Slider::create($formFields);

        session()->flash('success', 'Slider is created successfully.');

        return response()->json(['success' => true], 200);
    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit(Slider $slider)
    {
        $slider->load('category');
        return view('admin.slider.sliders', [
            'slider' => $slider,
            'exp' => 'edit',
            'title' => 'Update Slider'
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'category_id' => 'required|numeric',
            'title' => 'required|max:30',
            'short_title' => 'required|max:20',
            'description' => 'required|max:80',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=1920,min_height=700'
        ]);

        $formFields = [
            'title' => $request->title,            
            'short_title' => $request->short_title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'updated_by' => Auth::guard('admin')->user()->id,
        ];

        if($request->hasFile('image')) {
            $imageHashName = $request->file('image')->hashName();
            $filePath = $request->file('image')->storeAs('slider', $imageHashName, 'public');
            $formFields['image'] = $imageHashName;

            #delete old file
            if(!empty($slider->image) && $filePath) {
                if(Storage::disk('public')->exists('slider/'. $slider->image)) {
                    Storage::disk('public')->delete('slider/' . $slider->image);
                }
            }
        }

        $slider->update($formFields);

        session()->flash('success', 'Slider is updated successfully.');

        return response()->json(['success' => true], 200);
    }

    public function destroy(Slider $slider)
    {
        //
    }
}
