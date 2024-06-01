<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Color::select(['id', 'color', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.color.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
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
        return view('admin.color.colors', [
            'exp' => 'index',
            'title' => 'Manage Color'
        ]);
    }

    public function create()
    {
        return view('admin.color.colors', [
            'exp' => 'create',
            'title' => 'Create Color'
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $this->validate($request, [
            'color' => 'required|unique:colors,color',
            'status' => 'required',
        ]);

        $formFields['created_by'] = Auth::guard('admin')->user()->id;
        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        Color::create($formFields);

        return redirect()->back()->with('success', 'Color is created successfully.');
    }

    public function show(Color $color)
    {
        //
    }

    public function edit(Color $color)
    {
        return view('admin.color.colors', [
            'color' => $color,
            'exp' => 'edit',
            'title' => 'Update Color'
        ]);
    }

    public function update(Request $request, Color $color)
    {
        $formFields = $this->validate($request, [
            'color' => 'required|unique:colors,color,' . $color->id,
            'status' => 'required',
        ]);

        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        $color->update($formFields);

        return redirect()->back()->with('success', 'Color is updated successfully.');
    }

    public function destroy(Color $color)
    {
        //
    }
}
