<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Clinic;
use App\Traits\livewireResource;
use Livewire\Component;

class Cities extends Component
{
    use livewireResource;
    public $name,$search;
    public function rules(){
        return ['name'=>'required'];
    }
    public function render()
    {
        $cities=City::withCount('users')->where(function($q){
            if($this->search){
                $q->where('name','LIKE',"%".$this->search."%");
            }
        })->latest('id')->paginate();
        return view('livewire.admin.cities',compact('cities'))->extends('admin.layouts.admin')->section('content');
    }
}
