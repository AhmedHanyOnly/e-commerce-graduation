<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class CartIcon extends Component
{
    protected $listeners = ['productAdded' => '$refresh'];

    public function render()
    {
        return view('livewire.components.cart-icon');
    }
}
