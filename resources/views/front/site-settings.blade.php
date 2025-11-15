@extends('front.layouts.front')
@section('content')

  <section class="main-section site-settings">
    <div class="container">
      <h4 class="main-heading">الأعدادات</h4>
      <form class="bg-white p-3 rounded-2 shadow" >
        <div class="row row-gap-24">
          <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">اسم الموقع بالعربي</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">اسم الموقع بالإنجليزي</label>
            <input type="text" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label"> البريد الإلكترونى</label>
            <input type="email" class="form-control">
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">@lang("Address")</label>
            <input type="text" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">@lang("City")</label>
            <input type="text" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">تغعيل الكفيل</label>
            <select class="w-100 main-select">
              <option value="1">نعم</option>
              <option value="0">لا</option>
            </select>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">تغعيل المرفقات في العقد</label>
            <select class="w-100 main-select">
              <option value="1">نعم</option>
              <option value="0">لا</option>
            </select>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">تفعيل اكثر من عقد للعميل</label>
            <select class="w-100 main-select" >
              <option value="1">نعم</option>
              <option value="0">لا</option>
            </select>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label"> @lang("Phone")</label>
            <input type="text" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label"> الهاتف</label>
            <input type="text" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label"> الرقم الإضافي</label>
            <input type="text" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label"> رقم المبنى</label>
            <input type="text" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">الضريبة</label>
            <input type="number" class="form-control" >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">رقم السجل التجاري</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <label for="" class="small-label">الرقم الضريبي</label>
            <input type="text" class="form-control">
        </div>
        </div>
      </form>
    </div>
  </section>
@endsection
