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
            $data = Order::with('user')->select('*');
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
                                ->editColumn('user_id', function($row){
                                    return $row->user->name;
                                })  
                                ->filter(function($query){
                                    if(request('user_id')) {
                                        $query->where('user_id', request('user_id'));
                                    }
                                    if(request('order_status')) {
                                        $query->where('order_status', request('order_status'));
                                    }
                                    if(request('payment_status')) {
                                        $query->where('payment_status', request('payment_status'));
                                    }
                                    if(request('payment_type')) {
                                        $query->where('payment_type', request('payment_type'));
                                    }
                                }, true)                            
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
        $this->validate($request, [            
            'trackings' => 'required|string|max:100',
        ], [            
            'trackings.required' => 'Tracking Detail is required',            
            'trackings.string' => 'Tracking Detail should be string',            
            'trackings.max' => 'Tracking Detail should <= 100 chars',
        ]);

        $order_id = $request->order_id;
        $order = Order::find($order_id);

        $order->trackings()->create([            
            'trackings' => $request->trackings,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order tracking added successfully',
        ]);
    }

    public function edit($id)
    {
        $order = Order::with([
                            'orderDetails.product',
                            'orderDetails.productAttribute.color',
                            'orderDetails.productAttribute.size',
                            'trackings' => function($q) {
                                return $q->oldest();
                            }
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
