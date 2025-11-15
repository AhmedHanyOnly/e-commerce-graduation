<div class="d-flex align-items-center justify-content-between gap-3 mb-3">
    <div class="main-title mb-0">
        <div class="small">@lang("Home")</div>
        <div class="large">{{ $obj ? __("Edit"):__("Add")}} @lang("admin.Category")</div>
    </div>
    <button class="main-btn btn-main-color" wire:click='$set("screen","index")'>@lang("Show all sections")</button>
</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang("Section Name")</label>
        <input type="text" wire:model.defer="name" class="form-control">
    </div>


    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang("Status")</label>
        <select wire:model.defer="status" class="form-control">
            <option value="">@lang("Choose status")</option>
            <option value="1">@lang("Active")</option>
            <option value="0">غير مفعل</option>
        </select>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <label for="">القسم الرئيسي</label>
        <select wire:model.defer="parent_id" class="form-control">
            <option value="">اختر القسم</option>
            @foreach(\App\Models\Category::whereNull('parent_id')->get() as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <label class="mb-1">@lang("Image")</label>
        <input class="form-control img" wire:model="img" type="file" accept="image/*">
        @error('cover')<span class="text-danger">{{ $message }}</span>@enderror

    </div>
    <div class="form-group">
        <img src="{{ asset('admin-asset/img/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">
    </div>




    <div class="col-12">
        <button class="main-btn" wire:click='submit'>@lang("Save")</button>
    </div>
</div>
