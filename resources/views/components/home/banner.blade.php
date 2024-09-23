@props(['brand'])
<li>
    <a href="#">
      <img src="{{ asset('storage/brand/' . $brand->image) }}" alt="{{ $brand->name }}">
    </a>
</li>