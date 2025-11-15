<nav class="top-nav d-none d-lg-block not-print">
    <div class="container d-flex align-items-center justify-content-between gap-4 flex-wrap">
        <div class="items">
            <div class="item">
                <a target="_blank" href="tel:{{ setting('phone') }}" class="item">
                    <i class="fa-solid fa-phone icon"></i>
                    <bdi>{{ setting('phone') }}</bdi>
                </a>
            </div>
            <div class="item">
                <a target="_blank" href="mailto:{{ setting('email') }}?subject=Mail from Our Site" class="item">
                    <i class="fa-regular fa-envelope icon"></i>
                    {{ setting('email') }}
                </a>
            </div>
        </div>


        <div class="d-flex gap-3 justify-content-between align-items-center">
            <div class="social">
                <a target="blank" href="https://wa.me/{{ setting('whatsapp') }}">
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
            </div>


          @php
    $currentLocale = app()->getLocale();
@endphp

<div class="dropdown">
    <button class="btn-trans dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($currentLocale === 'ar')
            <img src="{{ asset('front-asset/img/ar-flag.png') }}" alt="Arabic Flag" />
            العربية
        @else
            <img src="{{ asset('front-asset/img/eng.svg') }}" alt="English Flag" />
            English
        @endif
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" rel="alternate" hreflang="en"
               href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                <img src="{{ asset('front-asset/img/eng.svg') }}" alt="English Flag" />
                English
            </a>
        </li>
        <li>
            <a class="dropdown-item" rel="alternate" hreflang="ar"
               href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                <img src="{{ asset('front-asset/img/ar-flag.png') }}" alt="Arabic Flag" />
                العربية
            </a>
        </li>
    </ul>
</div>


        </div>
    </div>
</nav>
