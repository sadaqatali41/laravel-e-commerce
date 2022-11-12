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
}
