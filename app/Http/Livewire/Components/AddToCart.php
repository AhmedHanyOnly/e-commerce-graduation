<?php

namespace App\Http\Livewire\Components;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.components.add-to-cart');
    }

    public function add($id, $is_pre_order = false)
    {
        CartService::addToCart($this->product->id, is_pre_order: $is_pre_order);
        $this->dispatch('alert', type: 'success', message: 'تم الاضافة للكارت بنجاح');
        $this->dispatch('productAdded');
    }
}
