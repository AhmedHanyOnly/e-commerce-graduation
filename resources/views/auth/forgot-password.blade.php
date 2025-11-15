@section('title', ' تسجيل دخول')

@include('front.layouts.parts.head')


<section class="login_page">
    <div class="box-col d-flex flex-column justify-content-center py-xl-0">
        <x-admin-alert></x-admin-alert>
        @if (session('otp_message'))
        <div class="alert alert-success" role="alert">
            {{ session('otp_message') }}
        </div>
        @endif
        <form action="{{route('login')}}" method="post" class="form_content">
            @csrf
            <img src="{{asset('front-asset/img/logo.svg')}}" alt="logo" class="logo-form" />
            <h3 class="header_title">
                <div class="title">مرحبا بك</div>
                <div class="text">أدخل البريد الالكتروني لاعادة تعيين كلمة السر</div>
            </h3>
            <div class="row gap-3 ">
                <div class="col-12 ">
                    <label for="" class="label">البريد الالكتروني</label>
                    <div class="group-inp">
                        <input type="text" placeholder="name@company.com" name="email" id="" class="inp">
                        <div class="box">
                            <img src="{{asset('admin-asset')}}/img/sms.svg" class="icon" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="sub_btn btn btn-primary w-100">دخول</button>
                </div>
                <div class="col-12 mb-4 d-flex align-items-center justify-content-center">
                    <div>
                        ليس لديك حساب؟
                        <a href="{{route('register')}}" class=" text-decoration-underline reseat">سجل الان</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="box-col box-bg d-flex flex-column justify-content-between align-items-center gap-5 align-items-xl-start">
        <img src="{{asset('front-asset/img/slider.webp')}}" alt="img-bg" class="bg" />
        <img src="{{asset('front-asset/img/logo.svg')}}" alt="logo" class="logo-bg" />
        <div class="text-bg">
            <div class="title">
                متجرنا
            </div>
            <div class="p">
                خدمات مميزة وتجربة جديدة
            </div>
        </div>
        <!-- <div class="text-bg-2">
            شركة سعودية
        </div> -->
    </div>
    <script>
        function togglePasswordVisibility(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = document.querySelector("#" + fieldId + " + .box img");

            if (field.type === "password") {
                field.type = "text";
                icon.src = "{{ asset('admin-asset/img/login/eye.svg') }}";
            } else {
                field.type = "password";
                icon.src = "{{ asset('admin-asset/img/login/eye.svg') }}";
            }
        }
    </script>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
