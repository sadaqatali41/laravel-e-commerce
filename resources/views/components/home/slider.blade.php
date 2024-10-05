@props(['slider'])
<li>
    <div class="seq-model">
      <img data-seq src="{{ asset('storage/slider/' . $slider->image) }}" alt="Men slide img" />
    </div>
    <div class="seq-title">
    <span data-seq>{{ $slider->short_title }}</span>
      <h2 data-seq>{{ $slider->title }}</h2>
      <p data-seq>{{ $slider->description }}</p>
      <a data-seq href="{{ route('category.product', $slider->category->slug) }}" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
    </div>
</li>