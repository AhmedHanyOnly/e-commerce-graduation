@extends('admin.layouts.admin')
@section('title', 'انشاء الطلب')

@section('content')
    <div class="main-side">
        <div class="row mt-4 g-3">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="box-order">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="title m-0">
                            عربة العميل
                        </div>
                    </div>
                    <div class="cart-product">
                        @foreach ($cart->items as $item)
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
                                            <span class="price">{{ number_format($item->qty * $item->sell_price, 2) }}
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
                            {{ $cart->client?->name }}

                            <div class="top">
                                <img loading="lazy" width="50"
                                    src="{{ $cart->client?->image ? display_file($cart->client?->image) : asset('admin-asset/img/no-image.jpeg') }}"
                                    alt="img">
                                <div class="content">
                                    <div class="name">
                                        {{ $cart->client?->name }}
                                    </div>
                                    <div class="desc">
                                        عدد الطلبات : {{ \App\Models\Order::whereClientId($cart->user_id)->count() }}
                                    </div>
                                    <div class="desc">
                                        <i class="fa-solid fa-phone me-2"></i>
                                        {{ $cart->client?->phone }}


                                    </div>
                                    <div class="desc">
                                        رصيد العميل:
                                        <span class="fw-bold">{{ $cart->client?->balance }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="md border-bottom-0 m-0">
                                <div class="text">
                                    <i class="fa-regular fa-envelope me-3 fs-6"></i>
                                    {{ $cart->client?->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
