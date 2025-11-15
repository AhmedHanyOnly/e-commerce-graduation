@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="main-title">
        <div class="small">
            الرئيسية
        </div>
        <div class="large">
            من نحن
        </div>
    </div>
    @if(session()->has('success'))
    <div class="alert w-100 mb-0 mt-4 alert-success alert-pop alert-dismissible fade show">
        <div class="d-flex align-items-center  gap-2 justify-content-between">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
            <li class="mb-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row g-4">

        <form action="{{ route('admin.about_update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="col-12 col-md-12 col-lg-12">
                <label class="special-label" for="title">العنوان </label>
                <input type="text" name="title" required class="ckeditor form-control" value="{{ $about->title ?? '' }}">

                <input hidden name="id" value="{{ isset($about->id) ? $about->id : '' }}">

            </div>

            {{--
                <div class="col-12 col-md-12 col-lg-12">
                    <label class="special-label" for="title_en">العنوان (بالإنجليزية)</label>
                    <input type="text" name="title_en" required class="ckeditor form-control"value="{{ $about->title_en ?? '' }}">

    </div> --}}


    <div class="col-12 col-md-12 col-lg-12">
        <label class="special-label" for="content">المحتوى </label>
        <textarea name="desc" required class="ckeditor form-control">{{ $about->desc ?? '' }}</textarea>

    </div>

    {{-- <div class="col-12 col-md-12 col-lg-12">
                    <label class="special-label" for="content_en">المحتوى (بالإنجليزية)</label>
                    <textarea name="desc_en" required class="ckeditor form-control">{{ $about->desc_en ?? '' }}</textarea>

</div> --}}

<div class="col-12 col-md-12 col-lg-12">
    <label class="special-label" for="image">الصورة</label>
    <input type="file" name="image" id="image" class="form-control">

</div>

@if (isset($about->image))
<div class="col-12 col-md-12 col-lg-12">
    <label class="special-label">الصورة الحالية</label>
    <img src="{{ asset('uploads/' . $about->image) }}" alt="الصورة الحالية" class="img-thumbnail" width="100px">
</div>
@endif

<div class="col-12 d-flex justify-content-center mt-4">
    <button type="submit" class="main-btn">
        حفظ
    </button>
</div>
</form>
</div>
</div>
@endsection

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
