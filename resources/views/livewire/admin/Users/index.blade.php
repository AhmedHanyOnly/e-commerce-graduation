<div class="main-side">
    <div class="main-title">
        <div class="small">@lang('admin.Home')</div>
        <div class="large">@lang('admin.Moderators')</div>
    </div>
    <x-admin-alert></x-admin-alert>

    @if($screen=='index')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <button class="main-btn" wire:click='$set("screen","create")'>@lang('admin.Add') <i class="fas fa-plus"></i></button>
        @can('read_users')
        <a href="{{ route('admin.roles') }}" wire:navigate class="main-btn btn-main-color">@lang('admin.Roles') <i class="fas fa-arrow-left-long"></i></a>
        @endcan
    </div>
    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>@lang('admin.Name') </th>
                    <th>@lang('admin.Email')</th>
                    <th>@lang('admin.Group')</th>
                    <th>@lang('admin.Control')</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role?->name }}</td>
                    <td>
                        <div class="d-flex gap-3">
                            <button title="@lang('admin.Edit')" type="button" wire:click="edit({{ $user->id }})"><i></i>
                                <i class="fa fa-edit text-info icon-table"></i>
                            </button>
                            @if ($user->id != 1)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-trash text-danger icon-table"></i>
                            </button>

                            @endif
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
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.Delete') </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @lang('admin.Are you sure you want to delete?')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">@lang('Cancel')</button>
                        <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $user->id }})'>@lang('admin.Delete')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    @include('livewire.admin.Users.createOrUpdate')
    @endif
</div>
