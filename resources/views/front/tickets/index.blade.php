@extends('front.layouts.front')
@section('content')
<section class="main-section">
  <div class="container">
    <h4 class="main-heading">تذاكر الدعم الفنى</h4>
    <div class="content-side">
      <div class="between-box mb-4">
        <p class="sm-des mb-0"> <span class="me-1">1</span> تذاكر متاحة</p>
        <a href="{{ route('tickets.create') }}" class="btn-icon-cr">
          إنشاء تذكرة جديدة
          <div class="icon">
            <img src="{{ asset('front-asset/img/icons/ticket.svg') }}" alt="">
          </div>
        </a>
      </div>
      <div class="blocks-tickets">
        <div class="box-ticket">
          <div class="info">
            <div class="date">
            <i class="fa-solid fa-calendar-days"></i>
              منذ ثانية
            </div>
            <p class="content">
              دعم فنى
            </p>
          </div>
          <div class="options">
            <button class="btn-light btn-light-green">مفتوحة</button>
            <a href="{{ route('tickets.show') }}"
              class="btn-gradient-gold">
              عرض
              <i class="fas fa-long-arrow-alt-left"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
