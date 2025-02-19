<?php

namespace App\Livewire\Admin;

use App\Enums\OrderStatus;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderDetail;
use Livewire\WithPagination;

class OrderDetails extends Component
{

    public $order_id;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $listeners = [
        'refreshComponent' => '$refresh'
    ];


    public function changeStatus($orderDetail_id)
    {
        $rej = OrderStatus::Rejected->value ;
        $rec = OrderStatus::Received->value ;
        $prc = OrderStatus::Proccessing->value ;
        $order_detail = OrderDetail::query()->find($orderDetail_id);
        $order_detail_sts = $order_detail->status;

        switch ($order_detail_sts){
            case $rej :
                $order_detail->update([
                    'status'=> $rej
                ]);
                break;
            case $rec :
                $order_detail->update([
                    'status'=> $rec
                ]);
                break;
            case $prc :
                $order_detail->update([
                    'status'=> $prc
                ]);
                break;
        }

    }

    public function render()
    {
        $orderDetails = OrderDetail::query()->where('order_id',$this->order_id)->
        paginate(5);
        $total_price = Order::query()->find($this->order_id)->total_price;
        return view('livewire.admin.order-details', compact('orderDetails','total_price'));
    }

}
