<?php

namespace App\Http\Livewire\Admin;

use App\Models\Program;
use App\Traits\livewireResource;
use Livewire\Component;

class Programs extends Component
{
    use livewireResource;
    public $name,$search;
    public function rules(){
        return ['name'=>'required'];
    }
    public function render()
    {
        $programs=Program::withCount(['clients','messages'])->where(function($q){
            if($this->search){
                $q->where('name','LIKE',"%".$this->search."%");
            }
        })->latest('id')->paginate();
        return view('livewire.admin.programs',compact('programs'))->extends('admin.layouts.admin')->section('content');
    }
}
