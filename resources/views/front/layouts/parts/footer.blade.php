<!-- start footer -->
<footer class="footer not-print">
    <div class="footer-top">
        <div class="container-xxl">
            <div class="d-flex justify-content-center justify-content-sm-between flex-wrap gap-3">
                <div class="info d-flex flex-column align-items-center justify-content-center ">
                    <img src="{{setting('logo')!='' ? display_file(setting('logo')) : asset('admin-asset/img/default-logo.png')}}" alt="" class="logo" />
                    <!-- <div class="d-flex gap-3 align-items-center justify-content-center flex-wrap ">
                        <a href="{{ setting('android_store_url') }}">
                            <img src="{{asset('front-asset/img/android.webp')}}" alt="" width="150" class="img-fluid">
                        </a>
                        <a href="{{ setting('ios_store_url') }}">
                            <img src="{{asset('front-asset/img/ios.webp')}}" alt="" width="150" class="img-fluid">
                        </a>
                    </div> -->
                </div>
                <div class="items flex-grow-1 flex-sm-grow-0">
                    <div class="title">{{ __('Important Links') }}</div>
                    <a href="{{route('faq')}}" class="item">{{ __('Frequently Asked Questions') }}</a>
                    <a href="{{route('privacy')}}" class="item">{{ __('privacy policy') }}</a>
                    <a href="{{route('policy')}}" class="item">{{ __('the terms and conditions') }}</a>
                    <a href="{{route('contact')}}" class="item">{{ __('Contact Us') }}</a>
                </div>
                <div class="items flex-grow-1 flex-sm-grow-0">
                    <div class="title">{{ __('Pages') }}</div>
                    @if(setting('is_about_us_active'))
                    <a href="{{route('about')}}" class="item">{{ __('About Us') }}</a>
                    @endif
                    <a href="{{route('return')}}" class="item">{{ __('Exchange & Return Policy') }}</a>
                </div>
                <div class="box-email order-4 order-sm-3">
                    <div class="items">
                        <div href="" class="title">{{ __('Subscribe to Store Store Offers Newsletter') }}</div>
                    </div>
                    <div class="text">
                        {{ __('Subscribe to our brochure and be the first to know about our offers and services.') }}
                    </div>
                    <form class="parent-inp" action="{{ route('email_subscriptions.store') }}" method="POST">
                        @csrf
                        <input type="text" name="email" placeholder="{{ __('E-Mail Address') }}" class="inp" />
                        @if ($errors->has('email'))
    <div class="invalid-feedback d-block text-danger mt-1">
        {{ $errors->first('email') }}
    </div>
@endif
                        <button class="btn-sub">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.980088 0.0412096L18.5971 7.72021C18.6681 7.75257 18.7281 7.805 18.7696 7.87102C18.8112 7.93705 18.8326 8.01379 18.8311 8.09181C18.8296 8.16982 18.8053 8.2457 18.7613 8.31009C18.7172 8.37448 18.6553 8.42458 18.5831 8.45421L13.8191 11.1472C13.6816 11.2248 13.5236 11.2582 13.3665 11.2429C13.2094 11.2275 13.0609 11.164 12.9411 11.0612L3.54109 2.96121C3.47909 2.90821 3.33009 2.80721 3.27209 2.86121C3.21409 2.91521 3.30609 3.06721 3.35809 3.13021L11.4881 12.2872C11.5985 12.4111 11.6657 12.5675 11.6796 12.7329C11.6935 12.8982 11.6533 13.0637 11.5651 13.2042L8.45009 18.2042C8.4161 18.2725 8.36352 18.3298 8.29839 18.3696C8.23325 18.4093 8.15823 18.4298 8.08194 18.4288C8.00566 18.4277 7.93122 18.4051 7.8672 18.3636C7.80318 18.3222 7.75219 18.2634 7.72009 18.1942L0.438087 0.57421C0.400659 0.498691 0.388042 0.413279 0.402038 0.330164C0.416033 0.247049 0.455925 0.170479 0.51602 0.111382C0.576115 0.0522845 0.653342 0.0136801 0.73668 0.00107846C0.820017 -0.0115231 0.905206 0.00252226 0.980088 0.0412096Z" fill="var(--main-color)" />
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="items flex-grow-1 flex-sm-grow-0 order-3 order-sm-4">
                    <div href="" class="title">{{ __('Contact us') }}</div>
                    <a href="https://maps.google.com/maps?q={{setting('address') ? setting('address') : __('Saudi Arabia - Riyadh')}}" target="_blank" class="item">
                        <i class="fa-solid fa-location-dot"></i>
                        {{setting('address') ? setting('address') : __('Saudi Arabia - Riyadh')}}
                    </a>
                    <a target="_blank" href="tel:{{ setting('phone') }}" class="item">
                        <i class="fa-solid fa-phone"></i>
                        {{ setting('phone') }}
                    </a>
                    <a target="_blank" href="mailto:{{setting('email')}}?subject=Mail from Our Site" class="item">
                        <i class="fa-solid fa-envelope"></i>
                        {{ setting('email') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container-xxl">
            <div class="d-flex justify-content-md-center justify-content-center align-items-center flex-wrap gap-3">
                <a href="https://const-tech.org/" target="_blank">
                    {{ __('© All rights reserved to Const Tech 2025') }}
                </a>
                {{-- <div class="social">
                    <a href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div> --}}

                <!-- <div class="social">
                    <a target="blank" href="https://wa.me/{{setting('whatsapp')}}">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="{{ setting('facebook') }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{ setting('snapchat') }}" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="{{ setting('instagram') }}" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{ setting('twitter') }}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div> -->
                <!-- <div class="payment-footer flex-wrap justify-content-center ">
                    <img src="{{asset('front-asset/img/mada_mini.webp')}}" alt="img">
                    <img src="{{asset('front-asset/img/credit_card_mini.webp')}}" alt="img">
                    <img src="{{asset('front-asset/img/stc_pay_mini.webp')}}" alt="img">
                    <img src="{{asset('front-asset/img/apple_pay_mini.webp')}}" alt="img">
                    <img src="{{asset('front-asset/img/tabby_installment_mini.webp')}}" alt="img">
                    <img src="{{asset('front-asset/img/tamara.webp')}}" alt="img">
                    <img src="{{asset('front-asset/img/cod_mini.webp')}}" alt="img">
                    <img src="{{asset('front-asset/img/sbc.webp')}}" alt="img">
                </div> -->
            </div>
        </div>
    </div>
</footer>
@vite(['resources/js/app.js'])
<script data-navigate-track src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script data-navigate-track src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

@if (session('success'))
<script>
    Swal.fire({
        title: "{{ session('success') }}",
        icon: "success",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif
<script data-navigate-once src="{{asset('front-asset/js/swiper-bundle.min.js')}}"></script>
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: '{{ $errors->first() }}',
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif

<script data-navigate-once>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert', ({
        detail: {
            type,
            message
        }
    }) => {
        Toast.fire({
            icon: type,
            title: message
        })
    })
</script>
@if (auth()->check())
<script data-navigate-track>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
    });

    var channel = pusher.subscribe('new-notification-{{ auth()->id() }}');
    channel.bind('new-notification', function(data) {
        // app.messages.push(JSON.stringify(data));
        console.log(data.notification)
        Swal.fire({
            title: data.notification.title,
            icon: 'info',
            html: `
                    <a class="btn btn-success btn-sm text-nowrap" href="{{ route('notice') }}">
                            عرض كل الاشعارات
                    </a>`,
            showConfirmButton: false,
            position: 'center',
            padding: '13px',
            customClass: 'swal-alert-info',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
        })
    });
</script>
@endif

@livewireScripts

@stack('js')
