<?php

namespace App\Models\Admin;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $guarded = [];

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function subcategories() {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    // ! define category scope
    public function scopeIsHome($query) {
        return $query->where('is_home', 1);
    }

    public function scopeActive($query) {
        return $query->where('status', 'A');
    }
}
