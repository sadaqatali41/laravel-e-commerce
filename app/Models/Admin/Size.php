<?php

namespace App\Models\Admin;

use App\Enums\EntityStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => EntityStatus::class,
    ];
}
