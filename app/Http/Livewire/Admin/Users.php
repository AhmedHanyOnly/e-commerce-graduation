<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Traits\livewireResource;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use livewireResource;
    public $user_id,$name,$email,$password,$type='admin',$role_id;
    protected function rules()
    {
        return [
            'name' => ['string', 'required'],
            'password' => ['required_without:obj'],
            'email' => ['nullable','email', 'unique:users,email,' . $this->obj?->id],
            'type'=>['nullable'],
            'role_id'=>['required'],
        ];
    }

    public function beforeSubmit()
    {
        unset($this->data['role_id']);
        if($this->password){
            $this->data['password']=Hash::make($this->password);
        }else{
            $this->data['password']=$this->obj->password;
        }
    }
    public function afterSubmit()
    {
        $this->obj?->syncRoles($this->role_id);
    }
    public function whileEditing()
    {
        $this->role_id=$this->obj->role?->id;
    }

    public function render()
    {
        $roles=Role::all();
        $users=User::paginate(10);
        return view('livewire.admin.Users.index',compact('users', 'roles'))->extends('admin.layouts.admin')->section('content');
    }
}
