{{-- <div> --}}
<div class="main-side">
    <div class="main-title">
        <div class="small">@lang("Home")</div>
        <div class="large">المجموعات</div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="issue-main-info">
                <div class="content-header">
                    اضف مجموعة جديدة
                </div>
                <x-admin-alert></x-admin-alert>
                <div class="col-md-12">
                    <label class="small-label" for="">
                        اسم المجموعة
                        <span class="text-danger">*</span>
                    </label>
                    <div class="box-input">
                        <input type="text" class="form-control" wire:model.defer='name' id="" />
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="button" wire:click='submit' class="main-btn"> @lang("Save") </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            {{-- <form action="" class="issue-main-info"> --}}
            <div class="content-header">
                عرض كل المجموعات
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
                            <th>إسم المجموعة</th>
                            <th>عدد العملاء</th>
                            <th>عدد الرسائل المرسلة</th>
                            <th>@lang("Actions")</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programs as $program)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $program->name }}</td>
                            <td><a href="{{ route('admin.clients',['program_id'=>$program->id]) }}">{{ $program->clients_count }} <i class="fa fa-eye"></i></a></td>
                            <td>
                                <a href="{{ route('admin.MessagesSent',['program_id'=>$program->id]) }}" wire:navigate class="btn-light-blue"><i class="fas fa-envelope-open-text"></i> الرسائل: {{ $program->messages_count }} </a>
                            </td>
                            <td>
                                <div class="btn-holder d-flex align-items-center gap-3">
                                    <button type="button" wire:click='edit({{ $program->id }})'>
                                        <i class="fas fa-pen text-info icon-table"></i>
                                    </button>
                                    {{-- <button type="button" wire:click='delete({{ $program->id }})'>
                                    <i class="fas fa-trash text-danger icon-table"></i>
                                    </button> --}}
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete-program-{{ $program->id }}">
                                        <i class="fas fa-trash text-danger icon-table"></i>
                                    </button>
                                    <div class="modal fade" id="delete-program-{{ $program->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    هل انت متأكد من الحذف؟
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                                                    <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $program->id }})'>حذف</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
                {{ $programs->links() }}
            </div>
            {{-- </form> --}}
        </div>
    </div>
</div>