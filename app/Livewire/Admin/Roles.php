<?php

namespace App\Livewire\Admin;

use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        $roles = Role::query()->
        where('name','like','%'.$this->search.'%')->
        paginate(5);
        return view('livewire.admin.roles',compact('roles'));
    }
}
