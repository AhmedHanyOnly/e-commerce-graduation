  <div class="main-title">
      <div class="small">
          @lang('Home')
      </div>
      <div class="large">
          {{ $obj ? __('Edit') : __('Add') }} البانر
      </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">

      <div class="col">
          <div class="form-group mb-1" x-data="{ upload_image: false, progress: 0 }" x-on:livewire-upload-start="upload_image = true"
              x-on:livewire-upload-finish="upload_image = false" x-on:livewire-upload-cancel="upload_image = false"
              x-on:livewire-upload-error="upload_image = false"
              x-on:livewire-upload-progress="progress = $event.detail.progress">
              <label class="mb-1">بانر علوى
                <small class="text-danger">
                1092px * 654px
                </small>
              </label>
              <input class="form-control" wire:model="image_one" type="file" accept="image/*">
              <div class="progress-bar mt-2" x-show="upload_image">
                  <progress max="100" x-bind:value="progress"></progress>
              </div>
          </div>
          <img src="{{ $obj?->image_one ? display_file($obj->image_one) : asset('admin-asset/img/no-image.jpeg') }}"
              alt="" class="img-thumbnail img-preview" width="60px">
      </div>
      <div class="col">
          <div class="form-group mb-1" x-data="{ upload_image: false, progress: 0 }" x-on:livewire-upload-start="upload_image = true"
              x-on:livewire-upload-finish="upload_image = false" x-on:livewire-upload-cancel="upload_image = false"
              x-on:livewire-upload-error="upload_image = false"
              x-on:livewire-upload-progress="progress = $event.detail.progress">
              <label class="mb-1">بانر سفلى
                <small class="text-danger">
                1092px * 654px
                </small>
              </label>
              <input class="form-control" wire:model="image_two" type="file" accept="image/*">
              <div class="progress-bar mt-2" x-show="upload_image">
                  <progress max="100" x-bind:value="progress"></progress>
              </div>
          </div>
          <img src="{{ $obj?->image_two ? display_file($obj->image_two) : asset('admin-asset/img/no-image.jpeg') }}"
              alt="" class="img-thumbnail img-preview" width="60px">
      </div>



      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
          <div class="btn-holder">
              <button wire:click="submit" class="main-btn">@lang('Save')</button>
          </div>
      </div>
  </div>



