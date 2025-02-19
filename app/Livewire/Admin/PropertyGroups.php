<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PropertyGroup;

class PropertyGroups extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = [
        'destroyPropertyGroup',
        'refreshComponent' => '$refresh'
    ];

    public function deletePropertyGroup($id){
        $this->dispatch('deletePropertyGroup', id: $id);
    }

    public function destroyPropertyGroup($id){

        $deleted_property_group = PropertyGroup::query()->find($id);

        if(isset($deleted_property_group)){
            //deleting the slider image from storage
            $img = $deleted_property_group->image;
            PropertyGroup::deleteImage($img);

            //deleting from database
            //$deleted_slider->delete();
            PropertyGroup::destroy($id);
        }

        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        $property_groups = PropertyGroup::query()->
        where('title','like','%'.$this->search.'%')->
        //orWhere('image','like','%'.$this->search.'%')->
        //orWhere('parent_id','like','%'.$this->search.'%')->
        paginate(5);
        return view('livewire.admin.property-groups', compact('property_groups'));
    }

}
