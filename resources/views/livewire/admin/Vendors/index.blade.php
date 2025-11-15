    <div class="main-side">
        <x-admin-alert />

        <div class="d-flex align-items-center flex-column flex-xl-row justify-content-between gap-3 mb-3">
            <div class="main-title mb-0 me-auto me-xl-0">
                <div class="small">{{__('admin.Home')}}</div>
                <div class="large">مزودي الخدمات</div>
            </div>

            <div class="filter-options d-flex flex-wrap align-items-center gap-1">
                <div class="inp-holder">
                    <select wire:model.live="filter_city" class="form-select">
                        <option value="">@lang("Select city")</option>
                        @foreach($cities as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" wire:model.live="search" id="" placeholder="بحث" />
            </div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
            <a class="main-btn" href="{{ route('admin.vendors.create') }}">@lang("Add") <i class="fas fa-plus"></i></a>
            <button class="main-btn btn-main-color" wire:click='$set("filter_active","")'>كل المزودين:
                {{\App\Models\User::vendors()->count()}}</button>
            <button class="main-btn" wire:click="$set('filter_active','active')">المزودين المفعلين:
                {{\App\Models\User::vendors()->Active()->count()}}</button>
            <button class="main-btn bg-danger" wire:click="$set('filter_active','inactive')">المزودين الغير مفعلين:
                {{\App\Models\User::vendors()->InActive()->count()}}</button>
        </div>
        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang("Photo") </th>
                        <th>@lang("Name") </th>
                        <th>@lang("Phone") </th>
                        <th>البريد الالكتروني</th>
                        <th>المدينة</th>
                        <th>الحي</th>
                        <th>المنتجات</th>
                        {{-- <th>السائقين</th> --}}
                        <th>الطلبات</th>
                        <th>@lang("Status")</th>
                        <th>@lang("Actions")</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @if(!$user->image)
                            <img src="{{ asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="50">
                            @else
                            <img src="{{ display_file($user->image) }}" alt="" class="img-thumbnail img-preview" width="50">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->city?->name ?? '--' }}</td>
                        <td>{{ $user->neighborhood?->name ?? '--' }}</td>
                        <td>
                            {{-- <a href="{{ route('admin.products',['user_id' => $user->id]) }}">
                            <div class="main-btn btn-orange ">
                                {{ $user->products->count() }}
                            </div>
                            </a> --}}
                            <a href="">
                                <div class="main-btn btn-orange ">
                                    0
                                </div>
                            </a>
                        </td>
                        {{-- <td>
                            <a href="{{ route('admin.drivers',['vendor_id' => $user->id]) }}">
                        <div class="main-btn btn-orange ">
                            {{ $user->vendorDrivers->count() }}
                        </div>
                        </a>
                        </td> --}}
                        <td>
                            {{-- <a href="{{ route('admin.orders',['vendor_id' => $user->id]) }}">
                            <div class="main-btn btn-orange ">
                                {{ $user->vendorOrders->count() }}
                            </div>
                            </a> --}}
                            <a href="">
                                <div class="main-btn btn-orange ">
                                    0
                                </div>
                            </a>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="" wire:click='toggle({{ $user->id }})' @checked($user->active)>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-3 ">
                                <a title="عرض" href="{{route('admin.vendors.show',$user->id)}}"><i></i>
                                    <i class="fa fa-eye text-primary icon-table"></i>
                                </a>
                                <a title="تعديل" href="{{ route('admin.vendors.edit',$user->id) }}"><i></i>
                                    <i class="fa fa-edit text-info icon-table"></i>
                                </a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-trash text-danger icon-table"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
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
                                    <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $user->id }})'>حذف</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
