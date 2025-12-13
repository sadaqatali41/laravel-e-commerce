<?php

namespace App\Models\Admin;

use App\Enums\EntityStatus;
use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => EntityStatus::class
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
