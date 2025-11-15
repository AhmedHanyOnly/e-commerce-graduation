<?php

namespace App\Http\Livewire\Admin;

use App\Models\Size;
use App\Traits\livewireResource;
use Livewire\Component;

class Sizes extends Component
{
    use livewireResource;
    public $name ,$active;
    public $search = '';
    public function rules()
    {
        return[
            'name' => 'required',
            'active' =>'required'
        ];
    }
    public function render()
    {
 $sizes = Size::query()
        ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
        ->latest()
        ->paginate(10);        return view('livewire.admin.sizes.index',compact('sizes'))
            ->extends('admin.layouts.admin')
            ->section('content');
    }
}
