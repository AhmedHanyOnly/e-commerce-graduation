{{-- <div> --}}
<div class="main-side">
    <div class="main-title">
        <div class="small">@lang("Home")</div>
        <div class="large">تواصل معنا</div>
    </div>

    {{-- <div class="container"> --}}
    <div class="row g-4">

        <div class="col-md-12">
            <form action="" class="issue-main-info">
                <div class="content-header">
                    تواصل معنا
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
                                <th>@lang("Name")</th>
                                <th>الهاتف</th>
                                <th>الايميل</th>
                                <th>الرساله</th>
                                <th>الوقت</th>
                                <th>@lang("Actions")</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactuses as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->message }}</td>
                                <td>{{ $item->created_at }}</td>

                                <td>
                                    {{-- @can('read_contact') --}}
                                    <a class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#show{{ $item->id }}">
                                        <i class="fa fa-eye"></i>
                                    </a>




                                    @include('admin.contact-us.show-modal', ['item' => $item])
                                    {{-- @endcan --}}
                                    {{-- @can('delete_contact') --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete{{$item->id}}" aria-hidden="true">
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
                                                    <a data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $item->id }})'>حذف</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $contactuses->links() }}
                </div>
            </form>
        </div>
    </div>
    {{-- </div> --}}
</div>
{{-- </div> --}}