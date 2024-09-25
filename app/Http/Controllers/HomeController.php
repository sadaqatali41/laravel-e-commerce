<?php

namespace App\Http\Controllers;

use App\Models\Admin\Brand;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index() 
    {
        $seconds = 120;

        $result['sliders'] = Cache::remember('sliders', $seconds, function(){
            return Slider::select(['title', 'short_title', 'description', 'image'])
                        ->active()
                        ->get();
        });

        $result['promos'] = Cache::remember('promos', $seconds, function(){
            return Category::select(['id', 'name', 'slug', 'image'])
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
        });
        
        $result['brands'] = Cache::remember('brands', $seconds, function(){
            return Brand::select(['name', 'image'])
                        ->where(['is_home' => 1, 'status' => 'A'])
                        ->get();
        });

        $result['trending'] = Cache::remember('trending', $seconds, function(){
            return Product::select('id', 'prod_name', 'slug', 'image')
                            ->with([
                                'attributes' => function($q) {
                                    return $q->where('status', 'A');
                                }
                            ])
                            ->active()
                            ->productType('trending')
                            ->latest()
                            ->limit(8)
                            ->get();
        });

        $result['featured'] = Cache::remember('featured', $seconds, function(){
            return Product::select('id', 'prod_name', 'slug', 'image')
                            ->with([
                                'attributes' => function($q) {
                                    return $q->where('status', 'A');
                                }
                            ])
                            ->active()
                            ->productType('featured')
                            ->latest()
                            ->limit(8)
                            ->get();
        });

        $result['isPromo'] = Cache::remember('promo', $seconds, function(){
            return Product::select('id', 'prod_name', 'slug', 'image')
                            ->with([
                                'attributes' => function($q) {
                                    return $q->where('status', 'A');
                                }
                            ])
                            ->active()
                            ->productType('promo')
                            ->latest()
                            ->limit(8)
                            ->get();
        });
                                        
        return view('index', $result);
    }

    public function category($slug) 
    {
        $seconds = 120;

        $result['products'] = Cache::remember('products-of-' . $slug, $seconds, function() use ($slug) {
            return Product::with([
                            'category:id,name',
                            'attributes' => function($q) {
                                $q->select('id', 'product_id', 'mrp', 'price')
                                    ->where('status', 'A');
                            }           
                        ])
                        ->whereHas('category', function($query) use ($slug) {
                            $query->where('slug', $slug);
                        })
                        ->active()
                        ->paginate(14);
        });

        $result['promos'] = Cache::remember('top-promos', $seconds, function(){
            return Category::select(['id', 'name', 'slug'])                        
                            ->where([
                                'is_home' => 1, 
                                'status' => 'A'
                            ])
                            ->inRandomOrder()
                            ->limit(5)
                            ->get();
        });
        
        return view('products', $result);
    }
    public function product($slug) 
    {
        dd($slug);
    }
}
