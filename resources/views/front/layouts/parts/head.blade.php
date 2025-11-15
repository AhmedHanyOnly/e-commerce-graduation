<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/jpg" href="{{ display_file(setting('fav')) }}" />
    <!-- Bootstrap -->
    @if (app()->getLocale() == 'en')
        <link rel="stylesheet" href="{{ asset('front-asset/css/bootstrap.min.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('front-asset/css/bootstrap.rtl.min.css') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('front-asset/css/swiper-bundle.min.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <!--  Main color  -->
    <style>
        @php
        $mainColor =setting('main_color') ?? '#44117c';
        $color =ltrim($mainColor, '#');
        $r =hexdec(substr($color, 0, 2));
        $g =hexdec(substr($color, 2, 2));
        $b =hexdec(substr($color, 4, 2));
    @endphp

        :root {
            --main-color: {{ setting('main_color') ?? '#44117c' }};
            --main-color-rgb: {{ $r }}, {{ $g }}, {{ $b }};
            --main-color-dark: {{ setting('main_color_dark') ?? '#330c5c' }};
        }
    </style>
    @vite(['resources/css/app.css'])

    @livewireStyles
    @stack('css')
</head>
