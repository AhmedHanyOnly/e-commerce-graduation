@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Settings') }}
@endsection
@section('content')
<div class="main-side">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.Home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Settings') }}</li>
        </ol>
    </nav>
    @livewire('admin.settings.settings')
    @push('js')
    <script>
        var status = document.getElementById("evening_status");
        status.addEventListener('change', function() {
            document.getElementById("#from_evening").disabled = !element.disabled;
            document.getElementById("#to_evening").disabled = !element.disabled;
        })
    </script>
    @endpush
</div>
@endsection
