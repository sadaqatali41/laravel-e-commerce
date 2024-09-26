@props(['trp'])
<li>
    <a href="#" class="aa-cartbox-img">
        <img alt="img" src="{{ asset('storage/product/' . $trp->image) }}">
    </a>
    <div class="aa-cartbox-info">
        <h4>
            <a href="{{ route('product.list', $trp->slug) }}">{{ $trp->prod_name }}</a>
        </h4>
        @php
            $price = min($trp->attributes->first()->mrp, $trp->attributes->first()->price);
        @endphp
        <p>1 x ${{ $price }}</p>
    </div>
</li>