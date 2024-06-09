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
}
