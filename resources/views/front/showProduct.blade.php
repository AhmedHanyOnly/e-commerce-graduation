@extends('front.layouts.front')
@section('title', "اسم المنتج")

@section('content')
<!-- Start Section -->
<section class="main-section show-product">
    <div class="container">
        <div class="row g-3 mb-5">
            <div class="col-12 col-md-6">
                <div class="row img-product g-1">
                    <div class="col-12 col-lg-3">
                        <div thumbsSlider="swiper" class="swiper thumb-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="other">
                                        <a href="{{ asset('front-asset/img/image-preview.webp') }}" data-fancybox="gallery" data-caption="اسم المنتج">
                                            <img loading="lazy" src="{{ asset('front-asset/img/image-preview.webp') }}" class="img" alt="اسم المنتج">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="other">
                                        <a href="{{ asset('front-asset/img/image-preview.webp') }}" data-fancybox="gallery" data-caption="اسم المنتج">
                                            <img loading="lazy" src="{{ asset('front-asset/img/image-preview.webp') }}" class="img" alt="اسم المنتج">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="other">
                                        <a href="{{ asset('front-asset/img/image-preview.webp') }}" data-fancybox="gallery" data-caption="اسم المنتج">
                                            <img loading="lazy" src="{{ asset('front-asset/img/image-preview.webp') }}" class="img" alt="اسم المنتج">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="other">
                                        <a href="{{ asset('front-asset/img/image-preview.webp') }}" data-fancybox="gallery" data-caption="اسم المنتج">
                                            <img loading="lazy" src="{{ asset('front-asset/img/image-preview.webp') }}" class="img" alt="اسم المنتج">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="other">
                                        <a href="{{ asset('front-asset/img/image-preview.webp') }}" data-fancybox="gallery" data-caption="اسم المنتج">
                                            <img loading="lazy" src="{{ asset('front-asset/img/image-preview.webp') }}" class="img" alt="اسم المنتج">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="swiper show-pr-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="main">
                                        <a href="{{ asset('front-asset/img/image-preview.webp') }}" data-fancybox="gallery" data-caption="اسم المنتج">
                                            <img loading="lazy" src="{{asset('front-asset/img/image-preview.webp') }}" class="img" alt="اسم المنتج">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="data-product">
                    <div class="info">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="name">
                                اسم المنتج
                            </div>
                            <div class="buttons-options">
                                <button type="button" wire:click='addToFavorite' class="btn-icon-pr favorites active">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button type="button" id="btn-shere" class="btn-icon-pr share">
                                    <i class="fa-solid fa-share-from-square"></i>
                                </button>
                            </div>
                        </div>
                        <div class="price-gl">
                            222$
                        </div>
                        <div>
                            اسم الصنف
                        </div>
                        <div class="rate">
                            <span>التقييم</span>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="control">
                        <div class="count">
                            <button class="increment" wire:click="increment">+</button>
                            <span class="val">0</span>
                            <button class="decrement" wire:click="decrement">-</button>
                        </div>
                        <button class="main-btn rounded-0 py-1"> اضافة للسلة</button>
                    </div>
                    <div class="main-tabs nav nav-tabs " id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-selected="false">الوصف</button>
                    </div>
                    <div class="main-tab-content tab-content ac" id="nav-tabContent">
                        <div class="tab-pane fade active" id="nav-description" role="tabpanel">
                            الوصف الوصف الوصف الوصف الوصف الوصفالوصف
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <h5 class="main-title">منتجات ذات صلة</h5>
            <div class="swiper mySwiper product-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="{{route('showProduct')}}">
                            <div class="box-product-land">
                                <button class="love-product">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="{{asset('front-asset/img/item-1.svg')}}" class="img-product" alt="img" />
                                <div class="text">
                                    <div class="title">اسم المنتج المعروض</div>
                                    <div class="price">
                                        <div class="num">880</div>
                                        ر.س
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{route('showProduct')}}">
                            <div class="box-product-land">
                                <button class="love-product">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="{{asset('front-asset/img/item-2.svg')}}" class="img-product" alt="img" />
                                <div class="text">
                                    <div class="title">اسم المنتج المعروض</div>
                                    <div class="price">
                                        <div class="num">880</div>
                                        ر.س
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{route('showProduct')}}">
                            <div class="box-product-land">
                                <button class="love-product">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="{{asset('front-asset/img/item-3.svg')}}" class="img-product" alt="img" />
                                <div class="text">
                                    <div class="title">اسم المنتج المعروض</div>
                                    <div class="price">
                                        <div class="num">880</div>
                                        ر.س
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="{{route('showProduct')}}">
                            <div class="box-product-land">
                                <button class="love-product">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="{{asset('front-asset/img/item-4.svg')}}" class="img-product" alt="img" />
                                <div class="text">
                                    <div class="title">اسم المنتج المعروض</div>
                                    <div class="price">
                                        <div class="num">880</div>
                                        ر.س
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="alert alert-warning">
                لا يوجد منتجات ذات صلة حاليا
            </div>
        </div>
    </div>
</section>
<!-- End Section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<script>
    // Fancybox
    Fancybox.bind("[data-fancybox]", {});




    // Btn Shere
    // const shareData = {
    // url: "{{ Request::url() }}",
    // };
    // const btn = document.querySelector("#btn-shere");
    // btn.addEventListener("click", async () => {
    // try {
    // await navigator.share(shareData);
    // } catch (err) {}
    // });
</script>
@endsection
