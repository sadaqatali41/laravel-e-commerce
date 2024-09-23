@props(['promo'])
<div class="aa-single-promo-right">
    <div class="aa-promo-banner">                      
        <img src="{{ asset('storage/category/' . $promo->image) }}" alt="img">
        <div class="aa-prom-content">
            <span>Exclusive Item</span>
            <h4>
                <a href="{{ route('category.product', $promo->slug) }}">For {{ $promo->name }}</a>
            </h4>                        
        </div>
    </div>
</div>