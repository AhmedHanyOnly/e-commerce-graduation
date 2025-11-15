{{-- <div> --}}
<div class="main-side">
    <div class="main-title">
        <div class="small">@lang("Home")</div>
        <div class="large">الصفحات</div>
    </div>

    {{-- <div class="container"> --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="issue-main-info">
                <div class="content-header">
                    اضف صفحة جديدة
                </div>
                <x-admin-alert></x-admin-alert>
                <div class="col-md-12">
                    <label class="small-label" for="">
                        اسم الصفحة
                        <span class="text-danger">*</span>
                    </label>
                    <div class="box-input">
                        <input type="text" class="form-control" wire:model.defer='name' id="" />
                    </div>
                </div>
                <div class="col-md-12" wire:ignore>
                    <label class="small-label" for="">
                        @lang("Content")
                        <span class="text-danger">*</span>
                    </label>
                    <div>
                        <textarea name="content" wire:model.defer='content' class="form-control" id="body"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="button" wire:click='submit' class="main-btn"> @lang("Save") </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <form action="" class="issue-main-info">
                <div class="content-header">
                    عرض كل الصفحات
                </div>
                <div class="bar-obtions d-flex align-items-center justify-content-end flex-wrap gap-3 mb-4">
                    <div class="box-search">
                        <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                        <input type="search" wire:model.live="search" id="" placeholder="بحث" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>إسم الصفحة</th>
                                <th>أنشئت في </th>
                                <th>@lang("Actions")</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pages as $page)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{$page->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-holder d-flex align-items-center gap-3">
                                        <button type="button" wire:click='edit({{ $page->id }})'>
                                            <i class="fas fa-pen text-info icon-table"></i>
                                        </button>
                                        <button type="button" data-bs-target="#delete{{$page->id}}" data-bs-toggle="modal">
                                            <i class="fas fa-trash text-danger icon-table"></i>
                                        </button>



                                        {{-- <a type="button" href="{{route('showPage',$page->id)}}" target="_blank">
                                        <i class="fas fa-eye text-info icon-table"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="delete{{ $page->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">حذف الصفحة</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            هل أنت متأكد من حذف الصفحة
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                            <button type="button" class="btn btn-primary" wire:click.prevent="delete({{$page->id}})" data-bs-dismiss="modal">نعم</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan='4'>
                                    <div class="alert alert-warning">
                                        @lang("No results")
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $pages->links() }}
                </div>
            </form>
        </div>
    </div>
    {{-- </div> --}}
</div>
{{-- </div> --}}


@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>


<script>
    ClassicEditor
        .create(document.querySelector('#body'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                //     console.log(editor.getData());
                @this.set('content', editor.getData());
            });
            /* let save = document.querySelector('#save');
             save.addEventListener('click', function(event) {
                 @this.set('content', editor.getData());
             });*/
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush