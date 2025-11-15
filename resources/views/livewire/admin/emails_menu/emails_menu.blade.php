{{-- <div> --}}
<div class="main-side">
    <div class="main-title">
        <div class="small">@lang("Home")</div>
        <div class="large">القوائم البريدية</div>
    </div>

    {{-- <div class="container"> --}}
    <div class="row g-4">

        <div class="col-md-12">
            <form action="" class="issue-main-info">
                <div class="content-header">
                    عرض كل القوائم البريدية
                </div>
                <div class="bar-obtions d-flex align-items-center justify-content-end flex-wrap gap-3 mb-4">
                    <div class="box-search">
                        <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                        <input type="search" wire:model.debounce="search" id="" placeholder="بحث" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-nowrap">البريد الالكتروني</th>
                                <th class="text-nowrap">رسالة الادمن</th>
                                <th class="text-nowrap">أنشئت في </th>
                                <th>@lang("Actions")</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emails as $email)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td class="text-nowrap">{{ $email->email }}</td>
                                <td class="text-nowrap">{{ $email->message ? $email->message : 'لا يوجد رساله' }}</td>
                                <td class="text-nowrap">{{ $email->created_at->diffForHumans() }}</td>
                                @if(!$email->message)
                                <td>
                                    <div class="btn-holder d-flex align-items-center gap-3">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $email }})">
                                            ارسال لهذا الايميل
                                        </button>

                                    </div>
                                </td>
                                @else
                                <td>
                                    <div class="btn-holder d-flex align-items-center gap-3">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $email }})">
                                            تعديل الرساله
                                        </button>

                                    </div>
                                </td>
                                @endif
                            </tr>
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
                    {{ $emails->links() }}
                </div>
            </form>
            @include('livewire.admin.emails_menu.create-pop')
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
            // editor.model.document.on('change:data', () => {
            //     console.log(editor.getData());
            //     @this.set('content', editor.getData());
            // });
            let save = document.querySelector('#save');
            save.addEventListener('click', function(event) {
                @this.set('message', editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush