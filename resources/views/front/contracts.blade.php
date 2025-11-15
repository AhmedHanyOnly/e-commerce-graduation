@extends('front.layouts.front')
@section('content')

<section class="main-section home">
    <div class="container">
      <h4 class="main-heading">العقود</h4>
      <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-2">
        <div class="d-flex align-items-center gap-2">
          <input type="text" class="form-control" placeholder="أبحث عن عقد" name="" id="" />
          <select class="main-select " name="" id="">
            <option value="">كل العقود</option>
            <option value=""> @lang("Active")</option>
            <option value="">غير مفعل </option>
          </select>
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add" class="btn-main-sm">
          أضف عقد
          <i class="icon fa-solid fa-plus"></i>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modal-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">أضف عقد جديد </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row row-gap-24">
                  <div class=" col-sm-4">
                    <label class="small-label" for="">  المستثمر: </label>
                    <input class="form-control" type="text" placeholder="">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> العميل:</label>
                    <input class="form-control" type="number" placeholder="  ">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> @lang("Status"):</label>
                    <select class="main-select w-100" name="" id="">
                      <option value="">@lang("City")</option>
                    </select>
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> تاريخ كتابة العقد:</label>
                    <input class="form-control" type="date" name="" id="">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> نوع الجدولة:</label>
                    <input class="form-control" type="number" placeholder=" ">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> 	تاريخ أول قسط :</label>
                    <input class="form-control" type="date" name="" id="">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> قيمة العقد	 :</label>
                    <input class="form-control" type="number" name="" id="">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for="">  عدد الأٌقساط	 :</label>
                    <input class="form-control" type="number" name="" id="">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn-main-sm ">@lang("Save")</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table main-table">
          <thead>
            <tr>
              <th>رقم العقد </th>
              <th> المستثمر</th>
              <th>العميل</th>
              <th>@lang("Status")</th>
              <th> تاريخ كتابة أول عقد</th>
              <th> نوع الجدولة</th>
              <th> تاريخ أول قسط</th>
              <th>  قيمة العقد </th>
              <th> عدد الأقساط </th>
              <th class="text-center">التحكم</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#1</td>
              <td>باسم</td>
              <td>باسم</td>
              <td>@lang("Active")</td>
              <td>2022/2/2</td>
              <td>شهري</td>
              <td>2022/2/2</td>
              <td>50ريال</td>
              <td>5</td>
              <td >
                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                  <div class="btn btn-sm btn-warning">
                    <i class="fa-solid fa-print"></i>
                  </div>
                  <div class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </div>
                  <div class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-trash-can"></i>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
