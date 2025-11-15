@extends('admin.layouts.admin')
@section('css')

@section('title')
تعديل الأسئلةالشائعة
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-left ">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> تعديل الأسئلةالشائعة  </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="main-side">
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('message') }}
    </div>
    @endif


    <form action="{{ route('admin.faqs.update',$faqs->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">



            <div class="col-sm-12 col-md-12 col-lg-12">
                <label for="" class="small-label"> @lang('admin.Question') <span class="text-danger">*</span></label>
                <input type="text" name="question" class="form-control" value="{{ isset($faqs->question) ? $faqs->question : '' }}">
            </div>

            {{-- <div class="col-sm-12 col-md-12 col-lg-12">
                <label for="" class="small-label">Question_en <span class="text-danger">*</span></label>
                <input type="text" name="question_en" class="form-control" value="{{ isset($faqs->question_en) ? $faqs->question_en : '' }}">
            </div> --}}


            <div class="col-sm-12 col-md-12 col-lg-12">
                <label for="" class="small-label">   @lang('admin.Answer') <span class="text-danger">*</span></label>
                <textarea name="answer" class="ckeditor form-control">{{ isset($faqs->answer) ? $faqs->answer : '' }}</textarea>
            </div>
            {{-- <div class="col-sm-12 col-md-12 col-lg-12">
                <label for="" class="small-label"> Answer_En <span class="text-danger">*</span></label>
                <textarea name="answer_en" class="ckeditor form-control">{{ isset($faqs->answer_en) ? $faqs->answer_en : '' }}</textarea>
            </div> --}}

            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success">
                      @lang('admin.Edit')
                </button>
            </div>

        </div>
    </form>
</div>
@push('js')
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>
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
