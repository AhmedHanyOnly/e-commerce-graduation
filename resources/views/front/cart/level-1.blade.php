<div>
    <!-- Products -->
    <div class="d-flex flex-column gap-2 mb-3">
        <x-admin-alert />
        @foreach($cart->items as $item)
        <div class="box-cart my-0">
            <div class="info-prop">
                <div class="prop">
                    <img loading="lazy" width="50" src="{{ $item->product->image ? display_file($item->product->image) : asset('front-asset/img/image-preview.webp') }}" alt="صورة المنتج">
                    <div class="text">
                        <span class="title">{{$item->product?->name}}</span>
                        <span class="price">{{$item->product?->sell_price}} {{setting('currency')}}</span>
                        <span class="total"> المبلغ الكلي {{$item->total}} {{setting('currency')}} </span>
                    </div>
                </div>
                <button wire:click="remove({{$item->id}})" type="button" class="btn-options close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="control mb-0 mt-2">
                <div class="title">
                    الكمية
                    <span class="text-danger">*</span>
                </div>
                <div class="count">
                    <button wire:click="increment({{$item->id}})" class="increment">
                        +
                    </button>
                    <span class="val">{{$item->qty}}</span>
                    <button wire:click="decrement({{$item->id}})" class="decrement">
                        -
                    </button>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <!-- Form Data -->
    <div class="box-cart mb-3 mt-0">
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <label class="m-2 small-label">الاسم الاول</label>
                <input type="text" wire:model="first_name" required placeholder="الاسم الاول*" class="form-control">
            </div>
            <div class="col-12 col-lg-6">
                <label class="m-2 small-label">اسم العائلة</label>
                <input type="text" wire:model="last_name" required placeholder="اسم العائلة*" class="form-control">
            </div>
            <div class="col-12">
                <label class="m-2 small-label">رقم الهاتف</label>
                <div class="d-flex align-items-center gap-2">
                    <select class="form-select w-auto" wire:model="phone_code">
                        <option>اختر الدولة</option>
                        <option value="20">
                            +20 - (مصر)
                        </option>
                        <option value="966">
                            +966 - (السعودية)
                        </option>
                    </select>
                    <input type="text" wire:model="additional_phone" required placeholder="{{ __('رقم الهاتف') }}*" class="form-control flex-fill">
                </div>
            </div>
            <div class="col-6">
                <label class="mb-2 small-label">عنوان التوصيل</label>
                <input class="form-control" wire:model="address" required placeholder="العنوان" type="text">
            </div>
            <div class="col-6">
                <label class="mb-2 small-label">وقت التسليم</label>
                <input class="form-control" wire:model="delivery_time" placeholder="وقت التسليم" type="datetime-local">
            </div>

            <div class="col-12">
                <!-- map -->
                <div class="mb-0" wire:ignore>
                    <div id="map" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Prices -->
    <div class="box-cart mb-3 mt-0">
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
    <div class="d-flex justify-content-center">
        <a wire:click="changeScreen" class="btn-main mx-auto">
            التالي
        </a>
    </div>

</div>
