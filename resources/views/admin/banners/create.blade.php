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
                البانرات
            </div>
        </div>
        @if (session()->has('success'))
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

            <form action="{{ route('admin.banner_update') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-12 col-md-12 col-lg-12">
                    <input hidden name="id" value="{{ isset($banner->id) ? $banner->id : '' }}">

                    <label class="special-label" for="image">البانر العلوي
                        <small class="text-danger">
                            1919px * 600px
                        </small>
                    </label>
                    <input type="file" name="image_one" id="image" class="form-control">

                </div>

                @if (isset($banner->image_one))
                    <div class="col-12 col-md-12 col-lg-12">
                        <label class="special-label">الصورة الحالية</label>
                        <img src="{{ asset('uploads/' . $banner->image_one) }}" alt="الصورة الحالية" class="img-thumbnail"
                            width="100px">
                    </div>
                @endif

                <div class="col-12 col-md-12 col-lg-12">
                    {{-- <input hidden name="id" value="{{ isset($banner->id) ? $banner->id : '' }}"> --}}

                    <label class="special-label" for="image">البانر السفلي
                        <small class="text-danger">
                            1919px * 600px
                        </small>
                    </label>
                    <input type="file" name="image_two" id="image" class="form-control">

                </div>

                @if (isset($banner->image_two))
                    <div class="col-12 col-md-12 col-lg-12">
                        <label class="special-label">الصورة الحالية</label>
                        <img src="{{ asset('uploads/' . $banner->image_two) }}" alt="الصورة الحالية" class="img-thumbnail"
                            width="100px">
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
