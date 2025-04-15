<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\OrderDetail;
use App\Models\OrderTracking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function createdAt() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d M Y h:i:s A')
        );
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function trackings()
    {
        return $this->hasMany(OrderTracking::class, 'order_id', 'id');
    } 

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
