<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 mb-2 g-3">
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <h6 class="mb-3 text-center p-2 text-light bg-light-blue">
            @lang('admin.activation_options')
        </h6>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" type="checkbox" @checked(setting('active_client')) wire:model="active_client" id="active_client">
            <label class="form-check-label" for="active_client">
                @lang('admin.auto_activate_client')
            </label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" type="checkbox" @checked(setting('client_registration')) wire:model="client_registration" id="client_registration">
            <label class="form-check-label">
                @lang('admin.enable_client_registration')
            </label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" type="checkbox" @checked(setting('accept_comment_automatically')) wire:model="accept_comment_automatically" id="accept_comment_automatically">
            <label class="form-check-label">
                @lang('admin.auto_accept_comment')
            </label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="is_slider_active" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_slider')</label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="is_about_us_active" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_about_us')</label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="is_comments_active" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_comments')</label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="product_colors_active" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_product_colors')</label>
        </div>
    </div>
    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="enable_default_banner" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_default_banner')</label>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <h6 class="mb-3 text-center p-2 text-light bg-light-blue">
            @lang('admin.payment_gateways')
        </h6>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="is_banks_active" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_bank_accounts')</label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="is_stc_active" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_stc_pay')</label>
        </div>
    </div>

    <div class="col">
        <div class="form-check form-switch">
            <input class="form-check-input color-check" wire:model="is_tamara_active" type="checkbox" role="switch">
            <label class="form-label">@lang('admin.enable_tamara')</label>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    <button wire:click="save" class="btn btn-success btn-sm">@lang('admin.save')</button>
</div>
