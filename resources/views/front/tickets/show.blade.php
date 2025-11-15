@extends('front.layouts.front')
@section('content')
<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-11 col-lg-10 col-xl-9">
        <div class="content-side">
          <h5 class="header">اسم التذكرة</h5>
          <div class="blocks-tickets mb-4">
            <div class="box-ticket flex-column">
              <div class="info flex-row w-100 align-items-center gap-3">
                <div class="date">
                  رقم التذكرة : 2
                </div>
                <div class="date">
                  <i class="fa-solid fa-calendar-days"></i>
                  22-11-2023
                </div>
                <div class="date">
                  <i class="fa-solid fa-clock"></i>
                  منذ 57 دقيقة
                </div>
                <button class="btn-light btn-light-green">مفتوحة</button>
                <hr class="w-100 mt-0 mb-2" style="opacity: 0.2;">
              </div>
              <div class="content w-100">
                <p class="content line-text mb-0"> وصف تذكرة الدعم الفنى وهو نص تعريقى متوسط الحجم </p>
                <a target="_blank" href="#" class="btn btn-success btn-sm mt-2">تحميل المرفق</a>
              </div>
            </div>

          </div>
          <div class="row g-3">
            <form action="" method="post">
              <div class="col-12">
                <div class="inp-holder">
                  <textarea name="comment" rows="4" class="form-control" placeholder="أكتب تعليقك" id=""></textarea>
                </div>
              </div>
              <div class="col-12 col-md-12 mt-3">
                <div class="btn-holder">
                  <button type="submit" class="btn btn-primary btn-sm px-4">إرسال</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
