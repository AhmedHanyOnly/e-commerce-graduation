<div class="col-md-12">
    <x-admin-alert></x-admin-alert>
</div>

<div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
        <label class="special-input">
            <span>@lang("Address")</span>
            <input type="text" name="title" value="{{ old('title',$articles?->title) }}" class="form-control">
        </label>
    </div>
</div>
<div class="col-12 col-md-4 col-lg-3">
        <label class="special-input">
        <span>@lang("Main image")</span>
        <input type="file" name="image" multiple class="form-control mb-3">
    </label>
    @if($articles)
                <img src="{{ $articles?->image ? display_file($articles?->image) : asset('admin-asset/img/no-img.jpg') }}" alt="" class="img-thumbnail img-preview" width="50">
    @endif

</div>
<div class="col-12 col-md-4 col-lg-3">
    <label class="special-input">
        <span>@lang("Sub image")</span>
        <input class="form-control" type="file" accept="image/*">
    </label>
</div>

<div class="col-12 col-md-4 col-lg-3">
    <div class="inp-holder">
        <label class="special-label" for="">@lang("Status")</label>
        <select name="active" id="" class="form-select">
            <option value="">@lang("Choose status")</option>
            @if($articles)
            <option value="1" {{$articles->active == "1" ? 'selected': ''}}>@lang("Active")</option>
            <option value="0" {{$articles->active == "0" ? 'selected': ''}}>غير مفعل</option>
            @else
            <option value="1">@lang("Active")</option>
            <option value="0">غير مفعل</option>
            @endif
        </select>
    </div>
</div>


<div class="col-12 m-0">
    <hr class="m-0 border-0">
</div>
<div class="col-12">
        <div class="inp-holder">
        <label class="special-label">
            @lang("Content")
        </label>
        <textarea name="content" id="content" class=" form-control" rows="4">{!!   old('content',$articles?->content) !!}</textarea>
    </div>
</div>
<div class="col-12 m-0">
    <hr class="m-0 border-0">
</div>

{{-- <div class="col-12 col-md-4 col-lg-3">
    <div class="inp-holder">
        <label class="special-label" for="">@lang("Category")</label>
        <select name="article_category_id" id="" class="form-select">
            <option value="">اختر القسم</option>
            @foreach (App\Models\ArticleCategories::latest()->get() as $cat)

            <option {{ $cat->id == $articles?->article_category_id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
</div> --}}
<div class="col-12 col-md-12 col-lg-12 col-xl-12">
    <div class="btn-holder mt-2">
        <button type="submit" class="main-btn">@lang("Save")</button>
    </div>
</div>
@push('js')
<script src="{{asset('ckeditor-articles/build/ckeditor.js')}}"></script>
<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#content'),{
            ckfinder:{
                uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
            }
        })
        .catch(error => {
            console.log(error);
        });

</script>

@endpush
