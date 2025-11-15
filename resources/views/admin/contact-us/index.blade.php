@extends('admin.layouts.admin')
@section('title', 'اتصل بنا | وارد')
@section('content')
<div class="main-side">
  <div class="main-title">
    <div class="small">
      @lang("Home")
    </div>
    <div class="large">
        اتصل بنا | وارد
    </div>
  </div>
  <div class="table-responsive">
    <table class="main-table mb-2">
      <thead>
          <tr>
              <th>#</th>
              <th>@lang("Name")</th>
              <th>الهاتف</th>
              <th>الايميل</th>
              <th>الرساله</th>
              <th>الوقت</th>
              <th>@lang("Actions")</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($contactuses as $item)
          <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $item->name }}</td>
              <td>{{ $item->phone }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->message }}</td>
              <td>{{ $item->created_at }}</td>

              <td>
                  {{-- @can('read_contact') --}}
                  <a class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                      data-bs-target="#show{{ $item->id }}">
                      <i class="fa fa-eye"></i>
                  </a>




                  @include('admin.contact-us.show-modal', ['item' => $item])
                  {{-- @endcan --}}
                  {{-- @can('delete_contact') --}}
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                      data-bs-target="#delete{{ $item->id }}">
                      <i class="fa-solid fa-trash"></i>
                  </button>

                  @include('admin.contact-us.delete-modal', [
                      'item' => $item,
                  ])
                  {{-- @endcan --}}
              </td>

          </tr>
      @endforeach
      </tbody>
    </table>
    {{ $contactuses->links() }}
  </div>
</div>
@endsection
