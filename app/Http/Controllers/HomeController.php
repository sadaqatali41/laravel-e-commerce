<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        #sliders
        $result['sliders'] = Slider::select(['title', 'short_title', 'description', 'image'])->active()->get();

        $result['promos'] = Category::select(['id', 'name', 'slug', 'image'])
                                    ->with([
                                        'products' => function($q) {
                                            $q->where('status', 'A')->latest()->take(8);
                                        },
                                        'products.attributes' => function($q) {
                                            $q->where('status', 'A');
                                        },
                                    ])
                                    ->where(['is_home' => 1, 'status' => 'A'])
                                    ->get();
        
        $result['brands'] = Brand::select(['name', 'image'])
                                    ->where(['is_home' => 1, 'status' => 'A'])
                                    ->get();
        $result['trending'] = Product::select('id', 'prod_name', 'slug', 'image')
                                        ->with([
                                            'attributes' => function($q) {
                                                return $q->where('status', 'A');
                                            }
                                        ])
                                        ->where('status', 'A')
                                        ->where('is_trending', 1)
                                        ->latest()
                                        ->limit(8)
                                        ->get();
        $result['featured'] = Product::select('id', 'prod_name', 'slug', 'image')
                                        ->with([
                                            'attributes' => function($q) {
                                                return $q->where('status', 'A');
                                            }
                                        ])
                                        ->where('status', 'A')
                                        ->where('is_featured', 1)
                                        ->latest()
                                        ->limit(8)
                                        ->get();
        $result['isPromo'] = Product::select('id', 'prod_name', 'slug', 'image')
                                        ->with([
                                            'attributes' => function($q) {
                                                return $q->where('status', 'A');
                                            }
                                        ])
                                        ->where('status', 'A')
                                        ->where('is_promo', 1)
                                        ->latest()
                                        ->limit(8)
                                        ->get();
        return view('index', $result);
    }
}
