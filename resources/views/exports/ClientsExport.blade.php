<table class="main-table">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang("Name")</th>
            <th>@lang("Phone")</th>
            <th>@lang("City")</th>
            <th>المجموعات</th>
            <th>@lang("Status")</th>
            <th>ملاحظات</th>
            <th>الموظف</th>
            <th>@lang("Actions")</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $loop->index +1 }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->city->name }}</td>
            <td>{{ $client->program->name }}</td>
            <td>{{ __($client->status) }}</td>
            <td>{{ $client->notes}}</td>
            <td>{{ $client->user->name}}</td>
            <td>
                <div class="btn-holder d-flex align-items-center gap-3">
                    <button type="button" wire:click='edit({{ $client->id }})'>
                        <i class="fas fa-pen text-info icon-table"></i>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-trash text-danger icon-table"></i>
                    </button>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="exampleModal" aria-hidden="true">
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
                <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $client->id }})'>حذف</button>
            </div>
        </div>
    </div>
</div>