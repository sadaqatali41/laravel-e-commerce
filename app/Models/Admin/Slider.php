<?php

namespace App\Models\Admin;

use App\Enums\EntityStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => EntityStatus::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', EntityStatus::ACTIVE->value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
