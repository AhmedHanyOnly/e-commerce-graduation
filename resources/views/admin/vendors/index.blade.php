@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
  <div class="main-title">
    <div class="small">@lang("Home")</div>
    <div class="large">مزود الخدمة</div>
  </div>
  <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
    <div class="btn-holder">
      <a href="{{ route('admin.vendors.create') }}" class="main-btn">@lang("Add")</a>
    </div>
    <div class="box-search">
      <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
      <input type="search" id="" placeholder="@lang('admin.Search')" />
    </div>
  </div>
  <div class="table-responsive">
    <table class="main-table">
      <thead>
        <tr>
          <th>#</th>
          <th>@lang("Photo") </th>
          <th>@lang("Name") </th>
          <th>@lang("Phone") </th>
          <th>البريد الالكتروني</th>
          <th>@lang("Status")</th>
          <th>@lang("Actions")</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>
            <img src="{{ asset('admin-asset/img/no-image.jpeg') }}" class="img-thumbnail img-preview" alt="" width="50">
          </td>
          <td>علي العايدى</td>
          <td>
            04758697038
          </td>
          <td>v@v.com</td>
          <td>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="">
            </div>
          </td>
          <td>
            <div class="btn-holder d-flex align-items-center gap-3">
              <a href="{{ route('admin.vendors.edit') }}">
                <i class="fas fa-pen text-info icon-table"></i>
              </a>
              <button type="button" data-bs-toggle="modal" data-bs-target="#delete">
                <i class="fas fa-trash text-danger icon-table"></i>
              </button>
            </div>
            @include('admin.vendors.delete-modal')
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
