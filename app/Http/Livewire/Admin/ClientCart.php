<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ClientCart extends Component
{
    public $search ,$filter;

    public function render()
    {
        $carts = Cart::with('items')
            ->withCount('items')
            ->whereHas('items')
            ->where(function (Builder $query) {
                if ($this->search) {
                    $query->where('id', $this->search);
                }
                if ($this->filter == 'guest'){
                    $query->whereNull('user_id');
                }
                if ($this->filter == 'client'){
                    $query->whereNotNull('user_id');
                }
            })
            ->latest()
            ->paginate(10);
        return view('livewire.admin.client-cart', compact('carts'))
            ->extends('admin.layouts.admin')
            ->section('content');
    }
}
