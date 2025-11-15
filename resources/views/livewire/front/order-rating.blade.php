<div>
    <button type="button" class="btn btn-primary" wire:click="openModal">
        {{ $hasRated ? __('View Ratings') : __('Rate Products') }}
    </button>

    @if($showModal)
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $hasRated ? __('Your Ratings for Order #') : __('Rate Products in Order #') }}{{
                        $order->number }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-message-admin />
                    @foreach ($order->items as $item)
                    @if($item->product)
                    <div class="product-rating-item mb-4 p-3 border rounded">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ $item->product->image }}" class="me-3" width="60" height="60"
                                alt="{{ $item->product->name }}">
                            <h6 class="mb-0">{{ $item->product->name }}</h6>
                        </div>
                        <div class="rating-stars mb-2">
                            @for ($i = 1; $i <= 5; $i++) <button type="button"
                                wire:click="setRating({{ $item->product_id }}, {{ $i }})"
                                class="star {{ isset($ratings[$item->product_id]) && $ratings[$item->product_id] >= $i ? 'active' : '' }}"
                                @if($hasRated) disabled @endif>
                                ★
                                </button>
                                @endfor
                        </div>
                        <div class="form-group">
                            <textarea wire:model="comments.{{ $item->product_id }}" class="form-control" rows="2"
                                placeholder="{{ __('Your comment (optional)') }}" @if($hasRated) readonly
                                @endif></textarea>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">
                        {{ __('Close') }}
                    </button>
                    @if(!$hasRated)
                    <button type="button" class="btn btn-primary" wire:click="submitRatings">
                        {{ __('Submit Ratings') }}
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        .rating-stars {
            font-size: 24px;
            line-height: 1;
        }

        .rating-stars .star {
            cursor: pointer;
            color: #ddd;
            display: inline-block;
            margin-right: 5px;
            background: none;
            border: none;
            padding: 0;
            transition: color 0.2s;
        }

        .rating-stars .star:hover {
            color: #ffb400;
        }

        .rating-stars .star.active {
            color: #ffc107;
        }

        .product-rating-item {
            background-color: #f8f9fa;
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .modal {
            z-index: 1050;
        }
    </style>
</div>