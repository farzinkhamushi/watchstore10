<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Sliders extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = [
        'destroySlider',
        'refreshComponent' => '$refresh'
    ];

    public function deleteSlider($id){
        $this->dispatch('deleteSlider', id: $id);
    }

    public function destroySlider($id){

        $deleted_slider = Slider::query()->find($id);

        if(isset($deleted_slider)){
            //deleting the slider image from storage
            $img = $deleted_slider->image;
            Slider::deleteImage($img);

            //deleting from database
            //$deleted_slider->delete();
            Slider::destroy($id);
        }

        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        $sliders = Slider::query()->
        where('title','like','%'.$this->search.'%')->
        //orWhere('image','like','%'.$this->search.'%')->
        //orWhere('parent_id','like','%'.$this->search.'%')->
        paginate(5);
        return view('livewire.admin.sliders', compact('sliders'));
    }

}
