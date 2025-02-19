<?php
namespace App\Livewire\Admin;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class LivewireBrandsList extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;





    protected $listeners = [
        'destroyBrand',
        'refreshComponent' => '$refresh'
    ];
    public function deleteBrand($id){
        $this->dispatch('deleteBrand', id: $id);
    }
    public function destroyBrand($id){

        $deleted_brand = Brand::query()->find($id);

        if(isset($deleted_brand)){
            //deleting the slider image from storage
            $img = $deleted_brand->image;
            Brand::deleteImage($img);

            //deleting from database
            //$deleted_slider->delete();
            Brand::destroy($id);
        }

        $this->dispatch('refreshComponent');
    }





    public function render()
    {
        $brands = Brand::query()->
        where('title','like','%'.$this->search.'%')->
        //orWhere('image','like','%'.$this->search.'%')->
        //orWhere('parent_id','like','%'.$this->search.'%')->
        paginate(5);
        return view('livewire.admin.livewire-brands-list', compact('brands'));
    }

}
