<div class="col-content col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="order-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{ __('Orders') }}
            </button>
        </li>
        {{-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="order-fix-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">طلبات الصيانة
            </button>
        </li> --}}
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="order-tab"
            tabindex="0">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-start  mb-3">
                        {{-- <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
                            <button class="btn btn-sm text-light" style='background:#2e5789'
                                    wire:click='$set("filter_status","")'>الكل:
                                {{ \App\Models\Order::mine()->count() }}</button>
                        <button class="btn btn-sm text-light" style='background:#f99132'
                            wire:click='$set("filter_status","pending")'>بانتظار الاداره:
                            {{ \App\Models\Order::mine()->pending()->count() }}
                        </button>
                        <button class="btn btn-sm text-light" style='background:#0fc859'
                            wire:click="$set('filter_status','accepted_by_admin')">تم الموافقه:
                            {{ \App\Models\Order::mine()->accepted()->count() }}

                        </button>

                        <button class="btn btn-sm text-light bg-success"
                            wire:click="$set('filter_status','in_progress')">
                            قيد التوصيل:
                            {{ \App\Models\Order::mine()->InProgress()->count() }}

                        </button>
                        <button class="btn btn-sm text-light" style='background:#2e5789'
                            wire:click="$set('filter_status','done')">
                            تم التوصيل:
                            {{ \App\Models\Order::mine()->done()->count() }}

                        </button>
                        <button class="btn btn-sm text-light bg-danger" wire:click="$set('filter_status','refused')">
                            مرفوض:
                            {{ \App\Models\Order::mine()->refused()->count() }}

                        </button>
                    </div> --}}
                    </div>
                    <div class="table-responsive">
                        {{-- <table class="main-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المزود</th>
                                <th>السائق</th>
                                <th>القسم</th>
                                <th> المدينه</th>
                                <th>الحي</th>
                                <th>الحاله</th>
                                <th>الاجمالي</th>
                                <th>الضريبه</th>
                                <th>تاريخ الطلب</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->number}}</td>
                    <td>{{$order->vendor?->name ?? '--'}}</td>
                    <td>{{$order->driver?->name ?? '--'}}</td>
                    <td>{{$order->category?->name ?? '--'}}</td>
                    <td>{{$order->city?->name ?? '--'}}</td>
                    <td>{{$order->neighborhood?->name ?? '--'}}</td>
                    <td>
                        <div class="status-order rounded text-center {{$order->status}} ">
                            {{__($order->status)}}
                        </div>
                    </td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->tax ?? 0}}</td>
                    <td>{{$order->created_at->format('Y-m-d')}}</td>
                    <td>

                        <div class="d-flex gap-1 align-items-center justify-content-center ">
                            @if ($order->status == 'done' && !$order->is_rated_by_user(auth()->id()))
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                title='تقييم الطلب' data-bs-target="#exampleModal{{$order->id}}">
                                تقييم
                            </button>
                            @endif

                            @include('client.profile.modals.rate',['order' => $order,'type' => 'order'])
                            @include('showOrder',['order' => $order])
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table> --}}
                        <table class="main-table">
                            <thead>
                                <tr>
                                    <th>{{ __('order number') }}</th>
                                    <th>{{ __('total') }}</th>
                                    <th>{{ __('order date') }}</th>
                                    <th>{{ __('order status') }}</th>
                                    <th>{{ __('payment method') }}</th>
                                    <th>{{ __('control') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->clientOrders()->orderBy('created_at', 'desc')->get() as $order)
                                    <tr>
                                        <td class="fw-bold">#{{ $order->number }}</td>
                                        <td>{{ $order->total }} {{ __('SAR') }}</td>
                                        <td>{{ $order->created_at->translatedFormat('D d M Y') }}</td>
                                        {{-- <td>
                                            <div class="status-order text-success">
                                                <i class="fa-solid fa-check"></i>
                                                {{ __($order->status) }}
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <div
                                                    class="status-order
                                            {{ $order->status === 'accepted' ? 'text-success' : ($order->status === 'done' ? 'text-primary' : ($order->status === 'refused' ? 'text-danger' : 'text-warning')) }}">
                                                    @if ($order->status === 'accepted')
                                                        <i class="fa-solid fa-check"></i>
                                                    @elseif($order->status === 'done')
                                                        <i class="fa-solid fa-check-circle"></i>
                                                    @elseif($order->status === 'refused')
                                                        <i class="fa-solid fa-x"></i>
                                                    @else
                                                        <i class="fa-solid fa-clock"></i>
                                                    @endif
                                                    {{ __($order->status) }}
                                                </div>
                                                @if ($order->refused_reason)
                                                    <button type="button" class="btn btn-danger rounded-circle"
                                                        style='font-size:7px;padding:2px 6px' data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="{{ $order->refused_reason }}">
                                                        <i class="fa-solid fa-exclamation"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            {{ __($order->payment_method) }}
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center ">
                                                <a href="{{ route('show-order', $order->id) }}"
                                                    class="main-btn text-light">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td class="fw-bold">#123456789</td>
                                    <td>49 ر.س</td>
                                    <td>الاحد 14 فبراير 2024</td>
                                    <td>
                                        <span class="status-order text-danger">
                                            <i class="fa-solid fa-x"></i>
                                            تم الرفض
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center ">
                                            <a href="{{route('show-order')}}" class="main-btn text-light">
                <i class="fa-regular fa-eye"></i>
                </a>
            </div>
            </td>
            </tr> --}}
                            </tbody>
                        </table>
                        {{-- {{$orders->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="order-fix-tab" tabindex="0">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 justify-content-start  mb-3">
                        <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
                            {{-- <a href="{{route('client.profile',['screen'=>'create-order'])}}"
                    class="btn btn-success btn-sm">اضافة</a> --}}
                            {{-- <button class="btn btn-sm text-light" style='background:#2e5789'
                                    wire:click='$set("filter_status","")'>الكل:
                                {{ \App\Models\Maintenance::mine()->count() }}</button>
                    <button class="btn btn-sm text-light" style='background:#f99132'
                        wire:click='$set("filter_status","pending")'>بانتظار الاداره:
                        {{ \App\Models\Maintenance::mine()->pending()->count() }}
                    </button>
                    <button class="btn btn-sm text-light" style='background:#0fc859'
                        wire:click="$set('filter_status','accepted_by_admin')">تم الموافقه:
                        {{ \App\Models\Maintenance::mine()->AcceptedByClient()->count() }}

                    </button> --}}

                            {{-- <button class="btn btn-sm text-light bg-success"
                                    wire:click="$set('filter_status','in_progress')">
                                قيد التوصيل:
                                {{ \App\Models\Maintenance::mine()->InProgress()->count() }}

                    </button>
                    <button class="btn btn-sm text-light" style='background:#2e5789'
                        wire:click="$set('filter_status','done')">
                        تم التوصيل:
                        {{ \App\Models\Maintenance::mine()->done()->count() }}

                    </button>
                    <button class="btn btn-sm text-light bg-danger" wire:click="$set('filter_status','refused')">
                        مرفوض:
                        {{ \App\Models\Maintenance::mine()->refused()->count() }}

                    </button> --}}
                        </div>
                    </div>
                    {{-- <div class="table-responsive">
                        <table class="main-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>القسم</th>
                                <th>المزود</th>
                                <th>المدينة</th>
                                <th>الحي</th>
                                <th> الحالة</th>
                                <th>الاجمالي</th>
                                <th>الضريبة</th>
                                <th>تاريخ الطلب</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($maintenances as $order)
                                <tr>
                                    <td>{{$order->number}}</td>
            <td>{{$order->category?->name}}</td>
            <td>{{$order->is_by_admin ? 'الادارة' : ($order->vendor ? $order->vendor->name : 'لايوجد')}}</td>
            <td>{{$order->city?->name}}</td>
            <td>{{$order->neighborhood?->name}}</td>
            <td>
                <div class="status-order rounded text-center accepted ">
                    {{get_maintenances_status($order->status)}}
                </div>
            </td>
            <td>{{$order->total ?? 'لم يحدد'}}</td>
            <td>{{$order->tax ?? 0}}</td>
            <td>{{$order->created_at->format('Y-m-d')}}</td>
            <td>
                <div class="d-flex gap-1 align-items-center justify-content-center ">
                    @if ($order->status == 'done')
                    @if (!$order->is_rated_by_user(auth()->id()))
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" title='تقييم الطلب'
                        data-bs-target="#exampleModal{{$order->id}}">
                        تقييم
                    </button>
                    @include('client.profile.modals.rate',['order' => $order,'type' => 'maintenance'])
                    @endif
                    @elseif($order->status=='wait_for_accept_offer_by_client')
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                        data-bs-target="#acceptOffer{{$order->id}}">
                        الموافقة علي السعر
                    </button>
                    @include('client.profile.modals.acceptOffer')
                    @endif
                    @include('showMaintenance',['order' => $order])

                </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            {{$maintenances->links()}}
        </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
