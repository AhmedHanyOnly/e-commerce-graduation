@extends('front.layouts.front')
@section('title', __('complete payment'))
@section('content')
    <section class="fqa-section main-section">
        <div class="container">
            <div class="bg-white rounded shadow p-3">
                <h5 class="main-title mb-4">{{ __('complete payment') }}</h5>
                <p>
                    {!! setting('success_payment') !!}
                </p>
            </div>
        </div>
    </section>
@endsection
