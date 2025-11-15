<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductCategory;
use App\Traits\livewireResource;

class ProductCategories extends Component
{
    use livewireResource;

    public $name, $status, $search, $parent_id, $product_category, $image;

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
        $product_categories = ProductCategory::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })->paginate(10);
        $sub_categories = ProductCategory::whereNull('parent_id')->get();
        return view('livewire.admin.product_categories.index', compact('product_categories', 'sub_categories'))->extends('admin.layouts.admin')->section('content');
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
            $this->data['image'] = store_file($this->image, 'product_categories');
        } /*else {
            $this->data['image'] = $this->obj->image;
        }*/
    }


    public function itemId(ProductCategory $product_category)
    {
        $this->product_category = $product_category;
    }

    public function delete()
    {
        if ($this->product_category->image) {
            delete_file($this->product_category->image);
        }
        $this->product_category->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }
}
