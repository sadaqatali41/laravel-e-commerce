<a class="aa-cart-link" href="{{ route('cart') }}">
    <span class="fa fa-shopping-basket"></span>
    <span class="aa-cart-title">SHOPPING CART</span>
    <span class="aa-cart-notify">{{ $cartCount }}</span>
</a>
@if($cartCount > 0)
    <div class="aa-cartbox-summary">
        <ul>
            @foreach($carts as $cart)
                {{-- @if($loop->iteration <=2) --}}
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
                {{-- @endif --}}
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