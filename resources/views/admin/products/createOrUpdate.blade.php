<div class="main-title">
    <div class="small">
        @lang('admin.admin.Home')
    </div>
    <div class="large">
        @lang('admin.Add Product')
    </div>
</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-input d-flex gap-2">
                <input type="checkbox" wire:model.live="digital_product" @checked($digital_product)>
                <span>@lang('admin.Digital Product')</span>
            </label>
        </div>
    </div>
    @if ($digital_product)
        <div class="col-12 col-md-6">
            <div class="inp-holder">
                <label class="special-label">
                    @lang('admin.Digital Details')
                    <span class="text-danger fw-bold fs-10px">(@lang('admin.Digital product warning'))</span>
                </label>
                <textarea wire:model="digital_details" placeholder="@lang('admin.Enter digital details')" class="ckeditor form-control" rows="4"></textarea>
            </div>
        </div>
    @endif

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.Product Name')</span>
                <input type="text" wire:model="name" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-2">
        <label class="special-input">
            <span>@lang('admin.Product Type')
                <a href="{{ route('admin.product_types') }}" class="text-danger">
                    (@lang('admin.Manage Types'))
                </a>
            </span>
            <select class="form-select" wire:model="product_type_id">
                <option>@lang('admin.Select Product Type')</option>
                @foreach ($product_types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    @if (setting('product_colors_active'))
        <div class="col-12 col-md-6 col-lg-2">
            <label class="small-label" for="">
                @lang('admin.Available Colors')
                <a href="{{ route('admin.colors') }}" class="text-danger">
                    (@lang('admin.Manage Colors'))
                </a>
            </label>
            <div class="box-input">
                <select @disabled($toggle_sizes) wire:model="colors" multiple class="select2"
                    style="width: 100% !important;" id="colors">
                    @foreach (\App\Models\Color::get() as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div class="col-12 col-md-6 col-lg-2">
        <label class="special-input">
            <span>@lang('admin.Main Category')</span>
            <select class="form-select" wire:model.live="category_id" id="category_id">
                <option>@lang('admin.Select Main Category')</option>
                @foreach ($parentCategories as $mainCat)
                    <option value="{{ $mainCat->id }}">
                        {{ app()->getLocale() == 'ar' ? $mainCat->name_ar : $mainCat->name_en }}</option>
                @endforeach
            </select>
        </label>
    </div>


    <div class="col-12 col-md-6 col-lg-2">
        <label class="special-input">
            <span>@lang('admin.Sub Category')</span>
            <select class="form-select" wire:model="category_child_id" id="category_child_id">
                <option value="">select</option>
                @foreach ($childCategories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    @if (!$digital_product)
        <div class="col-12 col-md-4 col-lg-2">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Quantity')</span>
                    <input type="number" min="0" wire:model="quantity" class="form-control">
                </label>
            </div>
        </div>
    @endif

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.Purchase Price')</span>
                <input @disabled($toggle_sizes) type="number" min="0" wire:model="purchase_price"
                    class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.Sell Price')</span>
                <input @disabled($toggle_sizes) type="number" min="0" wire:model="sell_price"
                    class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.Discount Percentage') <a class="text-danger">(%)</a></span>
                <input @disabled($toggle_sizes) type="number" min="0" max="100"
                    wire:model.live="discount_percentage" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-label" for="">@lang('admin.Delivery Service')</label>
            <select wire:model="delivery_service" id="delivery_service" class="form-select">
                <option value="">@lang('admin.Choose')</option>
                <option value="1">@lang('admin.Yes')</option>
                <option value="0">@lang('admin.No')</option>
            </select>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-label" for="">@lang('admin.Status')</label>
            <select wire:model="active" class="form-select">
                <option value="">@lang('admin.Choose status')</option>
                <option value="1">@lang('admin.Active')</option>
                <option value="0">@lang('admin.In Active')</option>
            </select>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-input">
                <span>@lang('admin.Barcode')</span>
                <input type="text" wire:model="barcode" class="form-control">
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder mt-4">
            <label class="special-input d-flex gap-2">
                <input type="checkbox" wire:model="no_quantity">
                <span>@lang('admin.Sell Without Quantity')</span>
            </label>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-2" x-data="{ upload_image: false, progress: 0 }" x-on:livewire-upload-start="upload_image = true"
        x-on:livewire-upload-finish="upload_image = false" x-on:livewire-upload-cancel="upload_image = false"
        x-on:livewire-upload-error="upload_image = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <label class="special-input">
            <span>@lang('admin.Main product image') <b class="text-danger fs-10ox">@lang('admin.Main image size')</b></span>
            <input class="form-control" wire:model="image" type="file" accept="image/*">
            <div class="progress-bar mt-2" x-show="upload_image">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </label>


        @if ($image)
            <img src="{{ $image->temporaryUrl() }}" alt="" class="img-thumbnail img-preview"
                width="60px">
        @else
            @if ($obj && $obj->image)
                <img src="{{ display_file($obj->image) }}" alt="" class="img-thumbnail img-preview"
                    width="60px">
            @else
                <img src="{{ asset('admin-asset/img/image-preview.webp') }}" alt=""
                    class="img-thumbnail img-preview" width="60px">
            @endif
        @endif

    </div>


    <div class="col-12 col-md-4 col-lg-2" x-data="{ upload_images: false, progress: 0 }" x-on:livewire-upload-start="upload_images = true"
        x-on:livewire-upload-finish="upload_images = false" x-on:livewire-upload-cancel="upload_images = false"
        x-on:livewire-upload-error="upload_images = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <label class="special-input">
            <span>@lang('admin.Additional Images')</span>
            <input class="form-control" multiple wire:model="images" type="file" accept="image/*">
            <div class="progress-bar mt-2" x-show="upload_images">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </label>


        @if ($obj)
            @foreach ($obj->files as $file)
                <img width="60px" src="{{ display_file($file->path) }}" alt="">
            @endforeach
        @endif
    </div>


    <div class="col-12 col-md-6">
        <div class="inp-holder">
            <label class="special-label">
                @lang('admin.Description')
            </label>
            <div wire:ignore>
                <textarea id="ckeditor" class="form-control" wire:model="description" rows="4">{{ $description }}</textarea>
            </div>
        </div>
    </div>

    {{-- @push('js') --}}

    {{-- @endpush --}}
    <div class="col-12 col-md-4 col-lg-2">
        <div class="inp-holder">
            <label class="special-input d-flex gap-2">
                <input type="checkbox" wire:model.live="special_offer" value="1"
                    {{ $special_offer ? 'checked' : '' }}>
                <span>عروض مميزة</span>
            </label>
        </div>
    </div>


    <div class="col-12 col-md-6">
        <label>
            @lang('admin.Enable Extra Sizes')
            <i class="fa fa-exclamation-circle text-info" title="@lang('admin.Extra Sizes Info')"></i>
        </label>
        <input type="checkbox" wire:model.live="toggle_sizes">
        <a href="{{ route('admin.sizes') }}" class="text-danger">(@lang('admin.Manage Sizes'))</a>
    </div>

    @if ($toggle_sizes)
        @include('admin.products.variants')
    @endif
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="btn-holder mt-2 d-flex justify-content-center ">
            <button wire:click="submit" class="main-btn">@lang('Save')</button>
        </div>
    </div>
</div>
