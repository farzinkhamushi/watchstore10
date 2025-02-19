<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = [
        'destroyProduct',
        'refreshComponent' => '$refresh'
    ];

    public function deleteProduct($id){
        //previously done this
        //$this->dispatchBrowserEvent('deleteProduct',['id'=>$id]);
        $this->dispatch('deleteProduct', id: $id);
    }

    public function destroyProduct($id){

        $deleted_product = Product::query()->find($id);

        if(isset($deleted_product)){
            //deleting the product image from storage
            $img = $deleted_product->image;
            Product::deleteImage($img);
            //or unlink the image which removes it from storage.code like bellow
            //unlink(public_path().'/images/products/'.$img);

            //deleting from database
            Product::destroy($id);
            //$deleted_product->delete();
        }

        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        $products = Product::query()->
        where('title','like','%'.$this->search.'%')->
        orWhere('title_en','like','%'.$this->search.'%')->
        orWhere('description','like','%'.$this->search.'%')->
        paginate(5);
        return view('livewire.admin.products', compact('products'));
    }

}
