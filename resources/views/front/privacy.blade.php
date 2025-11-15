@extends('front.layouts.front')
@section('content')
<section class="fqa-section main-section">
    <div class="container">
        <div class="bg-white rounded shadow p-3">
        <h5 class="main-title mb-4">{{ __('privacy policy') }}</h5>
            <p>
                {!! setting('privacy_policy') !!}

            </p>
        </div>
    </div>
</section>
@endsection


