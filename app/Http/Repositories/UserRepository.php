<?php

namespace App\Http\Repositories;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class UserRepository
{
    public static function receivedUserOrder($user)
    {
        $orders = Order::query()->whereHas('orderDetails', function ($q){
            return $q->where('status',OrderStatus::Received->value);
        })->where('user_id',$user->id)->where('status',PaymentStatus::Success->value)->get();
        return OrderResource::collection($orders);
    }

    public static function receivedUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails', function ($q){
            return $q->where('status',OrderStatus::Received->value);
        })->where('user_id',$user->id)->where('status',PaymentStatus::Success->value)->count();
    }

    public static function processingUserOrder($user)
    {
        $orders = Order::query()->whereHas('orderDetails', function ($q){
            return $q->where('status',OrderStatus::Proccessing->value);
        })->where('user_id',$user->id)->where('status',PaymentStatus::Draft->value)->get();
        return OrderResource::collection($orders);
    }

    public static function processingUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails', function ($q){
            return $q->where('status',OrderStatus::Proccessing->value);
        })->where('user_id',$user->id)->where('status',PaymentStatus::Draft->value)->count();
    }

    public static function rejectedUserOrder($user)
    {
        $orders = Order::query()->whereHas('orderDetails', function ($q){
            return $q->where('status',OrderStatus::Rejected->value);
        })->where('user_id',$user->id)->where('status',PaymentStatus::Failed->value)->get();
        return OrderResource::collection($orders);
    }

    public static function rejectedUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails', function ($q){
            return $q->where('status',OrderStatus::Rejected->value);
        })->where('user_id',$user->id)->where('status',PaymentStatus::Failed->value)->count();
    }

}
