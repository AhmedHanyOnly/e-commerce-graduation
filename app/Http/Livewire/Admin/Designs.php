<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Design;
use App\Models\Product;
use App\Traits\livewireResource;
use Livewire\Component;

class Designs extends Component
{
    use livewireResource;
    public $name ,$description,$image;

    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'nullable',
            // 'category_id' => 'required|exists:categories,id',
            'description' => 'nullable'
        ];
    }
    public function beforeSubmit()
    {
        if ($this->image) {
            if ($this->obj) {
                if ($this->obj->image !== $this->image) {
                    delete_file($this->obj->image);
                    $this->data['image'] = store_file($this->image, 'designs');
                }
            } else {
                $this->data['image'] = store_file($this->image, 'designs');
            }
        }
    }

    public function render()
    {
        $designs =Design::all();
        return view('livewire.admin.designs',compact('designs'))->extends('admin.layouts.admin')->section('content');
    }
}
