  <div class="main-title">
    <div class="small">
      @lang("Home")
    </div>
    <div class="large">
      {{$obj ? __("Edit"):__("Add")}} @lang("admin.Article sections")
    </div>
  </div>
  <div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
      <div class="inp-holder">
        <label class="special-input">
          <span>@lang("Name")</span>
          <input type="text" id="" wire:model="name" class="form-control">
        </label>
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
      <label class="special-input">
        <span>@lang("Image")</span>
        <input class="form-control" wire:model="image" type="file" accept="image/*">
      </label>
    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
      <div class="btn-holder">
        <button wire:click="submit" class="main-btn">@lang("Save")</button>
      </div>
    </div>
  </div>
