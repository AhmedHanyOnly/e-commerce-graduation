@section('title', ' تسجيل دخول')

@include('front.layouts.parts.head')


<section class="login_page">
    <div class="box-col d-flex flex-column justify-content-center py-xl-0">
        {{-- <x-admin-alert></x-admin-alert>  --}}
        @if (session('otp_message'))
            <div class="alert alert-success" role="alert">
                {{ session('otp_message') }}
            </div>
        @endif
        <form action="{{ route('register') }}" method="post" class="form_content">
            @csrf
            <a href="{{ route('home') }}">
                <img src="{{ asset('front-asset/img/logo.svg') }}" alt="logo" class="logo-form" />
            </a>
            <h3 class="header_title">
                <div class="title">{{ __('welcome') }}</div>
                <div class="text">
                    {{ __('Create your own account now to get the best possible experience') }}
                </div>
            </h3>
            <div class="row gap-3 ">
                <div class="col-12 ">
                    <label for="name" class="label">{{ __('Name') }}</label>
                    <div class="group-inp">
                        <input type="text" placeholder="{{ __('Please enter the name') }}" name="name"
                            id="name" value="{{ old('name') }}" class="inp">
                        <div class="box">
                            <img src="img/sms.svg" class="icon" alt="">
                        </div>
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                    <div class="group-inp">
                        <input type="email" placeholder="name@company.com" name="email" id="email"
                            value="{{ old('email') }}" class="inp">
                        <div class="box">
                            <img src="img/sms.svg" class="icon" alt="">
                        </div>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="phone" class="label">{{ __('Phone') }}</label>
                    <div class="group-inp">
                        <input type="text" placeholder="{{ __('Please enter your mobile phone') }}" name="phone"
                            id="phone" value="{{ old('phone') }}" class="inp">
                        <div class="box">
                            <img src="img/sms.svg" class="icon" alt="">
                        </div>
                    </div>
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 ">
                    <label for="name" class="label">{{ __('Password') }}</label>
                    <div class="group-inp">
                        <input type="password" placeholder="{{ __('Please enter your password') }}" name="password"
                            id="password" class="inp inp-pass">
                        <div class="box box-btn" onclick="togglePasswordVisibility('password')">
                            <img src="{{ asset('admin-asset/img/icons/eye.png') }}" class="icon" alt="">
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @php
                    $cities = App\Models\City::all();
                @endphp
                <div class="col-12">
                    <label for="city" class="label">{{ __('City') }}</label>
                    <select name="city_id" id="city" class="form-select">
                        <option value="">{{ __('Select city') }}</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="neighborhood" class="label">{{ __('neighborhood') }}</label>
                    <select name="neighborhood_id" id="neighborhood" class="form-select" disabled>
                        <option value="">اختر المدينة أولاً</option>
                    </select>
                    <div id="neighborhood-alert" class="text-danger d-none mt-1">
                        الرجاء اختيار مدينة أولاً
                    </div>
                    @error('neighborhood_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <input type="checkbox" name="agree" id="" {{ old('agree') ? 'checked' : '' }}>
                        <label for="agree">
                            {{ __('Agree to') }} <a href="">{{ __('the terms and conditions') }}</a>
                        </label>
                    </div>
                </div>

                @error('agree')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="col-12">
                    <button type="submit" class="sub_btn btn btn-primary w-100">{{ __('registration') }}</button>
                </div>
                <div class="col-12 mb-4 d-flex align-items-center justify-content-center">
                    <div>
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}"
                            class=" text-decoration-underline reseat">{{ __('Login') }}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div
        class="box-col box-bg d-flex flex-column justify-content-between align-items-center gap-5 align-items-xl-start">
        <img src="{{ asset('front-asset/img/slider.webp') }}" alt="img-bg" class="bg" />
        <img src="{{ asset('front-asset/img/logo.svg') }}" alt="logo" class="logo-bg" />
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
   <script>
    document.addEventListener('DOMContentLoaded', function () {
        const citySelect = document.getElementById('city');
        const neighborhoodSelect = document.getElementById('neighborhood');
        const alertDiv = document.getElementById('neighborhood-alert');

        // تعطيل الحي مبدئيًا
        neighborhoodSelect.disabled = true;

        citySelect.addEventListener('change', function () {
            const cityId = this.value;

            if (!cityId) {
                neighborhoodSelect.innerHTML = '<option value="">اختر المدينة أولاً</option>';
                neighborhoodSelect.disabled = true;
                alertDiv.classList.remove('d-none');
                return;
            }

            // إخفاء التنبيه وتفعيل الحقل
            alertDiv.classList.add('d-none');
            neighborhoodSelect.disabled = false;
            neighborhoodSelect.innerHTML = '<option value="">جاري التحميل...</option>';

            fetch(`/get-neighborhoods/${cityId}`)
                .then(response => response.json())
                .then(data => {
                    neighborhoodSelect.innerHTML = '<option value="">اختر الحي</option>';
                    Object.entries(data).forEach(([id, name]) => {
                        neighborhoodSelect.innerHTML += `<option value="${id}">${name}</option>`;
                    });
                })
                .catch(error => {
                    neighborhoodSelect.innerHTML = '<option value="">حدث خطأ</option>';
                    console.error(error);
                });
        });
    });
</script>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
