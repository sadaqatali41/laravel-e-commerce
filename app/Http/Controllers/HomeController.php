<?php

namespace App\Http\Controllers;

use App\Models\Admin\Brand;
use App\Models\Admin\Slider;
use Config;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private $seconds;

    public function __construct()
    {
        $this->seconds = Config::get('constants.CACHE_EXP');
    }

    public function index() 
    {
        $result['sliders'] = Cache::remember('sliders', $this->seconds, function(){
            return Slider::select(['title', 'short_title', 'description', 'image'])
                        ->active()
                        ->get();
        });

        $result['promos'] = Cache::remember('promos', $this->seconds, function(){
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
        
        $result['brands'] = Cache::remember('brands', $this->seconds, function(){
            return Brand::select(['name', 'image'])
                        ->where(['is_home' => 1, 'status' => 'A'])
                        ->get();
        });

        $result['trending'] = Cache::remember('trending', $this->seconds, function(){
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

        $result['featured'] = Cache::remember('featured', $this->seconds, function(){
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

        $result['isPromo'] = Cache::remember('promo', $this->seconds, function(){
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
        $result['products'] = Cache::remember('products-of-' . $slug, $this->seconds, function() use ($slug) {
            return Product::with([
                            'category:id,name,image',
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

        $result['promos'] = Cache::remember('top-promos', $this->seconds, function(){
            return Category::select(['id', 'name', 'slug'])                        
                            ->where([
                                'is_home' => 1, 
                                'status' => 'A'
                            ])
                            ->inRandomOrder()
                            ->limit(5)
                            ->get();
        });

        $result['t_r_p'] = Cache::remember('top-rated-product', $this->seconds, function(){
            return Product::select('id', 'prod_name', 'slug', 'image')
                            ->with([
                                'attributes' => function($q) {
                                    $q->select('id', 'product_id', 'mrp', 'price')
                                        ->where('status', 'A');
                                }
                            ])
                            ->inRandomOrder()
                            ->take(3)
                            ->get();
        });
        
        return view('products', $result);
    }
    public function product($slug) 
    {
        $product = Cache::remember($slug, $this->seconds, function() use ($slug){
            return Product::with([
                            'images',                            
                            'category:id,name,slug',
                            'colors' => function($query) {
                                $query->select('colors.id', 'colors.color') // Select `id` or foreign key columns
                                    ->where('colors.status', 'A');
                            },

                            'sizes' => function($query) {
                                $query->select('sizes.id', 'sizes.size') // Select `id` or foreign key columns
                                    ->where('sizes.status', 'A');
                            }
                        ])
                        ->where('slug', $slug)
                        ->first();
        });

        $products = Product::with([
                                'attributes' => function($q) {
                                    $q->select('id', 'product_id', 'mrp', 'price')
                                        ->where('status', 'A');
                                }
                            ])
                            ->whereHas('category', function($query) use ($slug){
                                $query->whereHas('products', function($q) use ($slug) {
                                    $q->where([
                                        'slug' => $slug,
                                        'status' => 'A'
                                    ]);
                                });
                            })
                            ->latest()
                            ->limit(8)
                            ->get();

        // return $products;
        return view('product-details', compact([
                                                        'product', 
                                                        'products'
                                                    ])
                                                );
    }
}
