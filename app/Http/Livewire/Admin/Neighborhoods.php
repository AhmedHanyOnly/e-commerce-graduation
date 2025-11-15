<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Neighborhood;
use App\Traits\livewireResource;
use Livewire\Component;

class Neighborhoods extends Component
{
    use livewireResource;
    public $name, $search, $city_id, $select_citites;
    public function rules()
    {
        return ['name' => 'required', 'city_id' => 'required'];
    }
    public function mount()
    {
        $this->select_citites = City::latest()->pluck('name', 'id')->toArray();
    }
    public function render()
    {
        $neighborhoods = Neighborhood::withCount('users')->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%");
            }
        })->latest('id')->paginate();
        return view('livewire.admin.neighborhoods', compact('neighborhoods'))->extends('admin.layouts.admin')->section('content');
    }
}
