@extends('admin.layouts.admin')
@section('title', 'عرض الرسالة')
@section('content')
    <section class="show-user">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-light p-3">
                <li class="breadcrumb-item"><a href="../">الواجهة</a></li>
                <li href="" class="breadcrumb-item" aria-current="page">
                    عرض الرسالة
                </li>
            </ol>
        </nav>
        <div class="content_view">

            <div class="row row-gap-24">

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <label for="name" class="small-label">@lang("Name")</label>
                    <input readonly type="text" value="{{ $contact->name }}" name="name" class="form-control"
                        id="name">
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <label for="email" class="small-label">البريد الالكتروني</label>
                    <input type="text" readonly value="{{ $contact->email }}" name="email" class="form-control"
                        id="email">
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <label for="phone" class="small-label">@lang("Phone")</label>
                    <input type="text" readonly value="{{ $contact->phone }}" name="phone" class="form-control"
                        id="phone">
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <label for="phone" class="small-label"> @lang("Address")</label>
                    <input type="text" readonly value="{{ $contact->subject }}" name="phone" class="form-control"
                        id="phone">
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <label for="phone" class="small-label"> الرسالة</label>
                    <textarea  readonly name="phone" class="form-control"
                        id="phone">{{ $contact->message }}</textarea>
                </div>


            </div>

        </div>
    </section>
@endsection
