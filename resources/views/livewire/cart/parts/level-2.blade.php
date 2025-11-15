<div x-show="$wire.screen == 'level-2'" x-cloak x-transition:enter.duration.300ms>
    @php
    $isDigitalProducts = isset($cart->items[0]) ? $cart->items[0]->product->digital_product : 0;
    @endphp
    <div class="box-cart mb-3 mt-0">
        <div class="row">
            <div class="col-12">
                <div class="pay-methods">
                    @if (setting('is_clickpay_active'))
                    <button wire:click="$set('payment_method','clickpay')" @class([ 'img-holder text-nowrap py-4' , 'selected'=> $payment_method == 'clickpay',
                        ])>
                        <img src="{{ asset('front-asset/img/clickpay.svg') }}" alt="">
                    </button>
                    @endif
                    @if(!$isDigitalProducts)
                    <button wire:click="$set('payment_method','cash')" @class([ 'img-holder text-nowrap py-4' , 'selected'=> $payment_method == 'cash',
                        ])>
                        {{ __('cash on delivery') }}
                    </button>
                    @if ('is_banks_active')
                    <button wire:click="$set('payment_method','bank')" @class([ 'img-holder text-nowrap py-4' , 'selected'=> $payment_method == 'bank',
                        ])>
                        {{ __('bank transfer') }}
                    </button>
                    @endif
                    @endif


                    @if (setting('is_stc_active'))
                    <button wire:click="$set('payment_method','stc')" @class([ 'img-holder text-nowrap py-4' , 'selected'=> $payment_method == 'stc',
                        ])>
                        <img src="{{ asset('front-asset/img/stc.png') }}" alt="">
                    </button>
                    @endif
                    @if (setting('is_tamara_active'))
                    <button wire:click="$set('payment_method','tamara')" @class([ 'img-holder text-nowrap py-4' , 'selected'=> $payment_method == 'tamara',
                        ])>
                        <img src="{{ asset('front-asset/img/tamara.png') }}" alt="">
                    </button>
                    @endif
                </div>
                <x-admin-alert />
            </div>
        </div>
    </div>
    @include('livewire.cart.parts.methods.bank')


    @if ($payment_method == 'cash')
    <div class="alert-style orange">
        {{ __('A financial fee will be charged for the cash on delivery service') }}
        <!-- <i class="fa-solid fa-exclamation icon"></i> -->
        💴
    </div>
    @endif
    @if ($payment_method == 'stc')
    <div class="alert-style orange gap-1">
        {{ __('You can transfer directly to our mobile number') }}
        <!-- <i class="fa-solid fa-exclamation icon"></i> -->
        <a href="tel:{{ setting('phone') }}"class=' text-decoration-underline text-primary'>{{ setting('phone') }}</a>
    </div>
    @endif

    <div class="box-cart mb-3 mt-0">

        <div class="info-data">
            <span class="text">
                <i class="fa-solid fa-money-bill-wave"></i>
                {{ __('Products amount') }}
            </span>
            <span class="price">
                {{-- {{setting('currency')}} {{$cash_on_delivery_tax ?? 0}} --}}
                {{ setting('currency') }} {{ $subtotal }}
            </span>
        </div>


        <div class="info-data">
            <span class="text">
                <i class="fa-solid fa-dollar-sign"></i>
                {{ __('Value added tax') }}
            </span>
            <span class="price">
                {{-- {{setting('currency')}} {{$cash_on_delivery_tax ?? 0}} --}}
                {{ setting('currency') }} {{ $tax }}

            </span>
        </div>

        <div class="info-data">
            <span class="text">
                <i class="fa-solid fa-truck"></i>
                {{ __('shipping cost') }}
            </span>
            <span class="price">
                {{ setting('currency') }} {{ $shipping_price }}
            </span>
        </div>

        @if ($payment_method == 'cash')
        <div class="info-data" wire:transition>
            <span class="text">
                <i class="fa-solid fa-coins"></i>
                {{ __('Commission for payment on receipt') }}
            </span>
            <span class="price">
                {{ setting('currency') }} {{ $cash_on_delivery_tax ?? 0 }}
            </span>
        </div>
        @endif

        <div class="info-data">
            <span class="text">
                <i class="fa-solid fa-sack-dollar"></i>
                {{ __('Total') }}
            </span>
            <span class="price fs-4">
                {{ setting('currency') }} {{ $total }}
            </span>
        </div>
    </div>

    <div class="btn-holder d-flex justify-content-center gap-2 flex-wrap">
        <a wire:click="back" class="main-btn bg-secondary text-light ">
            {{ __('Back') }}
        </a>
        <div class="btn-holder d-flex justify-content-center">
            <a wire:click="submit" wire:loading.attr="disabled" class="main-btn text-light">
                {{ __('Complete the order') }}
                <i wire:loading wire:target="submit" class="fa-solid fa-circle-notch fa-spin"></i>
            </a>
        </div>
    </div>
</div>
