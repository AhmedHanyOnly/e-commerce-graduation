<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductType;
use App\Traits\livewireResource;

class ProductTypes extends Component
{
    use livewireResource;

    public $name, $status, $search, $parent_id, $product_type, $image;

    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'nullable|image',
            'parent_id' => 'nullable',
            'status' => 'required',
        ];
    }

    public function render()
    {
        $product_types = ProductType::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })->paginate(10);
        $sub_types = ProductType::whereNull('parent_id')->get();
        return view('livewire.admin.product_types.index', compact('product_types', 'sub_types'))->extends('admin.layouts.admin')->section('content');
    }

    public function whileEditing()
    {
        $this->image = '';
    }

    public function beforeSubmit()
    {
        if ($this->image) {
            if ($this->obj) {
                delete_file($this->obj->image);
            }
            $this->data['image'] = store_file($this->image, 'product_types');
        } else {
            $this->data['image'] = $this->obj?->image;
        }
    }


    public function itemId(ProductType $product_type)
    {
        $this->product_type = $product_type;
    }

    public function delete()
    {
        if ($this->product_type->image) {
            delete_file($this->product_type->image);
        }
        $this->product_type->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }
}
