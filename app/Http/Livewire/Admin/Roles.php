<?php

namespace App\Http\Livewire\Admin;

use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use livewireResource;
    public $name,$permission_request=[],$rolePermissions=[], $edit_mode = false, $create_mode = false, $role_id;
    protected function rules(){
        return[
            'name' => ['required', 'string', 'max:255'],
            'permission_request' => ['nullable'],
        ];
    }

    public function setModelName()
    {
        $this->model ='Spatie\Permission\Models\Role';
    }
    public function afterSubmit()
    {
        $this->obj->syncPermissions($this->permission_request);
    }
    public function whileEditing()
    {
        $this->permission_request = $this->obj->permissions->pluck('id')->toArray();
    }
    public function render()
    {
        $permission=Permission::get();
        $roles=Role::paginate();
        return view('livewire.admin.roles.roles',compact('roles','permission'))->extends('admin.layouts.admin')->section('content');
    }
}
