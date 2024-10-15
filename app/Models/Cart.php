<?php

namespace App\Models;

use App\Models\Admin\Size;
use App\Models\Admin\Color;
use App\Models\Admin\Product;
use App\Models\Admin\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id', 'id');
    }

    public function product()
    {
        return $this->hasOneThrough(Product::class, ProductAttribute::class, 'id', 'id', 'product_attribute_id', 'product_id');
    }

    public function color()
    {
        return $this->hasOneThrough(Color::class, ProductAttribute::class, 'id', 'id', 'product_attribute_id', 'color_id');
    }

    public function size()
    {
        return $this->hasOneThrough(Size::class, ProductAttribute::class, 'id', 'id', 'product_attribute_id', 'size_id');
    }
}
