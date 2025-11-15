@extends('front.layouts.front')
@section('content')
@section('title','سلة التسوق')
<div class="main-section bg-white">
    <div class="container">
        <h5 class="main-title">سلة التسوق</h5>
        <!-- Status Bar -->

        <ul class="bar-transaction-status pt-4 ">
            <li class="active step-one ">
                البيانات
                <span class="circle"><i class="fa-solid fa-check checked"></i></span>
            </li>
            <li class="">
                الدفع
                <span class="circle"><i class="fa-solid fa-check  "></i></span>
            </li>
        </ul>

        <div>
            <!-- Products -->
            <div class="d-flex flex-column gap-2 mb-3">
                <div class="box-cart my-0">
                    <div class="info-prop">
                        <div class="prop">
                            <img loading="lazy" width="50" src="{{ asset('front-asset/img/image-preview.webp') }}" alt="صورة المنتج">
                            <div class="text">
                                <span class="title">اسم المنتج</span>
                                <span class="price">20 </span>
                                <span class="total"> المبلغ الكلي 100 </span>
                            </div>
                        </div>
                        <button type="button" class="btn-options close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="control mb-0 mt-2">
                        <div class="title">
                            الكمية
                            <span class="text-danger">*</span>
                        </div>
                        <div class="count">
                            <button class="increment">
                                +
                            </button>
                            <span class="val">0</span>
                            <button class="decrement">
                                -
                            </button>
                        </div>
                    </div>
                </div>

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
                        100
                    </span>
                </div>
                <div class="info-data">
                    <span class="text">
                        <i class="fas fa-cart-flatbed"></i>
                        الشحن
                    </span>
                    <span class="price">
                        $ 0
                    </span>
                </div>
                <div class="info-data">
                    <span class="text">
                        <i class="fa-solid fa-sack-dollar"></i>
                        المجموع الكلي
                    </span>
                    <span class="price fs-4">
                        100$
                    </span>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a wire:click="changeScreen" class="main-btn text-light mx-auto">
                    التالي
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
