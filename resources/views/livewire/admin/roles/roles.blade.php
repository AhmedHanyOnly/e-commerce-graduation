<div class="main-side">
    <div class="main-title">
        <div class="small">@lang("Home")</div>
        <div class="large">@lang('admin.Roles')</div>
    </div>

    @if ($screen =='index')
    <div class="row g-4">
        <button class="main-btn" wire:click='$set("screen","create")'>@lang("Add")</button>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover mt-5">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang("Name")</th>
                            <th scope="col">@lang("Actions")</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ __($role->name) }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" wire:click="edit({{ $role->id }})"><i
                                        class="fas fa-edit"></i></button>
                                @if(!$loop->index==0)
                                <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $role->id }})"><i></i>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $roles->links() }}
    @else
    @include('livewire.admin.roles.create')
    @endif
</div>
