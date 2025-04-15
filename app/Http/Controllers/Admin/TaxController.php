<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Taxes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Taxes::select(['id', 'tax_per', 'tax_desc', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.tax.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
                                })
                                ->editColumn('status', function($row){
                                    if($row->status === 'A') {
                                        return '<span class="badge badge-success">Active</span>';
                                    } else {
                                        return '<span class="badge badge-danger">Inactive</span>';
                                    }
                                })
                                ->filter(function($query) use ($request) {
                                    if($request->status) {
                                        $query->where('status', $request->status);
                                    }
                                }, true)
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
                                ->make(true);
        }
        return view('admin.tax.taxes', [
            'exp' => 'index',
            'title' => 'Manage Taxes'
        ]);
    }

    public function create()
    {
        return view('admin.tax.taxes', [
            'exp' => 'create',
            'title' => 'Create Tax'
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $this->validate($request, [
            'tax_per' => 'required|integer|unique:taxes,tax_per',
            'tax_desc' => 'required',
            'status' => 'required',
        ]);

        $formFields['created_by'] = Auth::guard('admin')->user()->id;
        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        Taxes::create($formFields);

        session()->flash('success', 'Tax is created successfully.');

        return response()->json(['success' => true], 200);
    }

    public function show(Taxes $tax)
    {
        //
    }

    public function edit(Taxes $tax)
    {
        return view('admin.tax.taxes', [
            'tax' => $tax,
            'exp' => 'edit',
            'title' => 'Update Tax'
        ]);
    }

    public function update(Request $request, Taxes $tax)
    {
        $formFields = $this->validate($request, [
            'tax_per' => 'required|integer|unique:taxes,tax_per,' . $tax->id,
            'tax_desc' => 'required',
            'status' => 'required',
        ]);

        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        $tax->update($formFields);

        session()->flash('success', 'Tax is updated successfully.');

        return response()->json(['success' => true], 200);
    }

    public function destroy(Taxes $tax)
    {
        //
    }
}