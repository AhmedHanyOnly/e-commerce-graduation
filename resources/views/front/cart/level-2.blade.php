<div class="box-cart mb-3 mt-0">
    <div class="row">
        <div class="col-12">
            <div class="pay-methods">
                <button class="img-holder ">
                    <img loading="lazy" src="{{ asset('front-asset/img/visa.png') }}" alt="img">
                    |
                    <img loading="lazy" src="{{ asset('front-asset/img/Mastercard.png') }}" alt="img">
                    |
                    <img loading="lazy" src="{{ asset('front-asset/img/ApplePay.png') }}" alt="img">
                    |
                    <img loading="lazy" src="{{ asset('front-asset/img/amex.png') }}" alt="img">
                </button>
                <button class="img-holder text-nowrap py-4 selected">
                    خصم من الرصيد
                </button>
            </div>
            <x-admin-alert />

        </div>
        {{-- <div class="col-12">--}}
        {{-- <div class="input-group">--}}
        {{-- <input type="text" class="form-control discount" placeholder="ادخل كود الخصم اذا لديك"--}}
        {{-- aria-label="Username" aria-describedby="basic-addon1">--}}
        {{-- <button class="input-group-text" wire:click="applyCoupon()" id="basic-addon1">تطبيق</button>--}}
        {{-- </div>--}}
        {{-- </div>--}}
    </div>
</div>

<div class="box-cart mb-3 mt-0">
    <div class="info-data">
        <span class="text">
            <i class="fa-solid fa-credit-card"></i>
            رصيدي
        </span>
        <span class="price">
            {{setting('currency')}} {{auth()->user()->balance}}
        </span>
    </div>
    <div class="info-data">
        <span class="text">
            <i class="fa-solid fa-money-bill"></i>
            المجموع الفرعي
        </span>
        <span class="price">
            {{setting('currency')}} {{$cart->items()->sum('total')}}
        </span>
    </div>
    <div class="info-data">
        <span class="text">
            <i class="fa-solid fa-coins"></i>
            الضريبة
        </span>
        <span class="price">
            {{setting('currency')}} 0
        </span>
    </div>
    <div class="info-data">
        <span class="text">
            <i class="fas fa-cart-flatbed"></i>
            الشحن
        </span>
        <span class="price">
            {{setting('currency')}} 0
        </span>
    </div>
    <div class="info-data">
        <span class="text">
            <i class="fa-solid fa-sack-dollar"></i>
            المجموع الكلي
        </span>
        <span class="price fs-4">
            {{setting('currency')}} {{$cart->items()->sum('total')}}
        </span>
    </div>
</div>
<div class="btn-holder d-flex justify-content-center gap-2 flex-wrap">
    <a wire:click="back" class="btn-main grey">
        الرجوع
    </a>
    <div class="btn-holder d-flex justify-content-center">
        <a wire:click="submit" wire:loading.class="disabled" class="btn-main">
            اتمام الطلب
        </a>
    </div>
</div>