@extends('front.layouts.front')
@section('content')
<section class="main-section">
  <div class="container">
    <h4 class="main-heading">إنشاء تذكرة جديدة</h4>
    <div class="row justify-content-center">
      <div class="col-12 col-md-11 col-lg-10 col-xl-8">
        <div class="content-side">
          <div class="row g-3">
            <div class="col-12 col-md-6">
              <div class="inp-holder">
                <label for="" class="small-label">عنوان التذكرة</label>
                <input type="text" name="title" class="form-control" value="" placeholder="أدخل عنوان التذكرة">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="inp-holder">
                <label for="" class="small-label">اختر النوع</label>
                <select name="type" class="main-select w-100" id="">
                  <option value="">اختر النوع</option>
                  <option value="orders">
                    الطلبات</option>
                  <option value="activate_mempership">تفعيل
                    العضوية</option>
                  <option value="other">
                    آخرى</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="inp-holder">
                <label for="" class="small-label">وصف الخدمة</label>
                <textarea name="description" rows="4" class="form-control" placeholder="أدخل وصف الخدمة" id=""></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="inp-holder">
              <label for="" class="small-label">مرفق</label>
              <input type="file" name="file" class="form-control">
              </div>
            </div>
            <div class="col-12 col-md-12">
              <div class="btn-holder">
                <button type="submit" class="btn btn-sm btn-success px-4">إنشاء تذكرة</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
