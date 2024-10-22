<?php

namespace App\Http\Controllers;

use App\Models\Admin\Brand;
use App\Models\Admin\Color;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

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
            return Slider::select(['category_id', 'title', 'short_title', 'description', 'image'])
                        ->with('category:id,slug')
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
                            ->isHome()
                            ->active()
                            ->limit(5)
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

    public function category(Request $request, $slug, $subSlug = null) 
    {
        $cacheName = $subSlug != null ? $slug . '-' . $subSlug : $slug;

        $sort_by = $request->sb;
        if($sort_by == null || $sort_by == 'pn') {
            $sort_by = 'pn';
        }
        $cacheName .= '-' . $sort_by;

        $result['products'] = Cache::remember('products-of-' . $cacheName, $this->seconds, function() use ($slug, $subSlug, $sort_by) {
            return Product::with([
                            'category:id,name,image',
                            'attributes' => function($q) use ($sort_by) {
                                $q->select('id', 'product_id', 'mrp', 'price', 'color_id', 'size_id')
                                    ->where('status', 'A')
                                    ->orderBy('price', 'asc');
                            }
                        ])
                        ->withAggregate('attributes', 'price', 'min')
                        ->whereHas('category', function($query) use ($slug) {
                            $query->where('slug', $slug);
                        })
                        ->when($subSlug, function($query) use ($subSlug){
                            $query->whereHas('subcategory', function($subQuery) use($subSlug) {
                                $subQuery->where('slug', $subSlug);
                            });
                        })
                        ->when($sort_by === 'pn', function($q){
                            $q->orderBy('prod_name', 'asc');
                        })
                        ->when($sort_by === 'd', function($q){
                            $q->orderBy('created_at', 'desc');
                        })
                        ->when($sort_by === 'pa', function($q){
                            $q->orderBy('attributes_min_price', 'asc');
                        })
                        ->when($sort_by === 'pd', function($q){
                            $q->orderBy('attributes_min_price', 'desc');
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

        #fetch color
        $result['colors'] = Cache::remember('colors', $this->seconds, function(){
            return Color::select('id', 'color')
                        ->active()
                        ->inRandomOrder()
                        ->get();
        });

        #fetch recently viewed product
        if(session()->has('recently_viewed')) {
            $recentlyViewedIds = session()->get('recently_viewed', []);
            $recentlyViewedProducts = Product::select('id', 'prod_name', 'slug', 'price', 'image')
                                            ->with([
                                                'attributes' => function($q) {
                                                    $q->select('id', 'product_id', 'mrp', 'price')
                                                        ->where('status', 'A');
                                                }
                                            ])
                                            ->whereIn('id', $recentlyViewedIds)
                                            ->get();
            $result['rvp'] = $recentlyViewedProducts;
        }
        $result['sb'] = $sort_by;
        
        return view('products', $result);
    }
    public function product($slug) 
    {
        $product = Cache::remember($slug, $this->seconds, function() use ($slug){
            return Product::with([
                            'images',                            
                            'category:id,name,slug',
                            'attributes' => function($query) {
                                $query->with('color', 'size');
                            }                            
                        ])
                        ->where('slug', $slug)
                        ->first();
        });

        $products = Cache::remember('related-product-' . $slug, $this->seconds, function() use ($slug){
            return Product::with([
                            'attributes' => function($q) {
                                $q->select('id', 'product_id', 'mrp', 'price', 'color_id', 'size_id')
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
                        ->where('slug', '!=', $slug)
                        ->latest()
                        ->limit(8)
                        ->get();
        });

        // recently viewed products
        $this->storeInSession($product->id);

        $result['product'] = $product;
        $result['products'] = $products;

        // return $products;
        return view('product-details', $result);
    }

    public function storeInSession($productId) 
    {
        $recentlyViewed = session()->get('recently_viewed', []);

        if (!in_array($productId, $recentlyViewed)) {
            array_unshift($recentlyViewed, $productId);
            $recentlyViewed = array_slice($recentlyViewed, 0, 5);
        }

        session()->put('recently_viewed', $recentlyViewed);
    }
    
    public function contact()
    {
        return view('contact');
    }
}
