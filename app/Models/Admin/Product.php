<?php

namespace App\Models\Admin;

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

    public function productAttribute() {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }
}
