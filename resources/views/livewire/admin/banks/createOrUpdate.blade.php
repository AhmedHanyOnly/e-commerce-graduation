<div class="main-title">
    <div class="small">
        @lang('admin.Home')
    </div>
    <div class="large">
        {{ $obj ? __('admin.EditBankAccount') : __('admin.AddBankAccount') }}
    </div>
</div>

<div class="row g-3">

    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.BankName')</span>
                <input type="text" wire:model="bank_name" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.OwnerName')</span>
                <input type="text" wire:model="owner_name" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.AccountNumber')</span>
                <input type="number" min="0" wire:model="number" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.IBAN')</span>
                <input type="text" min="0" wire:model="iban" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <label class="special-input">
            <span>@lang('admin.Image')</span>
            <input class="form-control" wire:model="image" type="file" accept="image/*">
        </label>

        @if($image)
            <div class="mt-2">
                <img width="50" src="{{ $obj ? display_file($obj->image) : $image->temporaryUrl() }}">
            </div>
        @endif
    </div>

    <div class="col-12">
        <div class="btn-holder mt-2">
            <button wire:click="submit" class="main-btn">@lang('admin.Save')</button>
        </div>
    </div>

</div>
