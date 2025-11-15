<div class="add-cart-holder">
    @if ($product->quantity > 0 || $product->digital_product)
        <button wire:click="add({{ $product->id }})" class="btn-whats-new">
            <i class="fas fa-plus"></i>
        </button>
    @else
        @if (setting('is_active_pre_order') && setting('pre_order_days'))
            <button wire:click="add({{ $product->id }}, true)" class="btn-whats-new">
                <i class="fas fa-plus"></i> حجز مسبق
            </button>
        @endif
    @endif
</div>
