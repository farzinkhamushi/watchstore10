<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Colors extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = [
        'destroyColor',
        'refreshComponent' => '$refresh'
    ];

    public function deleteColor($id){
        $this->dispatch('deleteColor', id: $id);
    }

    public function destroyColor($id){

        $deleted_color = Color::query()->find($id);

        if(isset($deleted_color)){
            //deleting from database
            //$deleted_color->delete();
            Color::destroy($id);
        }

        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        $colors = Color::query()->
        where('title','like','%'.$this->search.'%')->
        //orWhere('image','like','%'.$this->search.'%')->
        //orWhere('parent_id','like','%'.$this->search.'%')->
        paginate(5);
        return view('livewire.admin.colors', compact('colors'));
    }

}
