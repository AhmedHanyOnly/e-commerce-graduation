<div class="main-title">
    <div class="small">
        @lang('admin.Home')
    </div>
    <div class="large">
        @lang('admin.Add article')
    </div>
</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.Address')</span>
                <input type="text" wire:model="title" class="form-control">
            </label>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label class="special-input">
            <span>@lang('admin.Image')</span>
            <input class="form-control" wire:model="image" type="file" accept="image/*">
        </label>
    </div>
    <div class="col-12 m-0">
        <hr class="m-0 border-0">
    </div>
    <div class="col-12 col-md-8 col-lg-6">
        <div class="inp-holder">
            <label class="special-label">
                {{__('admin.Content')}}
            </label>
            <textarea name="content" wire:model="content" class="ckeditor form-control" rows="4"></textarea>
        </div>
    </div>
    <div class="col-12 m-0">
        <hr class="m-0 border-0">
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-label" for="">@lang('admin.Status')</label>
            <select wire:model="active" id="" class="form-select">
                <option value="">@lang('admin.Choose status')</option>
                <option value="1">{{__('Active')}}</option>
                <option value="0">{{__('admin.Inactive')}}</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-label" for="">@lang('admin.The categorie')</label>
            <select wire:model="active" id="" class="form-select">
                <option value="">@lang('admin.Choose categorie')</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="btn-holder mt-2">
            <button wire:click="submit" class="main-btn">{{__('admin.Save')}}</button>
        </div>
    </div>
</div>
@push('js')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });

</script>
@endpush
