@extends('admin.layouts.admin')

@section('content')
    <div class="main-side">
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="main-title">
            <div class="small">
                @lang('admin.Home')
            </div>
            <div class="large">
                 تعديل القيم الجوهرية
            </div>
        </div>
        <div class="row g-4">

            <form action="{{ route('admin.services.update',$services->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row row-gap-24">


                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <label for="" class="small-label">{{__('admin.Address')}}   <span class="text-danger">*</span></label>
                        <input type="text" name="title"  class="form-control" value="{{ isset($services->title) ? $services->title : '' }}">
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <label for="" class="small-label">الايكونه   <span class="text-danger">*</span></label>
                        <input type="text" name="icon"  class="form-control" value="{{ isset($services->icon) ? $services->icon : '' }}">
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <label for="" class="small-label">  {{__('admin.Content')}}  <span class="text-danger">*</span></label>
                        <textarea name="content"  class="ckeditor form-control">{{ isset($services->content) ? $services->content : '' }}</textarea>
                    </div>



                    <div class="col-12 d-flex justify-content-center mt-4">
                        <button type="submit" class="main-btn">
                            {{__('admin.Save')}}
                        </button>
                    </div>
            </form>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
            type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
            type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
        <script src="{{ asset('admin-asset/js/fileinput/themes/bs5/theme.min.js') }}"></script>
    @endpush
@endsection
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
