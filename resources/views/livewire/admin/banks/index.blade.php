<div class="main-side">

    <x-message-admin />
    @if($screen == 'index')
   <div class="main-title">
    <div class="small">
        @lang("admin.Home")
    </div>
    <div class="large">
        @lang("admin.BankAccounts")
    </div>
</div>

<div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
    <div class="btn-holder">
        <button wire:click="$set('screen','create')" class="main-btn">
            @lang("admin.Add") <i class="fas fa-plus"></i>
        </button>
    </div>

    <div class="holder-inp-btn d-flex align-items-center gap-1">
        <div class="box-search">
            <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
            <input type="search" id="" placeholder="@lang('admin.Search')" />
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="main-table mb-2">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('admin.Image')</th>
                <th>@lang('admin.BankName')</th>
                <th>@lang('admin.OwnerName')</th>
                <th>@lang('admin.AccountNumber')</th>
                <th>@lang('admin.IBAN')</th>
                <th>@lang('admin.Status')</th>
                <th>@lang('admin.Actions')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banks as $bank)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    @if(!$bank->image)
                        <img src="{{ asset('admin-asset/img/no-image.jpeg') }}" alt="" width="50" class="rounded">
                    @else
                        <img src="{{display_file($bank->image)}}" width="50" class="rounded">
                    @endif
                </td>
                <td>{{$bank->bank_name}}</td>
                <td>{{$bank->owner_name}}</td>
                <td>{{$bank->number}}</td>
                <td>{{$bank->iban}}</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:click="toggle({{$bank}})" @checked($bank->active) type="checkbox" role="switch">
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <button wire:click="edit({{$bank->id}})">
                            <i class="fa-solid fa-pen text-info icon-table"></i>
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$bank->id}}">
                            <i class="fa-solid fa-trash text-danger icon-table"></i>
                        </button>
                        @include('deleteModal',['item' => $bank])
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$banks->links()}}
</div>

    @else
    @include('livewire.admin.banks.createOrUpdate')
    @endif
</div>
