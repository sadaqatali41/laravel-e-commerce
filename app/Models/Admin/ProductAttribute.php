<?php

namespace App\Models\Admin;

use App\Models\Admin\Size;
use App\Models\Admin\Color;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function color() {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function size() {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
