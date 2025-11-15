<x-admin-alert></x-admin-alert>


<div class="row g-4">

    <form action="{{ route('admin.success_payment.update','test') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row row-gap-24">
            <div class="col-12 ">
                <label for="" class="small-label">@lang('admin.Content')<span class="text-danger">*</span></label>
                <textarea name="success_payment" class="ckeditor form-control">{!! setting('success_payment') !!}</textarea>
            </div>
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
        .create(document.querySelector('.ckeditor'), {
            ckfinder: {
                uploadUrl: ''
            , }
        })
        .catch(error => {
            console.log(error);
        });

</script>
@endpush
