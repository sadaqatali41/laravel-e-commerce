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
                                            <span class="aa-product-view-price price">${{ $firstAttr->price }}</span>
                                            @if($firstAttr->mrp != $firstAttr->price)
                                                &nbsp;
                                                <span class="aa-product-view-price mrp">
                                                    <del>${{ $firstAttr->mrp }}</del>
                                                </span>
                                            @endif
                                            <p class="aa-product-avilability" style="margin-bottom: 3px;">Avilability: <span>In stock</span></p>
                                            <p style="color: #ff6666; font-weight: bold;">{{ $product->lead_time }}</p>
                                        </div>
                                        <p>{!! $product->short_desc !!}</p>
                                        <h4>Size</h4>
                                        <div class="aa-prod-view-size">
                                            @php $sizeArr = [] @endphp
                                            @foreach ($product->attributes as $attr)
                                                @if($attr->size()->exists())
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
                                            <form>
                                                <select id="quantity" name="quantity">
                                                    @for ($i = 1; $i <= 9; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>                                                        
                                                    @endfor
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
                                        @if($product->reviews()->exists())
                                        <h4>{{ count($product->reviews) }} Review(s) for : {{ $product->prod_name }}</h4>
                                        <ul class="aa-review-nav">
                                            @foreach($product->reviews as $review)
                                            <li>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="javascript:void(0)">
                                                            <img class="media-object" src="{{ asset('assets/img/testimonial-img-3.jpg') }}"
                                                                alt="girl image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <strong>{{ $review->user->name }}</strong> - <span>{{ $review->created_at }}</span>
                                                        </h4>
                                                        <div class="aa-product-rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $review->rating)
                                                                    <span class="fa fa-star"></span>
                                                                @else
                                                                    <span class="fa fa-star-o"></span>
                                                                @endif                                                            
                                                            @endfor
                                                        </div>
                                                        <p>{{ $review->review }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach                                            
                                        </ul>
                                        @endif
                                        <h4>Add a review</h4>
                                        <!-- review form -->
                                        <form id="productReviewForm" action="{{ route('user.product-review.store') }}" class="aa-review-form">
                                            <div class="form-group">                                                
                                                <label for="rating">Your Rating</label>
                                                <select class="form-control" name="rating" id="rating">
                                                    <option value="">Select Rating</option>
                                                    <option value="1">Worst</option>
                                                    <option value="2">Bad</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Fantastic</option>
                                                </select>
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="product_review">Your Review</label>
                                                <textarea class="form-control" rows="3" name="product_review" id="product_review"></textarea>
                                            </div>
                                            <button type="submit" id="productReviewFormBtn" class="btn btn-default aa-review-submit">Submit</button>
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
