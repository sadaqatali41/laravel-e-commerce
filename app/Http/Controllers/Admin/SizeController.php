<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Size::select(['id', 'size', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.size.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
                                })
                                ->editColumn('status', function($row){
                                    if($row->status === 'A') {
                                        return '<span class="badge badge-success">Active</span>';
                                    } else {
                                        return '<span class="badge badge-danger">Inactive</span>';
                                    }
                                })                                
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.size.sizes', [
            'exp' => 'index',
            'title' => 'Manage Size'
        ]);
    }

    public function create()
    {
        return view('admin.size.sizes', [
            'exp' => 'create',
            'title' => 'Create Size'
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $this->validate($request, [
            'size' => 'required|unique:sizes,size',
            'status' => 'required',
        ]);

        $formFields['created_by'] = Auth::guard('admin')->user()->id;
        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        Size::create($formFields);

        return redirect()->back()->with('success', 'Size is created successfully.');
    }

    public function show(Size $size)
    {
        //
    }

    public function edit(Size $size)
    {
        return view('admin.size.sizes', [
            'size' => $size,
            'exp' => 'edit',
            'title' => 'Update Size'
        ]);
    }

    public function update(Request $request, Size $size)
    {
        $formFields = $this->validate($request, [
            'size' => 'required|unique:sizes,size,' . $size->id,
            'status' => 'required',
        ]);

        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        $size->update($formFields);

        return redirect()->back()->with('success', 'Size is updated successfully.');
    }

    public function destroy(Size $size)
    {
        //
    }
}
