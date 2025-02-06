<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ProductReviewController extends Controller
{
    public function index(Request $request) 
    {
        if($request->ajax()) {
            $data = ProductReview::with('user', 'product')
                                ->select(['id', 'user_id', 'product_id', 'rating', 'review', 'created_at', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->editColumn('user_id', function($row){
                                    return $row->user->name;
                                })
                                ->editColumn('product_id', function($row){
                                    $productDtl = $row->product;
                                    return '<a href="'. route('product.list', $productDtl->slug) .'" target="_blank">'. $productDtl->prod_name .'</a>';
                                })
                                ->addColumn('manage', function($row){
                                    if($row->status == 'A') {
                                        return '<button type="button" class="btn btn-link btn-sm mark_as" data-id="'. $row->id .'" data-s="I">Mark as Inactive</button>';
                                    } else {
                                        return '<button type="button" class="btn btn-link btn-sm mark_as" data-id="'. $row->id .'" data-s="A">Mark as Active</button>';
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
        return view('admin.product.product_review', [
            'exp' => 'index',
            'title' => 'Manage Product Review',
        ]);
    }
}
