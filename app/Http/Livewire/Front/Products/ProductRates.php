<?php

namespace App\Http\Livewire\Front\Products;

use App\Models\Product;
use Livewire\Component;

class ProductRates extends Component
{
    public $product;
    public $averageRating;
    public $totalRatings;
    public $ratingDistribution;
    public $rates;

    public $newRating = [
        'rate' => 0,
        'comment' => ''
    ];

    public $ratingSuccess = false;
    public $hasRated = false;

    protected $rules = [
        'newRating.rate' => 'required|integer|between:1,5',
        'newRating.comment' => 'nullable|string|max:1000'
    ];

    public function messages(){
        return[
            'newRating.rate.required' => 'يرجى تقييم المنتج',
            'newRating.rate.between' => 'يرجى التقييم من 1 الى 5',
        ];
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->loadRatings();

        if (auth()->check()) {
            $this->hasRated = $product->rates()
                ->where('user_id', auth()->id())
                ->exists();
        }
    }

    public function loadRatings()
    {
        $this->rates = $this->product->rates()
            ->whereIn('status', ['accepted', 'pending'])
            ->with('user')
            ->latest()
            ->get();

        $this->totalRatings = $this->rates->count();
        $this->averageRating = $this->rates->avg('rate') ?? 0;

        $this->ratingDistribution = [
            5 => $this->rates->where('rate', 5)->count(),
            4 => $this->rates->where('rate', 4)->count(),
            3 => $this->rates->where('rate', 3)->count(),
            2 => $this->rates->where('rate', 2)->count(),
            1 => $this->rates->where('rate', 1)->count()
        ];
    }

    public function submitRating()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        $rating = $this->product->rates()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'rate' => $this->newRating['rate'],
                'comment' => $this->newRating['comment'],
                'status' => 'pending' 
            ]
        );

        $this->loadRatings();
        $this->hasRated = true;
        $this->dispatch('alert', type: 'success', message: 'تم التقييم بنجاح');
        $this->reset('newRating');
    }

    public function render()
    {
        return view('livewire.front.products.product-rates');
    }
}
