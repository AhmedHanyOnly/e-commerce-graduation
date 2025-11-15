@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
    <div class="d-flex justify-content-between align-items-center ">
        <div class="main-title">
            <div class="small">
                @lang("Home")
            </div>
            <div class="large">
                عرض مزود خدمة
            </div>
        </div>
        <a href="{{url()->previous()}}" class="btn btn-secondary btn-sm">
            رجوع
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">بيانات مزود الخدمة</button>
        </li>
        {{-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#drive-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">السائق</button>
        </li> --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#balance-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">الرصيد</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="row mb-2 g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>@lang("Name")</span>
                            <input type="text" value="{{ $vendor->name }}" disabled id="" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>@lang("Phone")</span>
                            <input type="tel" id="" value="{{ $vendor->phone }}" disabled class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span> البريد الالكتروني</span>
                            <input type="email" value="{{ $vendor->email }}" disabled class="form-control" id="">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>@lang("City")</span>
                            <input type="text" value="{{ $vendor->city?->name }}" disabled id="" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>@lang("admin.Neighborhoods")</span>
                            <input type="text" value="{{ $vendor->neighborhood?->name }}" disabled id="" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>رقم السجل التجاري</span>
                            <input type="number" value="{{ $vendor->commercial_record_number }}" disabled class="form-control" id="">
                        </label>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الحساب البنكي</span>
                            <input type="text" value="{{ $vendor->bank_account }}" disabled class="form-control" id="">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>وقت العمل من</span>
                            <input type="text" value="{{ $vendor->from_time }}" disabled class="form-control" id="">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>وقت العمل الي</span>
                            <input type="text" value="{{ $vendor->to_time }}" disabled class="form-control" id="">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="form-group mb-1">
                        <label class="mb-1">صورة السجل التجاري</label>
                        <img src="{{ $vendor?->commercial_record_image? display_file($vendor->commercial_record_image):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
                    </div>

                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="form-group mb-1">
                        <label class="mb-1">@lang("Image")</label>
                        <img src="{{ $vendor?->image? display_file($vendor->image):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
                    </div>

                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="form-group mb-1">
                        <label class="mb-1">صورة الشعار</label>
                        <img src="{{ $vendor?->logo? display_file($vendor->logo):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
                    </div>

                </div>

                <div class="mt-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1550.182918817115!2d33.83975063467317!3d27.228657374366747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1711183283080!5m2!1sar!2seg" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        {{-- <div class="tab-pane fade" id="drive-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="d-flex justify-content-end ">
                <a href="{{route('admin.drivers',['screen' => 'create','vendor_id' => $vendor->id])}}" class="main-btn my-3">
                    اضافة سائق
                </a>
            </div>
            <div class="table-responsive">
                <table class="main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang("Name") </th>
                            <th>@lang("Phone") </th>
                            <th>البريد الالكتروني</th>
                            <th>المدينة</th>
                            <th>الحي</th>
                            <th>نوع السيارة </th>
                            <th>اسم السيارة </th>
                            <th>الموديل </th>
                            <th>تقديم الخدمات </th>
                            <th>الطلبات</th>
                            <th>@lang("Actions")</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendor->vendorDrivers as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->city?->name ?? '--' }}</td>
                            <td>{{ $user->neighborhood?->name ?? '--' }}</td>

                            <td>{{$user->carType?->name}}</td>
                            <td>{{$user->car_name}}</td>
                            <td>{{$user->car_model}}</td>
                            <td> {{ $user->can_serve ? __('admin.can_serve_' . $user->can_serve) : '--'  }}</td>
                            <td>
                                <a href="{{ route('admin.orders',['driver_id' => $user->id]) }}">
                                    <div class="main-btn btn-orange ">
                                        {{ $user->driverOrders->count() }}
                                    </div>
                                </a>
                            </td>

                            <td>
                                <div class="d-flex gap-3 ">
                                    <a href="{{ route('admin.drivers.show',$user->id) }}">
                                        <i class="fas fa-eye text-primary icon-table"></i>
                                    </a>
                                    <a href="{{ route('admin.drivers.edit',$user->id) }}">

                                        <i class="fas fa-pen text-info icon-table"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>


                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
        <div class="tab-pane fade" id="balance-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="box-content mb-3 border mt-3">
                <div class="items items-money">
                    <div class="item item-1">
                        <div class="title gray sm">
                            الرصيد القابل للسحب
                        </div>
                        <div class="price">
                            500 <span>$</span>
                        </div>
                    </div>
                    <div class="item item-2">
                        <div class="title gray sm">
                            الرصيد المتاح
                        </div>
                        <div class="price">
                            500 <span>$</span>
                        </div>
                    </div>
                    <div class="item item-3">
                        <div class="title gray sm">
                            الرصيد المتاح
                        </div>
                        <div class="price">
                            111 <span>$</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
