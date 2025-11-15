  <div class="main-title">
      <div class="small">
          @lang('Home')
      </div>
      <div class="large">
          {{ $obj ? __('Edit') : __('Add') }} السلايدر
      </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
      <div class="col">
          <div class="inp-holder">
              <label class="special-input">
                  <span>العنوان الاساسى</span>
                  <input type="text" wire:model="title_ar" class="form-control mb-1" placeholder="أكتب الاسم باللغة العربية">
                  <input type="text" wire:model="title_en" class="form-control" placeholder="أكتب الاسم باللغة الانجليزية">
              </label>
          </div>
      </div>
      <div class="col">
          <div class="inp-holder">
              <label class="special-input">
                  <span>@lang('Address') الثانى</span>
                  <input type="text" wire:model="subtitle_ar" class="form-control mb-1" placeholder="أكتب الاسم باللغة العربية">
                  <input type="text" wire:model="subtitle_en" class="form-control" placeholder="أكتب الاسم باللغة الانجليزية">
              </label>
          </div>
      </div>
      <div class="col">
          <div class="form-group mb-1" x-data="{ upload_image: false, progress: 0 }" x-on:livewire-upload-start="upload_image = true"
              x-on:livewire-upload-finish="upload_image = false" x-on:livewire-upload-cancel="upload_image = false"
              x-on:livewire-upload-error="upload_image = false"
              x-on:livewire-upload-progress="progress = $event.detail.progress">
              <label class="mb-1">@lang('Image')
                <small class="text-danger">
                1092px * 654px
                </small>
              </label>
              <input class="form-control" wire:model="cover" type="file" accept="image/*">
              <div class="progress-bar mt-2" x-show="upload_image">
                  <progress max="100" x-bind:value="progress"></progress>
              </div>
          </div>
          <img src="{{ $obj?->cover ? display_file($obj->cover) : asset('admin-asset/img/no-image.jpeg') }}"
              alt="" class="img-thumbnail img-preview" width="60px">
      </div>

      <div class="col-12">
          <div class="inp-holder">
              <label class="special-input">
                  <span>الرابط</span>
                  <input type="text" wire:model="link" class="form-control">
              </label>
          </div>
      </div>

      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
          <div class="btn-holder">
              <button wire:click="submit" class="main-btn">@lang('Save')</button>
          </div>
      </div>
  </div>
