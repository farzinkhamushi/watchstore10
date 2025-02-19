<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Property;
use App\Models\PropertyGroup;
use Livewire\WithPagination;

class Properties extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        $properties = Property::query()->
        where('title','like','%'.$this->search.'%')->
        //orWhere('property_group_id','like','%'.$this->search.'%')->
        paginate(20);
        return view('livewire.admin.properties' , compact('properties'));
    }
}
