<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $result['promos'] = Category::select(['id', 'name', 'slug', 'image'])
                                    ->where(['is_home' => 1, 'status' => 'A'])
                                    ->get();
        $result['brands'] = Brand::select(['name', 'image'])
                                    ->where(['is_home' => 1, 'status' => 'A'])
                                    ->get();
        return view('index', $result);
    }
}
