@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
  <div class="main-title">
    <div class="small">
      @lang("Home")
    </div>
    <div class="large">
      تعديل مزود خدمة
    </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mb-2 g-3">
    <div class="col">
      <div class="inp-holder">
        <label class="special-input">
          <span>@lang("Name")</span>
          <input type="text" id="" class="form-control">
        </label>
      </div>
    </div>
    <div class="col">
      <div class="inp-holder">
        <label class="special-input">
          <span>@lang("Phone")</span>
          <input type="tel" id="" class="form-control">
        </label>
      </div>
    </div>
    <div class="col">
      <div class="inp-holder">
        <label class="special-input">
          <span> البريد الالكتروني</span>
          <input type="email" class="form-control" id="">
        </label>
      </div>
    </div>
    <div class="col">
      <div class="inp-holder">
        <label class="special-input">
          <span> @lang("Password")</span>
          <input type="number" class="form-control" id="">
        </label>
      </div>
    </div>
    <div class="col">
      <div class="inp-holder">
        <label class="special-label" for="">@lang("City")</label>
        <select id="" class="form-select">
          <option value="">@lang("Select city")</option>
        </select>
      </div>
    </div>
    <div class="col">
      <div class="form-group mb-1">
        <label class="mb-1">@lang("Image")</label>
        <input class="form-control" type="file" accept="image/*">
      </div>
      <img src="{{ asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
      <div class="btn-holder mt-4">
        <button type="button" class="main-btn">@lang("Save")</button>
      </div>
    </div>
  </div>
</div>
@endsection
