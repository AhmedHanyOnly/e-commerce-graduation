@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
  <div class="main-title">
    <div class="small">
      @lang("Home")
    </div>
    <div class="large">
      رسائل صور
    </div>
  </div>
  <div class="row g-3">
    <div class="col-12 col-lg-6">
      <label class="special-label" for="siteLogo">المحتوى</label>
      <textarea id="" rows="7" class="form-control" placeholder="اكتب محتوي رسالتك ..."></textarea>
    </div>
    <div class="col-12 col-lg-6">
      <div class="inp-holder">
        <label class="special-input">
          <span>ارفاق صورة</span>
          <input type="file" id="" class="form-control">
        </label>
      </div>
    </div>
    <div class="col-12">
      <div class="btn-holder">
        <button type="button" class="main-btn">@lang("Save")</button>
      </div>
    </div>
  </div>
</div>
@endsection
