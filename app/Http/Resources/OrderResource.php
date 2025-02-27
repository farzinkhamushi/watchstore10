<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'status'=>$this->status,
            'order_details'=>OrderDetailResource::collection($this->receivedOrderDetails),
            //'order_details'=>OrderDetailResource::collection($this->orderDetails),
        ];
    }
}
