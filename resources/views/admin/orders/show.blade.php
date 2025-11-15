@extends('admin.layouts.admin')
@section('title', 'انشاء الطلب')

@section('content')
    <div class="main-side">
        <div class="header-order ">
            <h1 class="title   ">
                الطلب
                {{ $order->number }}
            </h1>

            <div class="d-flex gap-3">
                <div class="date">
                    {{ format_date_time($order->created_at) }}
                </div>
                @if (!$order->paid_at && !$order->payment_status == '1')
                    <div class="status-order unpaid rounded-3">
                        غير مدفوع
                    </div>
                @else
                    <div class="status-order paid rounded-3">
                        مدفوع
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-4 g-3">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="box-order">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="title m-0">
                            عربة العميل
                        </div>
                        <div class="status-order  {{ $order->status }}">
                            {{ __($order->status) }}
                        </div>

                    </div>
                    <div class="cart-product">
                        @foreach ($order->items as $item)
                            <div class="product">
                                <img loading="lazy" width="50" src="{{ display_file($item->product?->image) }}"
                                    alt="img">
                                <div class="content">
                                    <div class="top">
                                        <div class="text">
                                            {{ $item->product?->name }}
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        @if ($item->color)
                                            <div class="items-holder">
                                                <span class="item">اللون:</span>
                                                <span class="count">{{ $item->color?->name }}</span>
                                            </div>
                                        @endif
                                        @if ($item->variant)
                                            <div class="items-holder">
                                                <span class="item">النوع:</span>
                                                <span class="count">{{ $item->variant?->name }}</span>
                                            </div>
                                        @endif
                                        <div class="items-holder">
                                            <span class="item">عدد:</span>
                                            <span class="count">{{ $item->qty }}</span>
                                        </div>
                                        <div class="price-holder">
                                            <span class="price">{{ $item->qty * $item->sell_price }}
                                                {{ setting('currency') }}</span>
                                            {{-- <span class="old">80$</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="box-order">
                    <div class="title">
                        العميل
                    </div>

                    <div class="customer-box">
                        <div class="info">


                            <div class="top">
                                <img loading="lazy" width="50"
                                    src="{{ $order->client?->image ? display_file($order->client?->image) : asset('admin-asset/img/no-image.jpeg') }}"
                                    alt="img">
                                <div class="content">
                                    <div class="name">
                                        {{ $order->client?->name }}
                                    </div>
                                    <div class="desc">
                                        عدد الطلبات : {{ \App\Models\Order::whereClientId($order->client_id)->count() }}
                                    </div>
                                    <div class="desc">
                                        <i class="fa-solid fa-phone me-2"></i>
                                        {{ $order->client?->phone }}


                                    </div>
                                </div>
                            </div>

                            <div class="md border-bottom-0 m-0">
                                <div class="text">
                                    <i class="fa-regular fa-envelope me-3 fs-6"></i>
                                    {{ $order->client?->email }}
                                </div>
                            </div>
                            {{-- <div class="md">
                            <div class="text mb-3">
                                <span class=" me-3"> التقييم :
                                </span> 4.5/5
                                <i class="fa-solid fa-star text-warning ms-2"></i>
                            </div>
                            <div class="title">
                                التعليقات
                            </div>
                            <div class="text">
                                هنا يكتب التعليق الخاص بالعميل و هذا كتابة اختبار للنص
                            </div>
                        </div> --}}
                            <div class="md">
                                <div class="text mb-3">
                                    <span class=" me-3"> التقييم :
                                    </span>
                                    @php
                                        $orderRates = $order->rates()->where('user_id', $order->client_id)->get();
                                        $avg = $orderRates->avg('rate');
                                    @endphp
                                    {{ $avg ? number_format($avg, 1) : '0.0' }}/5
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $avg)
                                            <i class="fa-solid fa-star text-warning ms-2"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning ms-2"></i>
                                        @endif
                                    @endfor
                                </div>


                                @if (count($orderRates) > 0)
                                    <div class="title">
                                        التعليقات
                                    </div>
                                    @foreach ($orderRates as $rating)
                                        <div class="text">
                                            {{ $rating->comment }}
                                        </div>
                                    @endforeach
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-12 col-md-6 col-lg-4"> --}}
            {{-- <div class="side-info-bar mb-3 box-order"> --}}
            {{-- <div class="title"> --}}
            {{-- معلومات المنتج --}}
            {{-- </div> --}}
            {{-- <ul class="sum-list mb-0"> --}}
            {{-- <li> --}}
            {{-- <div class="key"> --}}
            {{-- <span class="name"> الخصم</span> --}}
            {{-- </div> --}}
            {{-- <p class="value"> --}}
            {{-- لايوجد --}}
            {{-- </p> --}}
            {{-- </li> --}}
            {{-- <li> --}}
            {{-- <div class="key"> --}}
            {{-- <span class="name">سعر المنتج</span> --}}
            {{-- </div> --}}
            {{-- <p class="value">$ 133</p> --}}
            {{-- </li> --}}
            {{-- <li class="border-0"> --}}
            {{-- <div class="key"> --}}
            {{-- <span class="name">مبلغ الإدارة</span> --}}
            {{-- </div> --}}
            {{-- <p class="value">$ 20 </p> --}}
            {{-- </li> --}}
            {{-- <li class="border-0"> --}}
            {{-- <div class="key"> --}}
            {{-- <span class="name">نسبة التسليم</span> --}}
            {{-- </div> --}}
            {{-- <p class="value">$ 22</p> --}}
            {{-- </li> --}}
            {{-- <li class="border-0"> --}}
            {{-- <div class="key"> --}}
            {{-- <span class="name">الحالة</span> --}}
            {{-- </div> --}}
            {{-- <div class="status-order {{$order->status}} "> --}}
            {{-- {{__($order->status)}} --}}
            {{-- </div> --}}
            {{-- </li> --}}
            {{-- </ul> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="side-info-bar mb-3 box-order">
                    <div class="title">
                        ملخص
                    </div>
                    <ul class="sum-list mb-0">

                        <li>
                            <div class="key">
                                <span class="name">المجموع قبل الضريبة</span>
                            </div>

                            <p class="value">{{ setting('currency') }} {{ $order->subtotal ?? 0 }}</p>
                        </li>
                        <li>
                            <div class="key">
                                <span class="name">الضريبة</span>
                            </div>
                            <p class="value">{{ setting('currency') }} {{ $order->tax ?? 0 }}</p>
                        </li>
                        <li>
                            <div class="key">
                                <span class="name">الشحن</span>
                            </div>
                            <p class="value">{{ setting('currency') }} {{ $order->shipping_price ?? 0 }}</p>
                        </li>
                        <li>
                            <div class="key">
                                <span class="name">ضريبة التوصيل</span>
                            </div>
                            <p class="value">{{ setting('currency') }} {{ $order->shipping_tax ?? 0 }}</p>
                        </li>
                        @if ($order->payment_method == 'cash')
                           <li>
                            <div class="key">
                                <span class="name"> {{ __('Commission for payment on receipt') }}</span>
                            </div>
                            <p class="value">{{ setting('currency') }} {{ $cash_on_delivery_tax ?? 0 }}
</p>
                        </li>
                                @endif

                        <li>
                            <div class="key">
                                <span class="name fw-bold">طريقة الدفع</span>
                            </div>
                            <p class="value fw-bold">{{ __($order->payment_method) }}</p>
                        </li>

                        <li>
                            <div class="key">
                                <span class="name fw-bold">المجموع الكلي</span>
                            </div>
                            <p class="value fw-bold">{{ setting('currency') }} {{ $order->total ?? 0 }}</p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
