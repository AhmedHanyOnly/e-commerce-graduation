<!DOCTYPE html>
<html lang="ar" dir="rtl">

@include('admin.layouts.parts.head')

<body>
    <!-- Start layout -->

    @include('admin.layouts.parts.navbar')
    <div class="app">
        @include('admin.layouts.parts.sidebar')
        @yield('content')
    </div>
<footer class="main-footer text-center">
    @lang('admin.AllRightsReservedTo') <a href="https://www.const-tech.org/">@lang('admin.ConstTech')</a>. © 2024
</footer>


    <!-- End layout -->
    <!-- Js Files -->
    @include('admin.layouts.parts.footer')
</body>

</html>
