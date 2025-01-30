<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

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
