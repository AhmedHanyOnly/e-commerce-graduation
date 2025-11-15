@extends('front.layouts.front')
@section('title', $product->name)

@section('content')
    <!-- Start Loader -->

    <!-- End Loader -->
    <!-- Start Section -->
    <section class="main-section show-product">
        <div class="container">
            <x-admin-alert />
            @if (session()->has('success1'))
                <div class="alert w-100 alert-success alert-pop alert-dismissible fade show">
                    <div class="d-flex align-items-center  gap-2 justify-content-between">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('success1') }}
                    </div>
                </div>
            @endif
            <div class="row g-3 mb-5">
                <div class="col-12 col-md-6">
                    {{-- <div class="img-product g-1">
                        <div class="swiper show-pr-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="main">
                                        <a href="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}"
                data-fancybox="gallery" data-caption="{{ $product->name }}">
                <img loading="lazy" src="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}" class="img-cart" alt="{{ $product->name }}">
                <img loading="lazy" src="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}" class="img" alt="{{ $product->name }}">
                </a>
            </div>
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    </div>
    <div thumbsSlider="swiper" class="swiper thumb-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="other">
                    <a href="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}" data-fancybox="gallery" data-caption="{{ $product->name }}">
                        <img loading="lazy" src="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}" class="img" alt="{{ $product->name }}">
                    </a>
                    @foreach ($product->files as $file)
                    <a href="{{ display_file($file->path) }}" data-fancybox="gallery" data-caption="{{ $product->name }}">
                        <img loading="lazy" src="{{ display_file($file->path) }}" class="img" alt="{{ $product->name }}">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div> --}}

                    <div class="swiper productSwiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}"
                                    data-fancybox="gallery" data-caption="{{ $product->name }}">
                                    <img loading="lazy"
                                        src="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}"
                                        alt="{{ $product->name }}">
                                </a>
                            </div>
                            @foreach ($product->files as $file)
                                <div class="swiper-slide">
                                    <a href="{{ display_file($file->path) }}" data-fancybox="gallery"
                                        data-caption="{{ $product->name }}">
                                        <img loading="lazy" src="{{ display_file($file->path) }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper productSwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img loading="lazy"
                                    src="{{ $product->image ? display_file($product->image) : asset('front-asset/img/image-preview.webp') }}"
                                    alt="{{ $product->name }}">
                            </div>
                            @foreach ($product->files as $file)
                                <div class="swiper-slide">
                                    <img loading="lazy" src="{{ display_file($file->path) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    @livewire('front.products.single-product', ['product' => $product])
                </div>

                <div id='description'>
                    <div class="main-tabs nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-description" type="button" role="tab"
                            aria-selected="true">{{ __('Product Details') }}</button>
                    </div>
                </div>
                <div class="main-tab-content tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                        aria-labelledby="nav-description-tab">
                        <div class="bg-white p-3">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>

            </div>
           <livewire:front.products.product-rates :product="$product" />
            <div class="">
                <h5 class="main-title">{{ __('Related products') }}</h5>
                @if ($related_products->count() > 0)
                    <div class="swiper mySwiper product-slider">
                        <div class="swiper-wrapper">
                            @foreach ($related_products as $related)
                                <div class="swiper-slide">
                                    <div class="box-product-land">
                                        {{-- <button class="love-product" onclick="ToggleFav()">
                                            <i class="fa-regular fa-heart"></i>
                                        </button> --}}
                                        {{-- <form action="{{ route('products.addToFavorites', $related->id) }}"
                        method="POST">
                        @csrf
                        <button type="submit" class="love-product">

                            @if ($related->is_my_favourite)
                            <i class="fa-solid fa-heart text-danger"></i>
                            @else
                            <i class="fa-regular fa-heart"></i>
                            @endif
                        </button>
                        </form> --}}

                                        <a href="{{ route('products.show', $related->id) }}">

                                            <img src="{{ $related->image ? display_file($related->image) : asset('front-asset/img/image-preview.webp') }}"
                                                class="img-product" alt="{{ $related->name }}" />
                                            <div class="text">
                                                <div class="title">{{ $related->name }}</div>
                                                <div class="price">
                                                    <div class="num">{{ $related->sell_price }}</div>
                                                    {{ __('SAR') }}
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        {{ __('No related products currently') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End Section -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
    {{-- <script>
        function ToggleFav() {
            Swal.fire({
                title: 'تم الاضافة للمفضل',
                text: 'تم اضافة المنتج بنجاح للمفضل',
                icon: 'success',
                confirmButtonText: 'تم'
            })
        }
    </script> --}}
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

    <script>
        // Fancybox
        Fancybox.bind("[data-fancybox]", {});
        // Btn Shere
        // const shareData = {
        //     url: "{{ Request::url() }}",
        // };
        // const btn = document.querySelector("#btn-shere");
        // btn.addEventListener("click", async () => {
        //     try {
        //         await navigator.share(shareData);
        //     } catch (err) {}
        // });
    </script>
@endsection
