<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = [
        'destroyCategory',
        'refreshComponent' => '$refresh'
    ];

    public function deleteCategory($id){
        $this->dispatch('deleteCategory', id: $id);
    }

    public function destroyCategory($id){


        $deleted_category = Category::query()->find($id);

        if(isset($deleted_slider)){
            //deleting the slider image from storage
            $img = $deleted_category->image;
            Category::deleteImage($img);

            //deleting from database
            //$deleted_slider->delete();
            Category::destroy($id);
        }

        //$this->emit('refreshComponent');
        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        $categories = Category::query()->
        where('title','like','%'.$this->search.'%')->
        //orWhere('image','like','%'.$this->search.'%')->
        //orWhere('parent_id','like','%'.$this->search.'%')->
        paginate(5);
        return view('livewire.admin.categories', compact('categories'));
    }

}
