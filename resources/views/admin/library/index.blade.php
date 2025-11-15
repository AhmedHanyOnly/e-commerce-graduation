@extends('admin.layouts.admin')
@section('content')

<div class="main-side">
    <x-admin-alert />
    <div class="main-title">
        <div class="small">
            {{__('admin.Home')}}
        </div>
        <div class="large">
            @lang('admin.Notifications Library')
        </div>
    </div>

    <div class="btn-holder d-flex align-items-center justify-content-between gap-1 flex-wrap mb-2">
        <div class="btn-holder d-flex align-items-center gap-1">

            <div class="btn-holder">
                <button data-bs-target="#exampleModal" data-bs-toggle="modal" class="btn btn-success">@lang('admin.Add')</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('admin.Message')</th>
                    <th>@lang('admin.Control')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libraries as $library)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{!! $library->content !!}</td>
                    <td>
                        <button data-bs-target="#editModal{{$library->id}}" data-bs-toggle='modal' class="btn btn-success btn-sm"><i class="fa fa-pen"></i></button>
                        <button data-bs-target="#deleteModal{{$library->id}}" data-bs-toggle='modal' class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                    </td>
                </tr>
                <div class="modal fade" id="editModal{{$library->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{route('admin.library.update',$library)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('admin.Edit Notifications')</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="mb-1" for="notification">@lang('Admin.Message') </label>
                                        <textarea rows="5" id="mytextarea" class="form-control" name="content">{{$library->content}}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.Cancel')</button>
                                    <button type="submit" class="btn btn-danger">@lang('admin.Save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal{{$library->id}}" data-bs-toggle='modal' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{route('admin.library.destroy',$library)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('admin.Delete Notifications')</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @lang('admin.Are you sure you want to delete this file?')
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.Cancel')</button>
                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-success">@lang('admin.Delete')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
        {{$libraries->links()}}
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.library.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('admin.Add Notifications')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mb-1" for="notification">@lang('admin.Massage') </label>
                        <textarea rows="5" id="mytextarea" class="form-control" name="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.Cancel')</button>
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">@lang('admin.Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.tiny.cloud/1/db81owptdi5rbi87me89pft5rtmwyotdz0nxjbx50g41hwdh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: "#mytextarea",
        plugins: "emoticons",
        toolbar: "emoticons",
        toolbar_location: "bottom",
        menubar: false
    });
</script>
@endpush
