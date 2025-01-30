<?php

namespace App\Models\Admin;

use App\Models\Admin\Size;
use App\Models\Admin\Brand;
use App\Models\Admin\Color;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\ProductAttribute;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
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

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_attributes', 'product_id', 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_attributes', 'product_id', 'size_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    // ! define scope here

    public function scopeActive($query) {
        return $query->where('status', 'A');
    }

    public function scopeProductType($query, $type) {
        return $query->where('is_' . $type, 1);
    }
}
