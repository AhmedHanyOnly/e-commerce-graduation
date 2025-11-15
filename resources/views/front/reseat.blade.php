@extends('front.layouts.front')
@section('content')

  <section class="loginPage main-section py-5">
    <div class="container">
        <div class="row login_box shadow-lg w-50">
            <div class="col-12">
                <form class="login-form " action="" method="POST">
                    <div class="login_content w-100">
                        <h6 class="title"> استعاده كلمة المرور</h6>
                        <div class="inp_holder">
                            <label for="" class="login-label">البريد الاليكتروني</label>
                            <input type="email" class="login-inp form-control" name="email">
                        </div>

                        <div class="btn_holder">
                            <button class="btn login-btn"> استعادة</button>
                        </div>
                        <a href="" class="mt-2  d-block">
                            ليس لديك عضوية ؟
                        </a>
                        <hr class="my-4">
                        <div class="login_footer d-flex align-items-center justify-content-center">
                            <a href="https://www.const-tech.org/">
                                برمجة وتطوير كوكبة التقنية
                                <img src="./img/login_logo.png" width="60"
                                    alt="logo_login">
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
