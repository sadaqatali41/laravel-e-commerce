@extends('layouts.app')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('assets/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>{{ $product->prod_name }}</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('category.product', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                        <li class="active">{{ $product->prod_name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container">
                                                    <a data-lens-image="{{ asset('storage/product/' . $product->image) }}" class="simpleLens-lens-image">
                                                        <img src="{{ asset('storage/product/' . $product->image) }}" class="simpleLens-big-image">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="simpleLens-thumbnails-container">
                                                <a data-big-image="{{ asset('storage/product/' . $product->image) }}"
                                                    data-lens-image="{{ asset('storage/product/' . $product->image) }}"
                                                    class="simpleLens-thumbnail-wrapper" href="#">
                                                    <img src="{{ asset('storage/product/' . $product->image) }}" width="45">
                                                </a>
                                                @foreach ($product->images as $img)
                                                    <a data-big-image="{{ asset('storage/product/' . $img->image) }}"
                                                        data-lens-image="{{ asset('storage/product/' . $img->image) }}"
                                                        class="simpleLens-thumbnail-wrapper" href="#">
                                                        <img src="{{ asset('storage/product/' . $img->image) }}" width="45">
                                                    </a>                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{ $product->prod_name }}</h3>
                                        <div class="aa-price-block">
                                            @php $firstAttr = $product->attributes->first() @endphp
                                            <span class="aa-product-view-price">${{ $product->price }}</span>
                                            <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                        </div>
                                        <p>{!! $product->short_desc !!}</p>
                                        <h4>Size</h4>
                                        <div class="aa-prod-view-size">
                                            @php $sizeArr = [] @endphp
                                            @foreach ($product->attributes as $attr)
                                                @if($attr->size->count())
                                                    @php $sizeArr[$attr->size->id] = $attr->size->size @endphp
                                                @endif
                                            @endforeach                                            
                                            @foreach ($sizeArr as $size_id => $size)
                                                <a href="javascript:void(0)" 
                                                class="getSize" 
                                                data-id="{{ $size_id }}"
                                                data-size="{{ $size }}">{{ $size }}</a>
                                            @endforeach
                                        </div>
                                        <h4>Color</h4>
                                        <div class="aa-color-tag">
                                            @foreach ($product->attributes as $attr)
                                                <a href="javascript:void(0)"
                                                data-src="{{ asset('storage/product/product_attr/' . $attr->image) }}"
                                                data-id="{{ $attr->color->id }}"
                                                data-price="{{ $attr->price }}"
                                                data-mrp="{{ $attr->mrp }}"
                                                class="aa-color-{{ strtolower($attr->color->color) }} clickEvent size_{{ $attr->size->size }}"></a>
                                            @endforeach
                                        </div>
                                        <div class="aa-prod-quantity">
                                            <form action="">
                                                <select id="quantity" name="quantity">
                                                    <option selected="1" value="0">1</option>
                                                    <option value="1">2</option>
                                                    <option value="2">3</option>
                                                    <option value="3">4</option>
                                                    <option value="4">5</option>
                                                    <option value="5">6</option>
                                                </select>
                                            </form>
                                            <p class="aa-prod-category">
                                                Category: <a href="{{ route('category.product', $product->category->slug) }}">{{ $product->category->name }}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            <a class="aa-add-to-cart-btn" data-id="{{ $product->id }}" href="javascript:void(0)">Add To Cart</a>
                                            <p id="error" style="color: #ff6666;"></p>
                                            {{-- <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                                            <a class="aa-add-to-cart-btn" href="#">Compare</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                                <li><a href="#review" data-toggle="tab">Reviews</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    {!! $product->description !!}
                                </div>
                                <div class="tab-pane fade" id="technical_specification">
                                    {!! $product->tech_spec !!}
                                </div>
                                <div class="tab-pane fade" id="uses">
                                    {!! $product->used_for !!}
                                </div>
                                <div class="tab-pane fade" id="warranty">
                                    {!! $product->warranty !!}
                                </div>
                                <div class="tab-pane fade" id="review">
                                    <div class="aa-product-review-area">
                                        <h4>2 Reviews for T-Shirt</h4>
                                        <ul class="aa-review-nav">
                                            {{-- single review --}}
                                            <li>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="{{ asset('assets/img/testimonial-img-3.jpg') }}"
                                                                alt="girl image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <strong>Marla Jobs</strong> - <span>March 26, 2016</span>
                                                        </h4>
                                                        <div class="aa-product-rating">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                    </div>
                                                </div>
                                            </li>                                            
                                        </ul>
                                        <h4>Add a review</h4>
                                        <div class="aa-your-rating">
                                            <p>Your Rating</p>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                        </div>
                                        <!-- review form -->
                                        <form action="" class="aa-review-form">
                                            <div class="form-group">
                                                <label for="message">Your Review</label>
                                                <textarea class="form-control" rows="3" id="message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="example@gmail.com">
                                            </div>

                                            <button type="submit"
                                                class="btn btn-default aa-review-submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Related product -->
                        <div class="aa-product-related-item">
                            <h3>Related Products</h3>
                            <ul class="aa-product-catg aa-related-item-slider">
                                <!-- start single product item -->
                                @foreach ($products as $product)
                                    <x-home.product-card :product="$product" />
                                @endforeach
                            </ul>
                            <!-- quick view modal -->
                            <x-home.product-quick-view />
                            <!-- / quick view modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->
    <input type="hidden" name="color_id" id="color_id">
    <input type="hidden" name="size_id" id="size_id">
@endsection
