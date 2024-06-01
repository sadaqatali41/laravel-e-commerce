<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Coupon::select(['id', 'title', 'code', 'value', 'type', 'min_order', 'is_one_time', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.coupon.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
                                })
                                ->editColumn('type', function($row){
                                    if($row->type === 'P') {
                                        return 'Percent';
                                    } else {
                                        return 'Value';
                                    }
                                })
                                ->editColumn('is_one_time', function($row){
                                    if($row->is_one_time === 1) {
                                        return 'Yes';
                                    } else {
                                        return 'No';
                                    }
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
        return view('admin.coupon.coupans', [
            'exp' => 'index',
            'title' => 'Manage Coupan'
        ]);
    }

    public function create()
    {
        return view('admin.coupon.coupans', [
            'exp' => 'create',
            'title' => 'Create Coupan'
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $this->validate($request, [
            'title' => 'required',
            'code' => 'required|unique:coupons,code',
            'value' => 'required',
            'type' => 'required',
            'min_order' => 'required',
            'is_one_time' => 'required',
            'status' => 'required',
        ]);

        $formFields['created_by'] = Auth::guard('admin')->user()->id;
        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        Coupon::create($formFields);

        return redirect()->back()->with('success', 'Coupon is created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', [
            'coupon' => $coupon,
            'exp' => 'edit',
            'title' => 'Update Coupan'
        ]);
    }

    public function update(Request $request, Coupon $coupon)
    {
        $formFields = $this->validate($request, [
            'title' => 'required',
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'value' => 'required',
            'type' => 'required',
            'min_order' => 'required',
            'is_one_time' => 'required',
            'status' => 'required',
        ]);

        $formFields['updated_by'] = Auth::guard('admin')->user()->id;

        $coupon->update($formFields);

        return redirect()->back()->with('success', 'Coupon is updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
