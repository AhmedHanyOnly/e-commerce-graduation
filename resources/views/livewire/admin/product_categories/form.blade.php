<div class="d-flex align-items-center justify-content-between gap-3 mb-3">
    <div class="main-title mb-0">
        <div class="small">{{ __('admin.Home') }}</div>
        <div class="large">{{ $obj ? __('Edit') : __('Add') }} @lang('admin.category')</div>
    </div>
    <button class="main-btn btn-main-color" wire:click='$set("screen","index")'>@lang('Show all sections')</button>
</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Name')</label>
        <input type="text" wire:model="name" class="form-control">
    </div>
 
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Status')</label>
        <select wire:model="status" class="form-control">
            <option value="">@lang('Choose status')</option>
            <option value="1">@lang('Active')</option>
            <option value="0">@lang('In Active')</option>
        </select>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group mb-1">
            <label class="mb-1">@lang('Image')</label>
            <input class="form-control img" wire:model="image" type="file" accept="image/*">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @if ($image)
        <img src="{{ $image->temporaryUrl() }}" alt="" class="img-thumbnail img-preview" width="60px">
        @else
        @if ($obj && $obj->image)
        <img src="{{ display_file($obj->image) }}" alt="" class="img-thumbnail img-preview" width="60px">
        @else
        <img src="{{asset('admin-asset/img/image-preview.webp')}}" alt="" class="img-thumbnail img-preview" width="60px">
        @endif
        @endif

    </div>

    <div class="col-12">
        <button class="main-btn" wire:click='submit'>@lang('Save')</button>
    </div>
</div>
