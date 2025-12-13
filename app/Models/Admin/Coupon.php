<?php

namespace App\Models\Admin;

use App\Enums\EntityStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => EntityStatus::class
    ];
}
