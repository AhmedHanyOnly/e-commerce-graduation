<div class="main-side">

    <x-admin-alert></x-admin-alert>
    <div class="d-flex align-items-center flex-column flex-xl-row justify-content-between gap-3 mb-3">
        <div class="main-title mb-0 me-auto me-xl-0">
            <div class="small">{{__('admin.Home')}}</div>
            <div class="large">@lang("Clients")</div>
        </div>

        <div class="filter-options d-flex flex-wrap align-items-center gap-1">
            <div class="inp-holder">
                <select wire:model.live="filter_city" class="form-select">
                    <option value="">@lang("Select city")</option>
                    @if($select_citites)
                    @foreach($select_citites as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                    @endif

                </select>
            </div>
            {{-- <div class="inp-holder">
                <select wire:model.live="filter_garden_type" class="form-select">
                    <option value="">@lang("Select Garden Type")</option>
                    @foreach($select_garden_types as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
            </select>
        </div> --}}
    </div>

    <div class="box-search">
        <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
        <input type="search" wire:model.live="search" id="" placeholder="بحث" />
    </div>
</div>
<div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
    @can('create_clients')
    <a href="{{ route('admin.clients.create') }}" class="main-btn">@lang("Add") <i class="fas fa-plus"></i></a>
@endcan
    <button class="main-btn btn-main-color" wire:click='$set("filter_active","")'>@lang("All clients"):
        {{\App\Models\User::Clients()->count()}}</button>
    <button class="main-btn" wire:click="$set('filter_active','active')">@lang("Activated clients"):
        {{\App\Models\User::Clients()->Active()->count()}}</button>
    <button class="main-btn bg-danger" wire:click="$set('filter_active','inactive')">@lang("Unactivated clients"):
        {{\App\Models\User::Clients()->InActive()->count()}}</button>
</div>

<div class="table-responsive">
    <table class="main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang("Photo")</th>
                <th>@lang("Name")</th>
                <th>@lang("Phone")</th>
                <th> @lang('Email')</th>
                <th>@lang("City")</th>
                <th>@lang('Orders')</th>
                <th>@lang("Status")</th>
                <th class="text-center">@lang("Actions")</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clients as $client)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>
                    @if(!$client->image)
                    <img src="{{ asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="50">
                    @else
                    <img src="{{ display_file($client->image) }}" alt="" class="img-thumbnail img-preview" width="50">
                    @endif
                </td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>

                {{-- <td>
                        @foreach ($client->gardens as $garden)
                        <span class="badge bg-dark">{{ $garden->name }}</span>
                @endforeach
                </td> --}}
                <td>{{ $client->city?->name }}</td>
                <td>
                    <a href="{{ route('admin.orders',['client_id' => $client->id]) }}">
                        <div class="main-btn btn-orange ">
                            {{ $client->clientOrders->count() }}
                        </div>
                    </a>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:click="toggle({{$client->id}})" @checked($client->active) type="checkbox" role="switch" id="">
                    </div>
                </td>
                <td>
                    <div class="btn-holder  justify-content-center  d-flex align-items-center gap-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#sendToWhatsapp" wire:click="clientId({{ $client->id }})">
                            <img src="{{ asset('admin-asset/img/icons/whatsapp.png') }}" alt="whatsapp icon" width="20">
                        </button>
                        <button class="" wire:click="clientId({{ $client->id }})" data-bs-target="#send_notification{{$client->id}}" data-bs-toggle="modal">
                            <i class="fa fa-bell"></i>
                        </button>

                        <a href="{{route('admin.clients.show',$client->id)}}">
                            <i class="fas fa-eye text-primary icon-table"></i>
                        </a>
                        @can('update_clients')

                        <a type="button" href="{{ route('admin.clients.edit',$client->id) }}">
                            <i class="fas fa-pen text-info icon-table"></i>
                        </a>
                        @endcan
                        @can('delete_clients')

                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$client->id}}">
                            <i class="fas fa-trash text-danger icon-table"></i>
                        </button>
                        @endcan
                        <div class="modal fade" id="exampleModal{{$client->id}}" aria-hidden="true">
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

                        <div class="modal fade" id="send_notification{{$client->id}}" aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="showModalLabel">ارسال اشعار
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <select wire:model="library_id" class="form-select" id="">
                                            <option>---- {{__('admin.Choose')}} ----</option>
                                            @foreach(\App\Models\NotificationLibrary::all() as $library)
                                            <option value="{{$library->id}}">{!!  $library->content!!}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="modal-footer">
                                        <button wire:click="send_notification" type="button" class="btn btn-success btn-sm px-3" data-bs-dismiss="modal">إرسال</button>
                                        <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='12' class="text-center">
                    <div class="alert alert-warning mb-0">
                        @lang("No results")
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $clients->links() }}
    <!-- Modal -->
    <div class="modal fade" id="sendToWhatsapp" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showModalLabel">إرسال رسالة عبر الواتس اب
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea wire:model="message" rows="5" class="form-control"></textarea>

                    <div class="form-group">
                        <label for="">@lang("Photo")</label>
                        <input type="file" wire:model="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="sendToWhatsapp" type="button" class="btn btn-success btn-sm px-3" data-bs-dismiss="modal">إرسال</button>
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
