<div class="row g-3">
    <x-admin-alert/>

    <div class="col-12 col-md-3 ">
        <div class="profile-bar">
            <div class="d-flex align-items-start">
           <div class="nav flex-column nav-pills list-option" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link {{ $screen == 'general' ? 'active' : '' }}" type="button"
        aria-selected="true" wire:click='$set("screen","general")'>
        <div class="name">
            <i class="fa-solid fa-gear"></i>
            @lang('admin.Settings')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </button>

    <!-- <button class="nav-link {{ $screen == 'gateways' ? 'active' : '' }}" type="button"
        aria-selected="true" wire:click='$set("screen","gateways")'>
        <div class="name">
            <i class="fa-solid fa-money-bill-wave"></i>
            @lang('admin.PaymentGateways')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </button> -->

    <button class="nav-link {{ $screen == 'program' ? 'active' : '' }}" type="button"
        aria-selected="true" wire:click='$set("screen","program")'>
        <div class="name">
            <i class="fa-solid fa-tablet-screen-button"></i>
            @lang('admin.ProgramOptions')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </button>

    {{--
    <button class="nav-link {{ $screen == 'company' ? 'active' : '' }}" type="button"
        aria-selected="true" wire:click='$set("screen","company")'>
        <div class="name">
            <i class="fa-solid fa-building"></i>
            @lang('admin.InstallmentCompanies')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </button>
    --}}

    <!-- <button class="nav-link {{ $screen == 'sms' ? 'active' : '' }}" type="button" aria-selected="true"
        wire:click='$set("screen","sms")'>
        <div class="name">
            <i class="fas fa-comment"></i>
            @lang('admin.SMSWhatsapp')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </button> -->

    <a href="{{ route('admin.settings', ['screen' => 'policy']) }}"
        class="nav-link {{ $screen == 'policy' ? 'active' : '' }}" aria-selected="true">
        <div class="name">
            <i class="fa-solid fa-file-shield"></i>
            @lang('admin.PrivacyPolicy')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </a>

    <a class="nav-link {{ $screen == 'usage' ? 'active' : '' }}" aria-selected="true"
        href="{{ route('admin.settings', ['screen' => 'usage']) }}">
        <div class="name">
            <i class="fa-solid fa-file-pen"></i>
            @lang('admin.ReturnPolicy')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </a>

    <a class="nav-link {{ $screen == 'terms' ? 'active' : '' }}"
        href="{{ route('admin.settings', ['screen' => 'terms']) }}" aria-selected="true">
        <div class="name">
            <i class="fa-solid fa-file-circle-question"></i>
            @lang('admin.TermsAndConditions')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </a>

    <a class="nav-link {{ $screen == 'success_payment' ? 'active' : '' }}"
        href="{{ route('admin.settings', ['screen' => 'success_payment']) }}" aria-selected="true">
        <div class="name">
            <i class="fa-solid fa-file-circle-question"></i>
            @lang('admin.PaymentSuccess')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </a>

    <!-- <a class="nav-link {{ $screen == 'about' ? 'active' : '' }}"
        href="{{ route('admin.settings', ['screen' => 'about']) }}" aria-selected="true">
        <div class="name">
            <i class="fa-solid fa-laptop-file"></i>
            @lang('admin.AboutUs')
        </div>
        <i class="fa-solid fa-angle-left"></i>
    </a> -->
</div>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-9 ">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="content_view">
                <div class="content_header">
                    <div class="title fs-11px">
                        <i class="fa-solid fa-gear fs-12px main-red-color"></i>
                        {{ __('admin.Settings') }}
                    </div>
                </div>

                @include('livewire.admin.settings.screens.' . $screen)

            </div>
        </div>
    </div>
    {{-- <div class="col-12 text-center mt-5">

        <a href="{{ route('backup-database') }}" class="btn btn-primary">{{ __('Export website databases') }}</a>
</div> --}}
</div>
