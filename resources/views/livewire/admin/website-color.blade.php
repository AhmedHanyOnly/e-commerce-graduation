<div class="main-side">
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="main-title">
        <div class="small">
            الرئيسية
        </div>
        <div class="large">
            اللون الأساسي للموقع
        </div>
    </div>
    <x-admin-alert />
<div class="swiper mySwiper swiper-banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a target="blank" href="https://wa.me/0506499275">
                    <img src="{{asset('admin-asset/img/banners2.png')}}" alt="banner" />
                </a>
            </div>
            <div class="swiper-slide">
                <a target="blank" href="https://wa.me/0506499275">
                    <img src="{{asset('admin-asset/img/banners1.png')}}" alt="banner" />
                </a>
            </div>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-md-3 ">
            <label class="special-label" for="image">اللون</label>
            <div class="d-flex gap-2">
                <input type="color" wire:model="main_color" name="" id="" class="form-control form-control-color w-100" title="قم بتغيراللون">
                <button wire:click="resetColor" class="btn btn-sm btn-danger"><i class="fa fa-arrow-rotate-backward"></i></button>

            </div>

        </div>

        <div class="col-12 d-flex justify-content-center mt-4">
            <button wire:click="submit" type="submit" class="main-btn">
                حفظ
            </button>
        </div>
    </div>
</div>
