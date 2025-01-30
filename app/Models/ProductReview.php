<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function createdAt() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('F d, Y')
        );
    }

    public function product() 
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
