@extends('admin.layouts.admin')
@section('content')
<div class="main-side">
    <div class="main-title">
        <div class="small">
            @lang('admin.Home')
        </div>
        <div class="large">
            سياسة الاستبدال والاسترجاع
        </div>
    </div>
    <x-admin-alert></x-admin-alert>


    <div class="row g-4">

        <form action="{{ route('admin.usage-policy.update','test') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row row-gap-24">
                <div class="col-12 col-md-6">
                    <label for="" class="small-label">@lang('admin.Content')<span class="text-danger">*</span></label>
                    <textarea name="usage_policy" class="ckeditor form-control">{!! setting('usage_policy') !!}</textarea>
                </div>
                <div class="col-12 d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-success">
                        @lang('admin.Save')
                    </button>
                </div>
            </div>
        </form>
    </div>

    @endsection
    @push('js')
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
    <script src="{{ asset('admin-asset/js/fileinput/themes/bs5/theme.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });

    </script>
    @endpush
