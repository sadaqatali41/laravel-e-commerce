@props(['product', 'isVisible' => false])
@php 
$firstAttr = $product->attributes->first();
if($firstAttr->image !== '') {
    $imageSrc = asset('storage/product/product_attr/' . $firstAttr->image);
} else {
    $imageScr = asset('storage/product/' . $product->image);
}
@endphp
<li>
    <figure>
        <a class="aa-product-img" href="{{ route('product.list', $product->slug) }}">
            <img src="{{ $imageSrc }}" alt="{{ $product->prod_name }}" style="height: 300px; width: 250px;">
        </a>
        <a class="aa-add-card-btn" 
        href="javascript:void(0)" 
        data-id="{{ $product->id }}" 
        data-c="{{ $firstAttr->color_id }}"
        data-s="{{ $firstAttr->size_id }}">
            <span class="fa fa-shopping-cart"></span>Add To Cart
        </a>
        <figcaption>
            <h4 class="aa-product-title">
                <a href="{{ route('product.list', $product->slug) }}">{{ $product->prod_name }}</a>
            </h4>
            <span class="aa-product-price">${{ $firstAttr->price }}</span>
            @if ($firstAttr->mrp > $firstAttr->price)
                <span class="aa-product-price">
                    <del>${{ $firstAttr->mrp }}</del>
                </span>
            @endif
            @if($isVisible)
                <p class="aa-product-descrip">{!! $product->short_desc !!}</p>
            @endif
        </figcaption>
    </figure>                          
    <!-- product badge -->
    <span class="aa-badge aa-sale" href="#">SALE!</span>
</li>