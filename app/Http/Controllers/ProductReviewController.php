<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|integer',
            'rating' => 'required|integer',
            'product_review' => 'required|string',
        ], [
            'product_id.required' => 'Product ID is required',
            'product_id.integer' => 'Product ID must be an integer',
            'rating.required' => 'Rating is required',
            'rating.integer' => 'Rating must be an integer',
            'product_review.required' => 'Review is required',
            'product_review.string' => 'Review must be a string',
        ]);

        if(!auth('web')->check()) {
            return response()->json([
                'errors' => [
                    'product_review' => ['You must be logged-in to create a review.'],
                ]
            ], 422);
        }
        $user_id = auth()->id();

        // Validate whether product is purchased or not
        $orders = DB::table('orders as o')
                    ->join('order_details as od', function ($join) use ($request){
                        $join->on('od.order_id', '=', 'o.id')
                            ->where('od.product_id', '=', $request->product_id);
                    })
                    ->where('o.user_id', '=', $user_id)
                    ->select('o.user_id', 'o.name', 'od.product_id', 'od.product_attribute_id', 'od.quantity')
                    ->first();
        if(!$orders) {
            return response()->json([
                'errors' => [
                    'product_review' => ['Sorry you can not give your thoughts for this product.'],
                ]
            ], 422);
        }
        $formField = [
            'product_id' => $request->input('product_id'),
            'rating' => $request->input('rating'),
            'review' => $request->input('product_review'),
            'user_id' => $user_id,
        ];

        ProductReview::create($formField);

        return response()->json([
            'status' => 'success',
            'message' => 'Review created successfully',
        ], 200);
    }

    public function show(ProductReview $productReview)
    {
        //
    }

    public function edit(ProductReview $productReview)
    {
        //
    }

    public function update(Request $request, ProductReview $productReview)
    {
        //
    }

    public function destroy(ProductReview $productReview)
    {
        //
    }
}
