<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use App\Traits\livewireResource;
use Livewire\Component;

class Colors extends Component
{
    use livewireResource;
    public $name ;
    public $search = '';
    public function rules()
    {
        return ['name' =>'required'];
    }
    public function render()
    {
   $colors = Color::latest()
        ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
        ->paginate(10);
                return view('livewire.admin.colors',compact('colors'))
            ->extends('admin.layouts.admin')
            ->section('content')
            ;
    }
}
