@extends('front.layouts.front')
@section('title', __('Frequently Asked Questions'))
@section('content')
@php
$faqs = App\Models\Faq::all();
@endphp
<section class="fqa-section main-section">
    <div class="container">

        <div class="bg-white rounded shadow p-3">
            <div class="d-flex justify-content-center ">
                <div class="main-title">
                    {{ __('Frequently Asked Questions') }}
                </div>
            </div>
            <div class="accordion main-accordion accordion-flush faq mb-4" id="accordionFlushExample">
                @foreach($faqs as $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}" aria-expanded="false">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
