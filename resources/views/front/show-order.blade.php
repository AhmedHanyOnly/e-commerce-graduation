@extends('front.layouts.front')
@section('title', 'تفاصيل الطلب #' . $order->number)
@section('content')

    <section id='prt-content' class="main-section order-show-section">
        <div class="container-xxl">
            <div class="order-title">
                {{ __('order details') }} #{{ $order->number }}
            </div>
            <div class="box-date mb-3 ">
                <div class="date">
                    <div class="title">
                        {{ __('invoice number') }}
                    </div>
                    <b class="name-date">
                        #{{ $order->number }}
                    </b>
                </div>
                <div class="date">
                    <div class="title">
                        {{ __('tax number') }}
                    </div>
                    <b class="name-date">
                        {{ setting('tax_number') }}
                    </b>
                </div>

            </div>
            <div class="box-date mb-3 align-items-md-baseline flex-column flex-md-row align-items-start flexed-print">
                <div class="date flex-md-grow-1">
                    <div class="title">
                        {{ __('Sourced from:-') }}
                    </div>
                    <b class="name-date d-block">
                        {{ setting('website_name') }}
                    </b>
                    <b class="name-date d-block">
                        {{ setting('email') }}
                    </b>
                    <b class="name-date d-block">
                        {{ setting('phone') }}
                    </b>
                </div>
                <div class="date flex-md-grow-1">
                    <div class="title">
                        {{ __('Source to:-') }}
                    </div>
                    <b class="name-date d-block">
                        {{ $order->client?->name }}
                    </b>
                    <b class="name-date d-block">
                        {{ $order->client?->phone }}
                    </b>
                </div>
            </div>

            <div class="box-date mb-5 flex-wrap gap-5">
                <div class="date">
                    <div class="title">
                        {{ __('order date') }}
                    </div>
                    <b class="name-date">
                        {{ $order->created_at->translatedFormat('d M Y') }}
                    </b>
                </div>
                <div class="date">
                    <div class="title">
                        {{ __('amount') }}
                    </div>
                    <b class="name-date">
                        {{ $order->total }} {{ setting('currency') }}
                    </b>
                </div>
                <div class="date">
                    <div class="title">
                        {{ __('payment method') }}
                    </div>
                    <b class="name-date">
                        {{ __($order->payment_method) }}
                    </b>
                </div>
                <div
                    class="status-order
                        {{ $order->status === 'accepted' ? 'text-success' : ($order->status === 'done' ? 'text-primary' : ($order->status === 'refused' ? 'text-danger' : 'text-warning')) }}">
                    @if ($order->status === 'accepted')
                        <i class="fa-solid fa-check"></i>
                    @elseif($order->status === 'done')
                        <i class="fa-solid fa-check-circle"></i>
                    @elseif($order->status === 'refused')
                        <i class="fa-solid fa-x"></i>
                    @else
                        <i class="fa-solid fa-clock"></i>
                    @endif
                    {{ __($order->status) }}
                </div>
                @if ($order->refused_reason)
                    <h6>{{ __('Reason for rejection:') }} {{ $order->refused_reason }}</h6>
                @endif
                @if ($order->status == 'done' || $order->status == 'accepted')
                    <button class="main-btn white not-print " onclick="window.print()" id='btn-prt-content'>
                        <i class="fa-solid fa-print"></i>
                        {{ __('print') }}
                    </button>
                @endif
            </div>
            <x-message-admin></x-message-admin>
            <div class="box-payment mb-3">
                <div class="content">
                    @foreach ($order->items as $item)
                        <div class="card-product d-flex justify-content-between  align-items-center flex-wrap">
                            <div class=" d-flex gap-3 align-items-center flex-wrap justify-content-center card-holder ">
                                @if (!$item->product->image)
                                    <img src="{{ asset('front-asset/img/image-preview.webp') }}" class="pr-img" alt="img">
                                @else
                                    <img src="{{ display_file($item->product->image) }}" alt="" class="pr-img">
                                @endif
                                <div class="text">
                                    <div class="name">
                                        {{ $item->product->name }}
                                    </div>
                                    <div class="d-flex gap-3">
                                        <div class="price">
                                            {{ __('quantity') }} : {{ $item->qty }}
                                        </div>
                                        <div class="price">
                                            {{ __('Price') }} : {{ $item->sell_price }}
                                        </div>
                                        <div class="price">
                                            {{ __('admin.Total_egmal') }} : {{ $item->sell_price * $item->qty }} {{ __('SAR') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($order->status == 'done')
                                @if (!$item->product->is_rated_by_this_user(auth()->id()))
                                    <button class="main-btn not-print" data-bs-toggle="modal"
                                        data-bs-target="#rate-product-{{ $item->product->id }}">
                                        {{ __('Rate') }}
                                    </button>
                                    <div class="modal fade" id="rate-product-{{ $item->product->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('products.storeRate', $item->product->id) }}" method="post">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ __('product rating') }} #{{ $item->product->id }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="box-model-rate">
                                                            <img src="{{ $item->product->image ? display_file($item->product->image) : asset('front-asset/img/image-preview.webp') }}" alt="img" class="pr-img">
                                                            <h6 class="title">{{ __('Your rating for the product?') }}</h6>
                                                            <div class="stars-holder">
                                                                <div class="rate-model">
                                                                    <input type="radio" id="star-pr-1" class="rate-model"
                                                                        name="rate" value="5" />
                                                                    <label for="star-pr-1" title="5"></label>

                                                                    <input type="radio" id="star-pr-2" class="rate-model"
                                                                        name="rate" value="4" />
                                                                    <label for="star-pr-2" title="4"></label>

                                                                    <input type="radio" id="star-pr-3" class="rate-model"
                                                                        name="rate" value="3" />
                                                                    <label for="star-pr-3" title="3"></label>

                                                                    <input type="radio" id="star-pr-4"
                                                                        class="rate-model" name="rate" value="2">
                                                                    <label for="star-pr-4" title="2"></label>

                                                                    <input type="radio" id="star-pr-5"
                                                                        class="rate-model" name="rate"
                                                                        value="1" />
                                                                    <label for="star-pr-5" title="1"></label>
                                                                </div>
                                                            </div>
                                                            <textarea name="comment" class="form-control" id="" rows="2" placeholder='اضف رأيك علي المنتج'></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="main-btn">{{ __('product rating') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach

                    <div class="item">
                        <div class="title">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            {{ __('quantity') }}
                        </div>
                        <div class="num">
                            {{ $order->items->sum('qty') }}
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            {{ __('Products amount') }}
                        </div>
                        <div class="num">
                            {{ $order->subtotal }} {{ __('SAR') }}
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">
                            <i class="fa-solid fa-dollar-sign"></i>
                            {{ __('Value Added Tax') }}
                        </div>
                        <div class="num">
                            {{ $order->tax }} {{ __('SAR') }}
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">
                            <i class="fa-solid fa-truck"></i>
                            {{ __('Shipping cost') }}
                        </div>
                        <div class="num">
                            {{ $order->shipping_price }} {{ __('SAR') }}
                        </div>
                    </div>  @if ($order->payment_method == 'cash')
       <div class="item">
                        <div class="title">
                            <i class="fa-solid fa-truck"></i>
            {{ __('Commission for payment on receipt') }}
           </div>
                        <div class="num">
                {{ setting('currency') }} {{ $cash_on_delivery_tax ?? 0 }}
            </span>
        </div>
        </div>

        @endif

                    <!-- <div class="item">
                        <div class="title">
                            ضريبة الشحن
                        </div>
                        <div class="num">
                            {{ $order->shipping_tax }} ر.س
                        </div>
                    </div> -->
                    <div class="item">
                        <div class="title">
                            <i class="fa-solid fa-sack-dollar"></i>
                            {{ __('Total') }}
                        </div>
                        <div class="num">
                            {{ $order->total }} {{ __('SAR') }}
                        </div>
                    </div>
                </div>
                @if ($order->status == 'done' && $item->product->barcode)
                    <div class="box-product-number ">
                        <div class="text" id='product-number-text'>
                            <i class="fa-regular fa-credit-card"></i>
                            {{ $item->product->barcode }}
                        </div>
                        <button onclick="copyText()" class="main-btn white not-print">
                            <i class="fa-solid fa-copy"></i>
                            {{ __('copy') }}
                        </button>
                    </div>
                @endif
            </div>
            <div class="box-date mb-3">
                <div class="date flex-grow-1">
                    <div class="title mb-3">
                        {{ __('Contact information:-') }}
                    </div>
                    <b class="name-date d-block mb-2 ">
                        {{ setting('website_name') }}
                    </b>
                    <b class="name-date d-block">
                        {{ setting('phone') }}
                    </b>
                </div>
            </div>
        </div>
    </section>
    <script>
        function copyText() {
            var divText = document.getElementById("product-number-text").innerText;
            var tempTextArea = document.createElement("textarea");
            tempTextArea.value = divText;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            document.execCommand("copy");
            document.body.removeChild(tempTextArea);
            alert("تم نسخ النص: " + divText);
        }
    </script>
@endsection
