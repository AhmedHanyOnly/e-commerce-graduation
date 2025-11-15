  <div class="row g-3">
    <div class="col-12 col-lg-6">
      <label class="special-label" for="siteLogo">المحتوى</label>
      <textarea id="" rows="7" class="form-control" placeholder="اكتب محتوي رسالتك ..." wire:model.defer='content'></textarea>
    </div>
    @if($attach==2)
    <div class="col-12 col-lg-6">
      <div class="inp-holder">
        <label class="special-input">
          <span>ارفاق صورة</span>
          <input type="file" id="" class="form-control" wire:model='img'>
        </label>
      </div>
    </div>
    @endif
    <div class="col-12">
      <div class="btn-holder">
        <button type="button" class="main-btn" wire:click='submit'>@lang("Save")</button>
      </div>
    </div>
  </div>
