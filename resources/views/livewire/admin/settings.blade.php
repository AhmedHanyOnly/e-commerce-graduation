<div class="main-side">
    @section('title', 'الاعدادات')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.Home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Settings') }}</li>
        </ol>
    </nav>
    <div class="row g-3">
        <div class="col-12 col-md-3 ">
            <div class="profile-bar">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills list-option" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active" type="button" aria-selected="true">
                            <div class="name">
                                <i class="fa-solid fa-gear"></i>
                                {{ __('admin.Settings') }}
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="nav-link " type="button" aria-selected="true">
                            <div class="name">

                                <i class="fa-brands fa-whatsapp"></i>
                                اعدادات الwhatsApp
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9 ">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="content_view">
                    <div class="content_header">
                        <div class="title fs-11px">
                            <i class="fa-solid fa-gear fs-12px main-red-color"></i>
                            {{ __('admin.Settings') }}
                        </div>
                    </div>

                    <div class="main-title">
                        <div class="small">
                            الرئيسية
                        </div>
                        <div class="large">
                            الإعدادات العامة
                        </div>
                    </div>
                    <x-admin-alert></x-admin-alert>
                    <h6 class="main-head">
                        البيانات الاساسية
                    </h6>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mb-2 g-3">

                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>إسم الموقع</span>
                                    <input type="text" wire:model="website_name" id="website_name"
                                        class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>رابط الموقع</span>
                                    <input type="url" wire:model="website_url" id="website_url"
                                        class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>الرقم الضريبي</span>
                                    <input type="number" min="0" wire:model="tax_number" id="tax_number"
                                        class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>العنوان</span>
                                    <input type="text" wire:model="address" id="address" class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>رقم المبنى</span>
                                    <input type="number" min="0" wire:model="building_number"
                                        id="building_number" class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>الشارع</span>
                                    <input type="text" wire:model="street_number" id="street_number"
                                        class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>@lang('admin.Phone')</span>
                                    <input type="tel" wire:model="phone" id="phone" class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> @lang('admin.Email')</span>
                                    <input type="email" class="form-control" wire:model="email" id="email">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input mb-1">
                                    <span>نسبة الادارة من الطلب <small>(لكل كيلومتر)</small></span>
                                    <input type="number" wire:model='commission' min="0"
                                        class="form-control">
                                </label>
                                {{-- @if (setting('fav'))
        <img src="{{ display_file(setting('fav')) }}" alt="" width='50'>
                                @endif --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> الضريبة</span>
                                    <input type="number" class="form-control" wire:model="tax" id="tax">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> سعر التوصيل</span>
                                    <input type="number" class="form-control" wire:model="shipping_price"
                                        id="shipping_price">
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> الضريبة علي الدفع عند الاستلام</span>
                                    <input type="number" class="form-control" wire:model="cash_on_delivery_tax"
                                        id="cash_on_delivery_tax">
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-label" for="tax">تفعيل الضريبة</label>
                                <select wire:model="is_tax" id="is_tax" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> رمز العمله</span>
                                    <input type="text" class="form-control" wire:model="currency" id="currency">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> الاكثر مبيعا</span>
                                    <input type="text" class="form-control" wire:model="most_sold_products"
                                        id="most_sold_products">
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <hr>
                            <h6 class="main-head m-0">
                                التواصل الاجتماعي
                            </h6>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span>واتساب</span>
                                    <input type="text" wire:model='whatsapp' class="form-control" id="whatsapp">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> يوتيوب</span>
                                    <input type="text" wire:model='snapchat' class="form-control" id="snapchat">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> تويتر</span>
                                    <input type="text" class="form-control" wire:model="twitter" id="twitter">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> فيسبوك</span>
                                    <input type="text" wire:model='facebook' class="form-control" id="facebook">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input">
                                    <span> انستغرام</span>
                                    <input type="text" class="form-control" wire:model="instagram"
                                        id="instagram">
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <hr>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-label" for="siteStatus">حالة الموقع</label>
                                <select wire:model="website_status" id="website_status" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-4 transform-up-xl">
                            <label class="special-label" for="siteLogo">رسالة تعطيل الموقع</label>
                            <textarea wire:model="maintainance_message" id="maintainance_message" rows="4" class="form-control"
                                placeholder="نعتذر الموقع مغلق للصيانة ..."></textarea>
                        </div>
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input mb-1">
                                    <span>صورة الشعار </span>
                                    <input type="file" wire:model="logo" id="logo" class="form-control">
                                </label>
                                @if (setting('logo'))
                                    <img src="{{ display_file(setting('logo')) }}" alt="" width='50'>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col">
            <div class="inp-holder">
                <label class="special-input mb-1">
                    <span>صورة الشعار</span>
                    <input type="file" wire:model.live="logo" id="logo" class="form-control">
                </label>
                @if ($show_logo)
                    <img src="{{ display_file($show_logo) }}" alt="" width='50'>
                        @endif
                    </div>
                </div> --}}
                        <div class="col">
                            <div class="inp-holder">
                                <label class="special-input mb-1">
                                    <span>صورة أيقونة المتصفح</span>
                                    <input type="file" wire:model="fav" id="fav" class="form-control">
                                </label>
                                @if (setting('fav'))
                                    <img src="{{ display_file(setting('fav')) }}" alt="" width='50'>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col">
    <label class="special-input">
        <span>اقصي عدد سائقين للناقل </span>
        <input type="number" min="0" wire:model="max_driver_for_transporter" id="max_driver_for_transporter" class="form-control">
    </label>
</div> --}}

                        <!-- <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" @checked(setting('product_active')) wire:model="product_active" id="product_active">
                        <label class="form-check-label" for="product_active">
                            تفعيل المنتجات مباشرة
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" @checked(setting('active_vendor')) wire:model="active_vendor" id="active_vendor">
                        <label class="form-check-label" for="active_vendor">
                            تفعيل المزود مباشرة
                        </label>
                    </div>
                </div> -->
                        <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" @checked(setting('active_client'))
                                    wire:model="active_client" id="active_client">
                                <label class="form-check-label" for="active_client">
                                    تفعيل العميل مباشرة
                                </label>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-6 col-lg-3 col-xl-3">
    <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" @checked(setting('vendor_add_drivers_directly')) wire:model="vendor_add_drivers_directly" id="vendor_add_drivers_directly">
        <label class="form-check-label" for="vendor_add_drivers_directly">
            تفعيل اضافة السائقين مباشرة
        </label>
    </div>
</div> --}}

                        <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" @checked(setting('client_registration'))
                                    wire:model="client_registration" id="client_registration">
                                <label class="form-check-label">
                                    تفعيل التسجيل للعملاء
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" @checked(setting('accept_comment_automatically'))
                                    wire:model="accept_comment_automatically" id="accept_comment_automatically">
                                <label class="form-check-label">
                                    تفعيل الموافقة على التعليق تلقائي
                                </label>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-6 col-lg-3 col-xl-3">
    <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" @checked(setting('driver_registration')) wire:model="driver_registration" id="driver_registration">
        <label class="form-check-label">
            تفعيل التسجيل للسائقين
        </label>
    </div>
</div> --}}
                        <!-- <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" @checked(setting('vendor_registration')) wire:model="vendor_registration" id="vendor_registration">
                        <label class="form-check-label">
                            تفعيل التسجيل للمزودين
                        </label>
                    </div>
                </div> -->
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="btn-holder d-flex justify-content-center mt-4">
                                <button wire:click='save' type="button" class="main-btn">حفظ التعديلات</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
