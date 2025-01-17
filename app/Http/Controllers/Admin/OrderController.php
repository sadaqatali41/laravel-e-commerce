<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Order::select('*');
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->editColumn('id', function($row){
                                    return '<a href="'.route('admin.order.edit', $row->id).'">'. $row->id .'</a>';
                                })
                                ->editColumn('name', function($row){
                                    return $row->name . '<br>' . $row->email . '<br>' . $row->mobile . '<br>' . $row->address . ',' . $row->city . ',' . $row->state . ',' . $row->pincode;
                                })
                                ->editColumn('order_status', function($row){
                                    if($row->order_status === 1) {
                                        return '<span class="badge badge-warning">Placed</span>';
                                    } else if($row->order_status === 2) {
                                        return '<span class="badge badge-info">On the way</span>';
                                    } else {
                                        return '<span class="badge badge-success">Deliverd</span>';
                                    }
                                })
                                ->editColumn('payment_status', function($row){
                                    if($row->payment_status == 'PENDING') {
                                        return '<span class="badge badge-info">Pending</span>';
                                    } else if($row->payment_status == 'SUCCESS') {
                                        return '<span class="badge badge-success">Success</span>';
                                    } else {
                                        return '<span class="badge badge-danger">Failed</span>';
                                    }
                                })
                                ->editColumn('payment_type', function($row){
                                    if($row->payment_type == 'GT') {
                                        return 'Online';
                                    } else {
                                        return 'COD';
                                    }
                                })                                
                                ->escapeColumns([])
                                ->make(true);
        }
        return view('admin.order.order', [
            'exp' => 'index',
            'title' => 'Manage Orders'
        ]);
    }
}
