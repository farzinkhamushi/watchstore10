<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'code',
        'status',
        'transaction_id',
        'address_id',
        'user_id'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function receivedOrderDetails()
    {
        return $this->hasMany(OrderDetail::class)->where('status',OrderStatus::Received->value);
    }

}
