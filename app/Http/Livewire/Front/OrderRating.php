<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rate;

class OrderRating extends Component
{
    public $order;
    public $ratings = [];
    public $comments = [];
    public $showModal = false;
    public $hasRated = false;

    protected $rules = [
        'ratings.*' => 'nullable|integer|between:1,5',
        'comments.*' => 'nullable|string|max:1000'
    ];

    public function mount($orderId)
    {
        $this->order = Order::with(['items.product'])->findOrFail($orderId);
        $this->initializeRatings();
        $this->checkIfRated();
    }

    public function initializeRatings()
    {
        foreach ($this->order->items as $item) {
            $this->ratings[$item->product_id] = null;
            $this->comments[$item->product_id] = '';
        }
    }

    public function checkIfRated()
    {
        $this->hasRated = $this->order->rates()->where('user_id', auth()->id())->exists();

        if ($this->hasRated) {
            $this->loadExistingRatings();
        }
    }

    public function loadExistingRatings()
    {
        $existingRates = Rate::where('user_id', auth()->id())
            ->where('order_id', $this->order->id)
            ->get()
            ->keyBy('item_id');

        foreach ($this->order->items as $item) {
            if (isset($existingRates[$item->product_id])) {
                $this->ratings[$item->product_id] = $existingRates[$item->product_id]->rate;
                $this->comments[$item->product_id] = $existingRates[$item->product_id]->comment ?? '';
            }
        }
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function setRating($itemId, $rating)
    {
        $this->ratings[$itemId] = $rating;
    }

    public function clearRating($itemId)
    {
        $this->ratings[$itemId] = null;
    }

    public function submitRatings()
    {
        if ($this->hasRated) {
            $this->dispatch('alert', type: 'info', message: 'You have already rated this order');
            return;
        }

        $this->validate();

        $hasRatings = false;

        foreach ($this->order->items as $item) {
            if (!empty($this->ratings[$item->product_id])) {
                $hasRatings = true;

                Rate::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'item_id' => $item->product_id,
                        'item_type' => Product::class,
                        'order_id' => $this->order->id
                    ],
                    [
                        'rate' => $this->ratings[$item->product_id],
                        'comment' => $this->comments[$item->product_id] ?? null,
                        'status' => 'pending',
                        'order_id' => $this->order->id
                    ]
                );
            }
        }

        if (!$hasRatings) {
            $this->dispatch('alert', type: 'error', message: 'Please rate at least one product');
            return;
        }

        $this->hasRated = true;
        $this->closeModal();
        $this->dispatch('alert', type: 'success', message: 'تم تقييم المنتجات بنجاح');
    }

    public function render()
    {
        return view('livewire.front.order-rating');
    }
}

