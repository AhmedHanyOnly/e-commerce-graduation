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
            <a href="{{route('home')}}">
                <img src="{{asset('admin-asset/img/login/default-logo.png')}}" alt="logo" class="logo-form" />
            </a>
            <h3 class="header_title">
                <div class="title">{{ __('welcome') }}</div>
                <div class="text">{{ __('Enter your email and password to log in') }}</div>
            </h3>
            <div class="row gap-3 ">
                <div class="col-12 ">
                    <label for="" class="label">{{ __('E-Mail Address') }}</label>
                    <div class="group-inp">
                        <input type="text" placeholder="name@company.com" name="email" id="" class="inp">
                        <div class="box">
                            <img src="{{asset('admin-asset')}}/img/sms.svg" class="icon" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 ">
                    <label for="" class="label">{{ __('Password') }}</label>
                    <div class="group-inp">
                        <input type="password" placeholder="{{ __('Please enter your password') }}" name="password" id="password" class="inp inp-pass">
                        <div class="box box-btn" onclick="togglePasswordVisibility('password')">
                            <img src="{{asset('admin-asset/img/icons/eye.png')}}" class="icon" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between  ">
                        <div class="d-flex align-items-center align-items-center gap-2">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="agree">
                                {{ __('always remind me') }}
                            </label>
                        </div>
                        <a href="{{route('forgot-password')}}" class=" reseat">{{ __('did you forget your password?') }}</a>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="sub_btn btn btn-primary w-100">{{ __('login') }}</button>
                </div>
                <div class="col-12 mb-4 d-flex align-items-center justify-content-center">
                    <div>
                        {{ __('Don\'t have an account?') }}
                        <a href="{{route('register')}}" class=" text-decoration-underline reseat">{{ __('Registernow') }}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="box-col box-bg d-flex flex-column justify-content-between align-items-center gap-5 align-items-xl-start">
        <img src="{{asset('front-asset/img/slider.webp')}}" alt="img-bg" class="bg" />
        <img src="{{asset('admin-asset/img/login/default-logo.png')}}" alt="logo" class="logo-bg" />

        <div class="text-bg">
            <div class="title">
                {{ __('our store') }}
            </div>
            <div class="p">
                {{ __('Distinctive services and a new experience') }}
            </div>
        </div>
        <div class="text-bg-2">
            <!-- {{ __('Saudi company') }} -->
        </div>
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
