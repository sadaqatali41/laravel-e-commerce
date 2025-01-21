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
                                    $address = '';
                                    $address .= '<p class="mb-0">'. $row->name .'</p>';
                                    $address .= '<p class="mb-0"><small>'. $row->email .'</small></p>';
                                    $address .= '<p class="mb-0"><small>'. $row->mobile .'</small></p>';
                                    $address .= '<p class="mb-0"><small>'. $row->city .', '. $row->state .', '. $row->pincode .'</small></p>';

                                    return $address;
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

    public function store(Request $request)
    {
        
    }

    public function edit($id)
    {
        $order = Order::with([
                            'orderDetails.product',
                            'orderDetails.productAttribute.color',
                            'orderDetails.productAttribute.size',
                        ])
                        ->where([
                            'id' => $id
                        ])
                        ->first();
        return view('admin.order.order')->with([
            'exp' => 'edit',
            'title' => 'Edit Order',
            'order' => $order,

        ]);
    }

    public function update(Request $request, Order $order) {
        $column_name = $request->column_name;
        $column_val = $request->column_val;
        
        $order->update([$column_name => $column_val]);

        return response()->json([
            'status' => 'success',
            'message' => $column_name == 'order_status' ? 'Order Status is updated' : 'Payment Status is updated'
        ]);
    }
}
