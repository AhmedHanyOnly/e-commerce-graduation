@extends('front.layouts.front')
@section('content')

  <section class="main-section py-5">
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card card-side  h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile text-center">
                               <div class="user-avatar">
                                    <img src="{{ asset('front-asset/img/image-preview.webp') }}" alt="">
                                </div>
                                <h5 class="user-name">باسسسم جابر</h5>
                                <h6 class="user-email">Basem@b.b</h6>
                            </div>
                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    <div class="d-flex align-items-center gap-1">
                                      الأشتراك
                                    <div class="badge-count">5</div>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    تعديل بياناتي
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>

                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    الحجوزات
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>

                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    أضف رأيك
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    اتصل بنا
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href=""
                                    class="btn-icon justify-content-between text-danger d-flex">
                                    الخروج
                                    <div class="icon text-danger">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card ">
                    <form action="" method="POST">

                        <div class="card-body">
                            <div class="row gutters g-2">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">المعلومات الشخصيه</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="first_name" class="mb-2 small-label">الاسم الأول</label>
                                        <input type="text" name="first_name"
                                            class="form-control" id="first_name">


                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="last_name" class="mb-2 small-label">الاسم الأخير</label>
                                        <input type="text" name="last_name"
                                            class="form-control" id="last_name">

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail" class="mb-2 small-label">البريد الاليكتروني</label>
                                        <input type="email" name="email"
                                            class="form-control" id="eMail">

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone" class="mb-2 small-label">@lang("Phone")</label>
                                        <input type="text" name="phone" class="form-control"
                                              id="phone">

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="city">المدينه</label>
                                        <select name="city_id" id="city" class="form-select">
                                            <option value="">-- اختر المدينه--</option>

                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row gutters g-2">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mt-3 mb-2 text-primary">كلمة المرور</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="password" class="small-label mb-2">كلمة المرور</label>
                                        <input type="password" name="password" class="form-control" id="password">

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="mb-2 small-label">تأكيد كلمة
                                            المرور</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation">
                                    </div>
                                </div>

                            </div>
                            <div class="row gutters mt-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" id="submit" class="btn btn-sm btn-primary">@lang("Save")
                                            التغيرات</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
