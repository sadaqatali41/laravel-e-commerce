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
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('assets/img/flag/french.jpg') }}" alt="">FRENCH
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('assets/img/flag/english.jpg') }}" alt="">ENGLISH
                                            </a>
                                        </li>
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
                                @guest
                                    <li>
                                        <a href="{{ route('user.registration') }}">My Account</a>
                                    </li>                                    
                                @endguest
                                @auth
                                    <li>
                                        <a href="javascript:void(0)" style="color: #ff6666;">{{ auth()->user()->name }}</a>
                                    </li>
                                @endauth
                                <li class="hidden-xs">
                                    <a href="wishlist.html">Wishlist</a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="{{ route('cart') }}">My Cart</a>
                                </li>
                                @auth
                                    <li class="hidden-xs">
                                        <a href="{{ route('user.checkout') }}">Checkout</a>
                                    </li>                                    
                                @endauth
                                @guest
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#login-modal">Login</a>
                                    </li>
                                @else
                                    <li>
                                        <form action="{{ route('user.logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-link" style="display: inline-block; color: #333333; border-right: 1px solid #ddd; font-size: 14px; padding: 5px 8px; text-decoration: none;">Logout</button>
                                        </form>
                                    </li>
                                @endguest
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
                            @include('cart-string')
                        </div>
                        <!-- / cart box -->
                        <!-- search box -->
                        <div class="aa-search-box">
                            <form action="{{ url('search') }}" id="searchForm">
                                <input type="text" name="param" id="param" value="{{ request()->get('param') }}" placeholder="Search here ex. 'man' ">
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
