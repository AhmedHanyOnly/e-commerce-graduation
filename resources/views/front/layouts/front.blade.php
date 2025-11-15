@include('front.layouts.parts.head')

<body>
    @include('front.layouts.parts.top-nav')
    @include('front.layouts.parts.bottom-nav')
    @include('front.layouts.parts.menu-nav')
    @include('front.layouts.parts.phone-nav')
    <div class="loader-holder" id='loader'>
        <div class="custom-loader"></div>
    </div>
    @yield('content')

    @include('front.layouts.parts.footer')

</body>

</html>
