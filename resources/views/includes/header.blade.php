<header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-header-top-area">
                        <!-- start header top left -->
                        <div class="aa-header-top-left">
                            <!-- start language -->
                            <div class="aa-language">
                                <div class="dropdown">
                                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <img src="{{ asset('assets/img/flag/english.jpg') }}" alt="english flag">ENGLISH
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#"><img src="{{ asset('assets/img/flag/french.jpg') }}"
                                                    alt="">FRENCH</a></li>
                                        <li><a href="#"><img src="{{ asset('assets/img/flag/english.jpg') }}"
                                                    alt="">ENGLISH</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- / language -->

                            <!-- start currency -->
                            <div class="aa-currency">
                                <div class="dropdown">
                                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-usd"></i>USD
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                                        <li><a href="#"><i class="fa fa-jpy"></i>YEN</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- / currency -->
                            <!-- start cellphone -->
                            <div class="cellphone hidden-xs">
                                <p><span class="fa fa-phone"></span>00-62-658-658</p>
                            </div>
                            <!-- / cellphone -->
                        </div>
                        <!-- / header top left -->
                        <div class="aa-header-top-right">
                            <ul class="aa-head-top-nav-right">
                                <li><a href="account.html">My Account</a></li>
                                <li class="hidden-xs"><a href="wishlist.html">Wishlist</a></li>
                                <li class="hidden-xs"><a href="{{ route('cart') }}">My Cart</a></li>
                                <li class="hidden-xs"><a href="checkout.html">Checkout</a></li>
                                <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-header-bottom-area">
                        <!-- logo  -->
                        <div class="aa-logo">
                            <!-- Text based logo -->
                            <a href="{{ url('/') }}">
                                <span class="fa fa-shopping-cart"></span>
                                <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                            </a>
                            <!-- img based logo -->
                            <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
                        </div>
                        <!-- / logo  -->
                        <!-- cart box -->
                        @php
                            if(!request()->routeIs('cart')) {
                                $cartArr = myCart();
                                $carts = $cartArr['carts'];
                                $totalPrice = $cartArr['totalPrice'];
                                $cartCount = $cartArr['cartCount'];
                            }
                        @endphp
                        <div class="aa-cartbox">
                            <a class="aa-cart-link" href="{{ route('cart') }}">
                                <span class="fa fa-shopping-basket"></span>
                                <span class="aa-cart-title">SHOPPING CART</span>
                                <span class="aa-cart-notify">{{ $cartCount }}</span>
                            </a>
                            @if($cartCount > 0)
                                <div class="aa-cartbox-summary">
                                    <ul>
                                        @foreach($carts as $cart)
                                            <li>
                                                <a class="aa-cartbox-img" href="{{ route('product.list', $cart->product->slug) }}">
                                                    <img src="{{ asset('storage/product/product_attr/' . $cart->attribute->image) }}" alt="img">
                                                </a>
                                                <div class="aa-cartbox-info">
                                                    <h4>
                                                        <a href="{{ route('product.list', $cart->product->slug) }}">{{ $cart->product->prod_name }}</a>
                                                    </h4>
                                                    <p>{{ $cart->quantity }} x ${{ $cart->attribute->price }}</p>
                                                </div>
                                                <a class="aa-remove-product" data-id="{{ $cart->id }}" href="javascript:void(0)">
                                                    <span class="fa fa-times"></span>
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <span class="aa-cartbox-total-title">
                                                Total
                                            </span>
                                            <span class="aa-cartbox-total-price">
                                                ${{ $totalPrice }}
                                            </span>
                                        </li>
                                    </ul>
                                    <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
                                </div>
                            @endif
                        </div>
                        <!-- / cart box -->
                        <!-- search box -->
                        <div class="aa-search-box">
                            <form action="">
                                <input type="text" name="search" id="search" placeholder="Search here ex. 'man' ">
                                <button type="submit">
                                    <span class="fa fa-search"></span>
                                </button>
                            </form>
                        </div>
                        <!-- / search box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / header bottom  -->
</header>
