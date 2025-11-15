<div class="row g-3 align-items-end">

    <div class="col-12 col-md-12 col-lg-12 col-xl-12 d-md-none">
        <div class="d-flex justify-content-center mb-3">
            <img src="{{ asset('front-asset/img/clickpay.svg') }}" width="80" alt="ClickPay Logo">
        </div>
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">@lang('admin.clickpay_server_key')</label>
        <input class="form-control" wire:model="clickpay_server_key">
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">@lang('admin.clickpay_profile_id')</label>
        <input class="form-control" wire:model="clickpay_profile_id">
    </div>

    <div class="col-12 col-md-2">
        <div class="d-flex gap-2 align-items-center">
            <input type="checkbox" wire:model="is_clickpay_active" id="is_clickpay_active">
            <label class="form-label d-block" for="is_clickpay_active">@lang('admin.activate_clickpay')</label>
        </div>
    </div>

    <div class="col-2 d-none d-md-block">
        <div class="d-flex justify-content-end">
            <img src="{{ asset('front-asset/img/clickpay.svg') }}" width="80" alt="ClickPay Logo">
        </div>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12 d-md-none">
        <div class="d-flex justify-content-center my-3">
            <img src="{{ asset('front-asset/img/stc.png') }}" width="80" alt="STC Pay Logo">
        </div>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">@lang('admin.stcpay_phone')</label>
        <input class="form-control" wire:model="stcpay_phone">
    </div>

    <div class="col-6 d-none d-md-block">
        <div class="d-flex justify-content-end">
            <img src="{{ asset('front-asset/img/stc.png') }}" width="80" alt="STC Pay Logo">
        </div>
    </div>

    <div class="col-12 d-flex justify-content-center mt-4">
        <button wire:click="save" class="btn btn-success btn-sm">@lang('admin.save')</button>
    </div>

</div>
