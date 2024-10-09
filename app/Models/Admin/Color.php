<?php

namespace App\Models\Admin;

use App\Models\Admin\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'color_id', 'id');
    }

    #define the model scope
    public function scopeActive($query)
    {
        return $query->where('status', 'A');
    }
}
