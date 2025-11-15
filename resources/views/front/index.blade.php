@extends('front.layouts.front')
@section('title', 'الرئيسية')
@section('content')
<!-- Start swiper -->
{{-- <x-admin-alert /> --}}

@if (!$sliders->isEmpty() && setting('is_slider_active'))
<div class="swiper mySwiper swiper-landing">
    <div class="swiper-wrapper">
        @foreach ($sliders as $slider)
        <div class="swiper-slide">
            <img src="{{ display_file($slider->cover) }}" />
            <div class="container">
                <div class="box-intro">
                    <p class="title" data-swiper-parallax="-1000"> {{ $slider->title }} </p>
                    <h2 class="des mb-5" data-swiper-parallax="-1500">
                        {{ $slider->subtitle }}
                    </h2>
                    @if ($slider->link)
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <a href="{{ $slider->link }}" class="btn-shop py-md-3 px-md-5 fs-md-4">
                            {{ __('Shop Now') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
@endif
<!-- End swiper -->
<section class="mt-5 ">
    <div class="container-xxl">
        <div class="main-title">{{ __('Latest Products') }}</div>
        <div class="main-desc">{{ __('Store (store) provided you with international products of high quality') }}</div>
        <div class="swiper mySwiper product-slider">
            <div class="swiper-wrapper">
                @foreach ($latest_products as $latest)
                <div class="swiper-slide">
                    <div class="product-card">
                        <!-- Badges Section -->
                        <div class="badge-container">
                            @if ($latest->discount_percentage)
                            <span class="badge badge-discount">{{ $latest->discount_percentage }}%
                                {{ __('Discount') }}</span>
                            @endif
                            @if ($latest->quantity == 0 && !$latest->digital_product)
                            <span class="badge badge-stock">{{ __('Out of Stock') }}</span>
                            @endif
                            @if ($latest->is_new)
                            <span class="badge badge-new">{{ __('New') }}</span>
                            @endif
                        </div>

                        <!-- Product Image with Link -->
                        <a href="{{ route('products.show', $latest->id) }}" class="product-image-container">
                            <img src="{{ display_file($latest->image) }}" class="product-image"
                                alt="{{ $latest->name }}" />
                        </a>

                        
                        <!-- Product Details -->
                        <div class="product-details">
                            <!-- Category -->
                            <div class="product-category">
                                <i class="fas fa-tag"></i> {{ $latest->category->name ?? __('Uncategorized') }}
                            </div>

                            <!-- Product Name -->
                            <a href="{{ route('products.show', $latest->id) }}" class="product-title">
                                <h3>{{ Str::limit($latest->name, 50) }}</h3>
                            </a>

                            <!-- Product Description (truncated) -->
                            <div class="product-description">
                                {{ \Illuminate\Support\Str::limit(strip_tags($latest->description), 70) }}
                            </div>

                            <!-- Price Section -->
                            <div class="product-price">
                                @if ($latest->discounted_price)
                                <span class="original-price">{{ $latest->sell_price }} {{ setting('currency') }}</span>
                                <span class="discounted-price">{{ $latest->discounted_price }} {{ setting('currency') }}</span>
                                @else
                                <span class="regular-price">{{ $latest->sell_price }} {{ setting('currency') }}</span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="product-actions">
                                @livewire('components.add-to-cart', ['product' => $latest])
                                <a href="{{ route('products.show', $latest->id) }}"
                                    class="btn-details">{{ __('Details') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>

 @if ($banner && $banner->image_one)
<section class="main-ad">
    <img src="{{ display_file($banner->image_one) }}" alt="" />
</section>
@else
@if (setting('enable_default_banner'))
<section class="main-ad">
    <img src="{{ asset('front-asset/img/ad-1.svg') }}" alt="" />
</section>
@endif
@endif
@if (setting('most_sold_products') == 1)
<section class="mb-5">
    <div class="container-xxl">
        <div class="main-title">{{ __('Best Sellers') }}</div>
        <div class="main-desc">{{ __('Store (store) provided you with international products of high quality') }}</div>
        <div class="swiper mySwiper product-slider">
            <div class="swiper-wrapper">
                @foreach ($most_sold_products as $sold)
                <div class="swiper-slide">
                    <div class="product-card">
                        <!-- حاوية الشارات -->
                        <div class="badge-container">
                            @if ($sold->discount_percentage)
                            <span class="badge badge-discount">{{ $sold->discount_percentage }}%
                                {{ __('Discount') }}</span>
                            @endif
                            @if ($sold->quantity == 0 && !$sold->digital_product)
                            <span class="badge badge-stock">{{ __('Out of Stock') }}</span>
                            @endif
                            @if ($sold->is_new)
                            <span class="badge badge-new">{{ __('New') }}</span>
                            @endif
                        </div>

                        <a href="{{ route('products.show', $sold->id) }}" class="product-image-container">
                            <img src="{{ display_file($sold->image) }}" class="product-image" alt="{{ $sold->name }}" />
                        </a>

                        <div class="product-details">
                            <div class="product-category">
                                <i class="fas fa-tag"></i> {{ $sold->category->name ?? __('Uncategorized') }}
                            </div>

                            <a href="{{ route('products.show', $sold->id) }}" class="product-title">
                                <h3>{{ Str::limit($sold->name, 50) }}</h3>
                            </a>

                            <div class="product-description">
                                {{ \Illuminate\Support\Str::limit(strip_tags($sold->description), 70) }}
                            </div>

                            <div class="product-price">
                                @if ($sold->discounted_price)
                                <span class="original-price">{{ $sold->sell_price }} {{ setting('currency') }}</span>
                                <span class="discounted-price">{{ $sold->discounted_price }} {{ setting('currency') }}</span>
                                @else
                                <span class="regular-price">{{ $sold->sell_price }} {{ setting('currency') }}</span>
                                @endif
                            </div>

                            <div class="product-actions">
                                @livewire('components.add-to-cart', ['product' => $sold])
                                <a href="{{ route('products.show', $sold->id) }}"
                                    class="btn-details">{{ __('Details') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
@endif

<!-- <section class="service-section">
    <div class="container">
        <div class="row g-3">
            @if ($designs->isEmpty())
            {{-- Display default designs --}}
            <div class="col-12 col-md-6 col-lg-3">
                <div class="box-service">
                    <img src="{{ asset('front-asset/img/ser-1.svg') }}" alt="" />
                    <div class="title">{{ __('Free delivery') }}</div>
                    <div class="desc">{{ __('Enjoy free shipping when you spend 300 SAR') }}</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="box-service">
                    <img src="{{ asset('front-asset/img/ser-2.svg') }}" alt="" />
                    <div class="title">{{ __('27/4 Technical Support') }}</div>
                    <div class="desc">{{ __('We are happy to serve you around the clock 24') }}</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="box-service">
                    <img src="{{ asset('front-asset/img/ser-3.svg') }}" alt="" />
                    <div class="title">{{ __('Free Return') }}</div>
                    <div class="desc">{{ __('Easy return guarantee') }}</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="box-service">
                    <img src="{{ asset('front-asset/img/ser-4.svg') }}" alt="" />
                    <div class="title">{{ __('100% Genuine Products') }}</div>
                    <div class="desc">{{ __('All our products are original and of high quality') }}</div>
                </div>
            </div>
            @else
            {{-- Display designs from the database --}}
            @foreach ($designs as $design)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="box-service">
                    <img src="{{ display_file($design->image) }}" />
                    <div class="title">{{ $design->name }}</div>
                    <div class="desc">{{ $design->description }}</div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section> -->

<section class="">
    <div class="container-xxl">
        <div class="main-title">{{ __('Special Offers') }}</div>
        <div class="main-desc">{{ __('Enjoy free shipping when you spend 300 SAR') }}</div>
        <div class="swiper mySwiper product-slider">
            <div class="swiper-wrapper">
                @foreach (\App\Models\Product::where('special_offer', 1)->get() as $offer_item)
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="badge-container">
                            @if ($offer_item->discount_percentage)
                            <span class="badge badge-discount">{{ $offer_item->discount_percentage }}%
                                {{ __('Discount') }}</span>
                            @endif
                            @if ($offer_item->quantity == 0 && !$offer_item->digital_product)
                            <span class="badge badge-stock">{{ __('Out of Stock') }}</span>
                            @endif
                            @if ($offer_item->is_new)
                            <span class="badge badge-new">{{ __('New') }}</span>
                            @endif
                        </div>

                        <a href="{{ route('products.show', $offer_item->id) }}" class="product-image-container">
                            <img src="{{ display_file($offer_item->image) }}" class="product-image"
                                alt="{{ $offer_item->name }}" />
                        </a>

                        <div class="product-details">
                            <div class="product-category">
                                <i class="fas fa-tag"></i> {{ $offer_item->category->name ?? __('Uncategorized') }}
                            </div>

                            <a href="{{ route('products.show', $offer_item->id) }}" class="product-title">
                                <h3>{{ Str::limit($offer_item->name, 50) }}</h3>
                            </a>

                            <div class="product-description">
                                {{ \Illuminate\Support\Str::limit(strip_tags($offer_item->description), 70) }}
                            </div>

                            <div class="product-price">
                                @if ($offer_item->discounted_price)
                                <span class="original-price">{{ $offer_item->sell_price }} {{ setting('currency') }}</span>
                                <span class="discounted-price">{{ $offer_item->discounted_price }}
                                    {{ setting('currency') }}</span>
                                @else
                                <span class="regular-price">{{ $offer_item->sell_price }} {{ setting('currency') }}</span>
                                @endif
                            </div>

                            <div class="product-actions">
                                @livewire('components.add-to-cart', ['product' => $offer_item])
                                <a href="{{ route('products.show', $offer_item->id) }}"
                                    class="btn-details">{{ __('Details') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>

@if ($banner && $banner->image_two)
<section class="main-ad">
    <img src="{{ display_file($banner->image_two) }}" alt="" />
</section>
@endif

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.love-product').click(function() {
        var productId = $(this).data('product-id');
        $.ajax({
            type: 'POST',
            url: '/products/' + productId + '/favorites',
            dataType: 'json',
            success: function(response) {
                alert('تمت الإضافة إلى المفضلة بنجاح');
                // اكتب هنا أي رمز تحتاجه بعد نجاح الطلب
            },
            error: function(xhr, status, error) {
                // alert('حدث خطأ أثناء محاولة إضافة المنتج إلى المفضلة');
                // اكتب هنا أي رمز تحتاجه في حالة حدوث خطأ
            }
        });
    });
});
</script>
