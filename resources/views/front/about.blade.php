@extends('front.layouts.front')
@section('title','من نحن')
@section('content')
@php
$about = App\Models\About::first();
@endphp
<section class="fqa-section main-section">
    <div class="container">
        <div class="bg-white rounded shadow p-3">
            <h5 class="main-title mb-4">{{ $about?->title ?? 'من نحن' }}</h5>
            <p>

                {!! $about?->desc ?? 'الصفحة تحت الانشاء' !!}
            </p>
        </div>
    </div>
</section>
@endsection
