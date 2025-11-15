<div class="row g-4">
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('message') }}
    </div>
    @endif
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
    @php
    $about = App\Models\About::first();
    @endphp
<form action="{{ route('admin.about_update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row row-gap-24">
        <div class="col-12 col-md-12 col-lg-12">
            <label class="special-label" for="title">@lang('admin.about_title')</label>
            <input type="text" name="title" required class="form-control" value="{{ $about?->title }}">
            <input hidden name="id" value="{{ $about?->id }}">
        </div>

        <div class="col-12">
            <label for="content" class="small-label">@lang('admin.Content')<span class="text-danger">*</span></label>
            <textarea name="desc" id="content" class="form-control">{!! $about?->desc !!}</textarea>
        </div>

        <div class="col-12 col-md-12 col-lg-12">
            <label class="special-label" for="image">@lang('admin.Image')</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        @if (isset($about->image))
            <div class="col-12 col-md-12 col-lg-12">
                <label class="special-label">@lang('admin.current_image')</label>
                <img src="{{ asset('uploads/' . $about->image) }}" alt="@lang('admin.current_image')" class="img-thumbnail" width="100px">
            </div>
        @endif

        <div class="col-12 d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-success">
                @lang('admin.Save')
            </button>
        </div>
    </div>
</form>

</div>
<style>
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        height: 200px;
    }

    .ck.ck-editor__main>.ck-editor__editable {
        height: 200px;
    }

</style>

@push('js')
<script src="{{asset('ckeditor-articles/build/ckeditor.js')}}"></script>
<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: "{{route('image.upload').' ? _token = '.csrf_token()}}"
            , }
        })
        .catch(error => {
            console.log(error);
        });

</script>

@endpush
