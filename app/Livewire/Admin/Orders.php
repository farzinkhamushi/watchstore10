<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $listeners = [
        'refreshComponent' => '$refresh'
    ];



    public function render()
    {
        $orders = Order::query()->
        where('code','like','%'.$this->search.'%')->
        orWhereHas('user',function ($q){
            $q->Where('name','like','%'.$this->search.'%')->
            orWhere('mobile','like','%'.$this->search.'%');
        })->
        paginate(5);
        return view('livewire.admin.orders', compact('orders'));
    }

}
