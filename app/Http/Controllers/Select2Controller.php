<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Select2Controller extends Controller
{
    public function category(Request $request)
    {
        $term = trim($request->term);
        $categories = DB::table('categories')
            ->select('id', 'name as text')
            ->where('name', 'LIKE',  '%' . $term . '%')
            ->where('status', 'A')
            ->orderBy('name', 'asc')->simplePaginate(10);

        $morePages = true;
        if (empty($categories->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $categories->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return $results;
    }
    public function subcategory(Request $request)
    {
        $search = trim($request->input('term'));
        $category_id = trim($request->input('category_id'));
        
        $results = DB::table('sub_categories')
                    ->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id')
                    ->select(
                        'categories.name as category_name',
                        'sub_categories.id as sub_category_id',
                        'sub_categories.name as sub_category_name'
                    )
                    ->where('sub_categories.status', '=', 'A')
                    ->when($category_id, function($query) use ($category_id){
                        return $query->where('sub_categories.category_id', $category_id);
                    })
                    ->when($search, function ($query) use ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('categories.name', 'like', "%{$search}%")
                              ->orWhere('sub_categories.name', 'like', "%{$search}%");
                        });
                    })
                    ->paginate(10);

        $formattedResults = [];

        foreach ($results as $result) {
            $formattedResults[] = [
                'id' => $result->sub_category_id,
                'text' => $result->category_name . ' - ' . $result->sub_category_name
            ];
        }

        return response()->json([
            'results' => $formattedResults,
            'pagination' => [
                'more' => $results->hasMorePages()
            ]
        ]);
    }

    public function size(Request $request)
    {
        $term = trim($request->term);
        $sizes = DB::table('sizes')
            ->select('id', 'size as text')
            ->where('size', 'LIKE',  '%' . $term . '%')
            ->where('status', 'A')
            ->orderBy('size', 'asc')->simplePaginate(10);

        $morePages = true;
        if (empty($sizes->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $sizes->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return $results;
    }
    public function color(Request $request)
    {
        $term = trim($request->term);
        $colors = DB::table('colors')
            ->select('id', 'color as text')
            ->where('color', 'LIKE',  '%' . $term . '%')
            ->where('status', 'A')
            ->orderBy('color', 'asc')->simplePaginate(10);

        $morePages = true;
        if (empty($colors->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $colors->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return $results;
    }

    public function brand(Request $request)
    {
        $term = trim($request->term);
        $brands = DB::table('brands')
            ->select('id', 'name as text')
            ->where('name', 'LIKE',  '%' . $term . '%')
            ->where('status', 'A')
            ->orderBy('name', 'asc')->simplePaginate(10);

        $morePages = true;
        if (empty($brands->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $brands->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return $results;
    }

    public function tax(Request $request)
    {
        $term = trim($request->term);
        $taxes = DB::table('taxes')
            ->select('id', 'tax_desc as text')
            ->where('tax_desc', 'LIKE',  '%' . $term . '%')
            ->where('status', 'A')
            ->orderBy('tax_desc', 'asc')->simplePaginate(10);

        $morePages = true;
        if (empty($taxes->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $taxes->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return $results;
    }

    public function user(Request $request)
    {
        $term = trim($request->term);
        $users = DB::table('users')
            ->select('id', 'name as text')
            ->where('name', 'LIKE',  '%' . $term . '%')
            ->where('status', 'A')
            ->orderBy('name', 'asc')
            ->simplePaginate(10);

        $morePages = true;
        if (empty($users->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $users->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return $results;
    }
    public function product(Request $request)
    {
        $search = trim($request->input('term'));
        
        $results = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->select(
                        'categories.name as category_name',
                        'products.id',
                        'products.prod_name'
                    )
                    ->when($search, function ($query) use ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('categories.name', 'like', "%{$search}%")
                            ->orWhere('products.prod_name', 'like', "%{$search}%");
                        });
                    })
                    ->where('products.status', '=', 'A')
                    ->paginate(10);

        $formattedResults = [];

        foreach ($results as $result) {
            $formattedResults[] = [
                'id' => $result->id,
                'text' => $result->category_name . ' - ' . $result->prod_name
            ];
        }

        return response()->json([
            'results' => $formattedResults,
            'pagination' => [
                'more' => $results->hasMorePages()
            ]
        ]);
    }
}
