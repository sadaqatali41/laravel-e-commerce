<?php

namespace App\Models;

use App\Models\Admin\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id', 'id');
    }
}
