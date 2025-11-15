<div class="main-title">
    <div class="small">
        @lang("Home")
    </div>
    <div class="large">{{ $obj ? __("Edit"):__("Add")}} التصميم</div>

</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang("Name")</span>
                <input type="text" wire:model="name" class="form-control">
            </label>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label class="special-input">
            <span>@lang("Image")</span>
            <input class="form-control" wire:model="image" type="file" accept="image/*">
        </label>
    </div>
    <div class="col-12 m-0">
        <hr class="m-0 border-0">
    </div>
    {{-- <div class="col-12 col-md-6 col-lg-3">
        <label class="special-input">
            <span>@lang("Category")</span>
            <select class="form-select" wire:model="category_id">
                <option>---@lang("Select category") ---</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </label>
    </div> --}}

    <div class="col-12 col-md-8 col-lg-6">
        <div class="inp-holder">
            <label class="special-label">
                @lang("admin.Description")
            </label>
            <textarea  wire:model="description" class="ckeditor form-control" rows="4"></textarea>
        </div>
    </div>
    <div class="col-12 m-0">
        <hr class="m-0 border-0">
    </div>
{{--    <div class="col-12 col-md-4 col-lg-3">--}}
{{--        <div class="inp-holder">--}}
{{--            <label class="special-label" for="">@lang("Status")</label>--}}
{{--            <select wire:model="active" id="" class="form-select">--}}
{{--                <option value="">@lang("Choose status")</option>--}}
{{--                <option value="1">@lang("Active")</option>--}}
{{--                <option value="0">غير مفعل</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="btn-holder mt-2">
            <button wire:click="submit" class="main-btn">@lang("Save")</button>
        </div>
    </div>
</div>
