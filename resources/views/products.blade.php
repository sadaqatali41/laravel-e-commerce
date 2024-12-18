@extends('layouts.app')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        @php $category = $products->first(); @endphp
        <img src="{{ asset('assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Fashion</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">{{ $category->category->name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->
    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                    <div class="aa-product-catg-content">
                        <div class="aa-product-catg-head">
                            <div class="aa-product-catg-head-left">
                                <form class="aa-sort-form">
                                    <label for="sort_by">Sort by</label>
                                    <select name="sb" id="sort_by">
                                        <option value="pn" @if($sb == 'pn') selected  @endif>Name</option>
                                        <option value="pa" @if($sb == 'pa') selected  @endif>Price - Ascending</option>
                                        <option value="pd" @if($sb == 'pd') selected  @endif>Price - Descending</option>
                                        <option value="d" @if($sb == 'd') selected  @endif>Date</option>
                                    </select>
                                    <input type="hidden" name="ps" id="ps" value="{{ $ps }}" placeholder="Price Start">
                                    <input type="hidden" name="pe" id="pe" value="{{ $pe }}" placeholder="Price End">
                                    <input type="hidden" name="cl" id="cl" value="{{ $cl }}" placeholder="Color Ids">
                                </form>
                            </div>
                            <div class="aa-product-catg-head-right">
                              <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                              <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                        <div class="aa-product-catg-body">
                            <ul class="aa-product-catg">
                                <!-- start single product item -->
                                @foreach ($products as $product)
                                    <x-home.product-card :product="$product" is-visible="true" />
                                @endforeach
                            </ul>
                            <!-- quick view modal -->
                            <x-home.product-quick-view />
                            <!-- / quick view modal -->
                        </div>
                        <div class="aa-product-catg-pagination">
                            <nav>
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                    <aside class="aa-sidebar">
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Category</h3>
                            <ul class="aa-catg-nav">
                                @foreach ($promos as $cat)
                                    <li>
                                        <a href="{{ route('category.product', $cat->slug) }}" style="color: @if($cat->slug == $slug) #ff6666 @else #333333 @endif">{{ $cat->name }}</a>
                                    </li>                                    
                                @endforeach
                            </ul>
                        </div>
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Tags</h3>
                            <div class="tag-cloud">
                                <a href="#">Fashion</a>
                                <a href="#">Ecommerce</a>
                                <a href="#">Shop</a>
                                <a href="#">Hand Bag</a>
                                <a href="#">Laptop</a>
                                <a href="#">Head Phone</a>
                                <a href="#">Pen Drive</a>
                            </div>
                        </div>
                        <div class="aa-sidebar-widget">
                            <h3>Shop By Price</h3>              
                            <!-- price range -->
                            <div class="aa-sidebar-price-range">
                                <form action="">
                                    <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background"></div>
                                    <span id="skip-value-lower" class="example-val">30.00</span>
                                    <span id="skip-value-upper" class="example-val">100.00</span>
                                    <button class="aa-filter-btn" type="button">Filter</button>
                                </form>
                            </div>              
                        </div>
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Shop By Color</h3>
                            <div class="aa-color-tag">
                                @foreach ($colors as $color)
                                    @if(in_array($color->id, $cl_id))
                                        <a class="aa-color-{{ strtolower($color->color) }} color-active" data-id="{{ $color->id }}" href="javascript:void(0)"></a>
                                    @else
                                        <a class="aa-color-{{ strtolower($color->color) }}" data-id="{{ $color->id }}" href="javascript:void(0)"></a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- single sidebar -->
                        @isset($rvp)
                        <div class="aa-sidebar-widget">
                            <h3>Recently Views</h3>
                            <div class="aa-recently-views">
                                <ul>                                    
                                    @foreach ($rvp as $view)
                                        <x-home.top-rated-product :trp="$view" />
                                    @endforeach 
                                </ul>
                            </div>
                        </div>
                        @endisset
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Top Rated Products</h3>
                            <div class="aa-recently-views">
                                <ul>
                                    @foreach ($t_r_p as $trp)
                                        <x-home.top-rated-product :trp="$trp" />
                                    @endforeach                                    
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->
@endsection
