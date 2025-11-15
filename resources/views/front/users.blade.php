@extends('front.layouts.front')
@section('content')

  <section class="main-section users">
    <div class="container">
      <h4 class="main-heading">@lang("Clients")</h4>
      <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-2">
        <div class="d-flex align-items-center gap-2">
          <input type="text" class="form-control" placeholder="أبحث عن عميل" name="" id="" />
          <select class="main-select " name="" id="">
            <option value="">@lang("All clients")</option>
            <option value=""> @lang("Active")</option>
            <option value="">غير مفعل </option>
          </select>
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add" class="btn-main-sm">
          أضف عميل
          <i class="icon fa-solid fa-plus"></i>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modal-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">أضف عميل جديد </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row row-gap-24">
                  <div class=" col-sm-4">
                    <label class="small-label" for="">أسم العميل بالعربي </label>
                    <input class="form-control" type="text" placeholder="">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for="">جوال العميل:</label>
                    <input class="form-control" type="number" placeholder="  ">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> @lang("City"):</label>
                    <select class="main-select w-100" name="" id="">
                      <option value="">@lang("City")</option>
                    </select>
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> الكفيل:</label>

                    <input class="form-control" type="text" placeholder=" ">
                  </div>
                  <div class=" col-sm-4">
                    <label class="small-label" for=""> جوال الكفيل:</label>

                    <input class="form-control" type="number" placeholder=" ">
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
              <th>اسم العميل </th>
              <th>جوال العميل</th>
              <th>@lang("City")</th>
              <th>الكفيل</th>
              <th>جوال الكفيل</th>
              <th class="text-center">التحكم</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>باسم</td>
              <td>1234567</td>
              <td>الرياض</td>
              <td>- </td>
              <td>- </td>
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
