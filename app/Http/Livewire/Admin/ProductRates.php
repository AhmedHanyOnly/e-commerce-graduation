<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Rate;
use Livewire\Component;

class ProductRates extends Component
{
    public $product, $filter_status;

    public function mount(Product $product)
    {
        $this->product = $product;
    }
    public function render()
    {
        $rates = $this->product->rates()->where(function ($q) {
            if ($this->filter_status) {
                $q->where('status', $this->filter_status);
            }
        })->paginate(10);
        $all =$this->product->rates()->count();
        $pending =$this->product->rates()->where('status','pending')->count();
        $accepted =$this->product->rates()->where('status','accepted')->count();
        $rejected =$this->product->rates()->where('status','rejected')->count();
        return view('livewire.admin.product-rates', compact(
            'rates',
            'pending',
            'accepted',
            'rejected',
            'all'
        ))->extends('admin.layouts.admin')->section('content');
    }

    public function approve(Rate $rate)
    {
        $rate->update(['status' => 'accepted', 'reject_reason' => null]);
        return back()->with('success', 'تم قبول التعليق');
    }
    public function reject(Rate $rate)
    {
        $rate->update(['status' => 'rejected']);
        return back()->with('success', 'تم رفض التعليق');
    }
}
