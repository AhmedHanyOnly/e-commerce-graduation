<div x-show="$wire.screen == 'level-1'" x-transition:enter.duration.300ms>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="d-flex flex-column gap-2 mb-3">
                <x-admin-alert />
                @foreach ($cart->items as $item)
                    <div class="box-cart my-0">
                        <div class="info-prop gap-5">
                            <div class="prop">
                                <img loading="lazy" width="50"
                                    src="{{ $item->product->image ? display_file($item->product->image) : asset('front-asset/img/image-preview.webp') }}"
                                    alt="صورة المنتج">
                                <div class="text">
                                    <span class="title">{{ $item->product?->name }}</span>
                                    <span class="price"> {!! money($item->sell_price) !!} </span>
                                </div>
                            </div>

                            <button wire:click="remove({{ $item->id }})" type="button" class="btn-options close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @if ($item->is_pre_order)
                            <span class="badge bg-primary text-end">{{ __('Pre-Order') }}</span>
                        @endif
                        <div class="control mb-0 mt-2">
                            @if (!$item->product->digital_product)
                                <div class="count">
                                    <button wire:click="increment({{ $item->id }})" class="increment">
                                        +
                                    </button>
                                    <span class="val">{{ $item->qty }}</span>
                                    <button wire:click="decrement({{ $item->id }})" class="decrement">
                                        -
                                    </button>
                                </div>
                            @else
                                <div class="count">
                                    <span class="val">{{ $item->qty }}</span>
                                </div>
                            @endif
                            @if ($item->product->variants()->exists())
                                <div>
                                    <select class="form-select px-3 ps-5"
                                        wire:model.live="selectedSizes.{{ $item->id }}"
                                        id="size_{{ $item->id }}" wire:change="updateSize({{ $item->id }})">
                                        <option value="">{{ __('Select Size') }}</option>
                                        @foreach ($item->product->variants as $variant)
                                            <option value="{{ $variant->id }}">{{ $variant->size?->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @php
                                if (isset($selectedSizes[$item->id])) {
                                    $colors = \App\Models\ProductColor::where(
                                        'variant_id',
                                        $selectedSizes[$item->id],
                                    )->get();
                                } else {
                                    $colors = \App\Models\ProductColor::where('product_id', $item->product_id)->get();
                                }
                            @endphp

                            @if (setting('product_colors_active'))
                                @if ($colors->count())
                                    <div>
                                        <select class="form-select px-3 ps-5"
                                            wire:model="selectedColors.{{ $item->id }}"
                                            id="color_{{ $item->id }}"
                                            wire:change="updateColor({{ $item->id }})">
                                            <option value="">{{ __('Choose color') }}</option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->color?->id }}">{{ $color->color?->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif


                            <span class="total"> {{ __('Total:') }} <span class="price-gl">
                                    {!! money($item->total - $item->tax) !!}</span> </span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="box-cart mb-3 mt-0">
                <div class="title fs-5 fw-bold p-3">
                    {{ __('order summary') }}
                </div>
                <div class="info-data">
                    <span class="text">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        {{ __('Products amount') }}
                    </span>
                    <span class="price">
                        {{--   {!! money$cash_on_delivery_taxtax)  !!} 0}} --}}
                        {!! money($subtotal) !!}
                    </span>
                </div>
                <div class="info-data">
                    <span class="text">
                        <i class="fa-solid fa-dollar-sign"></i>
                        {{ __('Value added tax') }}
                    </span>
                    <span class="price">
                        {!! money($tax) !!}
                    </span>
                </div>
                <div class="info-data">
                    <span class="text">
                        <i class="fa-solid fa-truck"></i>
                        {{ __('shipping cost') }}
                    </span>
                    <span class="price">
                        {!! money($shipping_price) !!}
                    </span>
                </div>
                <div class="info-data">
                    <span class="text">
                        <i class="fa-solid fa-sack-dollar"></i>
                        {{ __('Total') }}
                    </span>
                    <span class="price fs-4">
                        {!! money($total) !!}
                    </span>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <a wire:click="submit"
                       wire:loading.attr="disabled"
                       wire:loading.class="pe-none"
                       class="main-btn w-100 rounded-1 text-light d-flex align-items-center justify-content-center">

                        <!-- Loading Spinner -->
                        <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>

                        <!-- Button Text -->
                        <span wire:loading.remove wire:target="submit">{{ __('Complete the order') }}</span>
                        <span wire:loading wire:target="submit">{{ __('Processing...') }}</span>
                    </a>
                </div>
            </div>

        </div>
    </div>


</div>
