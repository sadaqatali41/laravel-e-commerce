<?php

namespace App\Models\Admin;

use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function attributes() {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function tax() {
        return $this->belongsTo(Taxes::class, 'tax_id', 'id');
    }
}
