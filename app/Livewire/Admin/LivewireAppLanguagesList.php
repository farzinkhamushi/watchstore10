<?php

namespace App\Livewire\Admin;

use App\Models\AppLanguage;
use Livewire\Component;
use Livewire\WithPagination;

class LivewireAppLanguagesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;


    public function render()
    {
        $app_languages = AppLanguage::query()->
        where('language','like','%'.$this->search.'%')->
        paginate(30);
        return view('livewire.admin.livewire-app-languages-list',compact('app_languages'));
    }
}
