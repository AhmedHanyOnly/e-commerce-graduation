@extends('front.layouts.front')
@section('content')

  <section class="main-section py-5">
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card card-side  h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile text-center">
                               <div class="user-avatar">
                                    <img src="./img/login_bg.png" alt="">
                                </div>
                                <h5 class="user-name">باسم جابر</h5>
                                <h6 class="user-email">Basem@b.b</h6>
                            </div>
                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    <div class="d-flex align-items-center gap-1">
                                      الأشتراك
                                    <div class="badge-count">5</div>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    تعديل بياناتي
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>

                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    الحجوزات
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>

                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    أضف رأيك
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    اتصل بنا
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href=""
                                    class="btn-icon justify-content-between text-danger d-flex">
                                    الخروج
                                    <div class="icon text-danger">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card ">
                        <div class="card-body">
                          <h6 class="mb-2 text-primary">الاشتراك</h6>
                          <div class="table-responsive">
                            <table class="table main-table">
                              <thead>
                                <tr>
                                  <th>الباقة  </th>
                                  <th>البداية</th>
                                  <th>النهاية</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>باقة 1</td>
                                  <td>2022/2/2</td>
                                  <td>2022/5/2</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
