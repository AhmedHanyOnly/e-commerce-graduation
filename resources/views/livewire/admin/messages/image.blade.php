<div class="main-side">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="main-title">
            <div class="small">
                @lang("Home")
            </div>
            <div class="large">
            صور
            </div>
        </div>
    </div>
    <x-admin-alert></x-admin-alert>

    @if($screen=='index')
    <div class="table-responsive">
        <div class="btn-holder">
            <button wire:click='$set("screen","create")' class="main-btn">@lang("Add") <i class="fas fa-plus"></i></button>
        </div>
        <table class="main-table">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>@lang("Content")</th>
                    <th>المرفق</th>
                    <th>@lang("Actions")</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $msg)
                <tr>
                    <td>
                        {{ $loop->index +1 }}
                    </td>
                    <td>
                        {{ $msg->content }}
                    </td>
                    <td>
                        <a target="_blank" href="{{ display_file($msg->file) }}" class="btn-light-purple"><i class="fas fa-eye"></i> معاينة المرفق </a>
                    </td>
                    <td>
                        <div class="btn-holder d-flex align-items-center gap-3">
                            <a href="#showModal{{ $msg->id }}" data-bs-toggle="modal">
                                <i class="fas fa-eye icon-table"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="showModal{{ $msg->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="showModalLabel">معاينة رسالة</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th>@lang("Content")</th>
                                                            <td>{{ $msg->content }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>المرفق</th>
                                                            <td>
                                                                <img src="{{ display_file($msg->file) }}" width="250" alt="">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button wire:click='edit({{ $msg->id }})'>
                                <i class="fas fa-pen text-info icon-table"></i>
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$msg->id}}">
                                <i class="fas fa-trash text-danger icon-table"></i>
                            </button>

                            <div class="modal fade" id="exampleModal{{$msg->id}}" aria-hidden="true">
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
                                            <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $msg->id }})'>حذف</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">لا يوجد رسائل</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    @else
    @include('livewire.admin.messages.create')
    @endif
</div>
