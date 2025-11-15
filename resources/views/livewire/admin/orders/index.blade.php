<div class="main-side">
    @section('title', 'الطلبات')
    <x-message-admin />
    <div class="d-flex justify-content-between align-items-center">
        <div class="main-title">
            <div class="small">
                @lang('Home')
            </div>
            <div class="large">
                @lang('admin.Orders')
            </div>
        </div>
        <div class="d-flex gap-2 align-items-center flex-wrap justify-content-end ">
            @if ($orders->count())
                <button class="btn btn-sm text-light bg-secondary" wire:click="export">
                    <i class="fa-solid fa-file-export"></i>
                </button>
            @endif
            <button class="btn btn-sm btn-warning text-light " id='btn-prt-content'>
                <i class="fa-solid fa-print"></i>
            </button>

            <a href="{{ route('admin.carts') }}" class="btn btn-sm btn-primary text-light " id='btn-prt-content'>
                الطلبات المعلقة <i class="fa fa-arrow-left"></i>
            </a>

        </div>
    </div>
    <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">

        <div class="filter-options d-flex flex-wrap align-items-center gap-1">


            <div class="inp-holder">
                <!--  -->
            </div>


        </div>
        <div class="holder-inp-btn d-flex align-items-center gap-1">
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input wire:model.live="search" type="search" id=""
                    placeholder="بحث برقم الطلب او رقم هاتف العميل" />
            </div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1 mb-2">
            <div class="btn-holder">
                <a href="{{ route('admin.orders.create') }}" class="main-btn">@lang('Add') <i
                        class="fas fa-plus"></i></a>
            </div>
            <button class="main-btn btn-main-color" wire:click='$set("filter_status","")'>الكل:
                {{ \App\Models\Order::count() }}</button>

            <button class="main-btn bg-warning" wire:click='$set("filter_status","pending")'>بالانتظار:
                {{ \App\Models\Order::pending()->count() }}</button>
            <button class="main-btn" wire:click="$set('filter_status','accepted')">مقبول:
                {{ \App\Models\Order::accepted()->count() }}</button>

            {{-- <button class="main-btn " style="background-color: #19b9b4;"
                wire:click="$set('filter_status','waiting_for_drivers')">
                بانتظار السائقين:
                {{ \App\Models\Order::waitingForDriver()->count() }}
            </button>
            <button class="main-btn bg-success" wire:click="$set('filter_status','in_progress')">
                قيد التوصيل:
                {{ \App\Models\Order::InProgress()->count() }}
            </button> --}}
            <button class="main-btn btn-main-color" wire:click="$set('filter_status','done')">
                تم التوصيل:
                {{ \App\Models\Order::done()->count() }}
            </button>
            <button class="main-btn bg-danger" wire:click="$set('filter_status','refused')">
                مرفوض:
                {{ \App\Models\Order::refused()->count() }}
            </button>
        </div>

    </div>
    <div id='prt-content'>
        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العميل</th>
                        {{-- <th>السائق</th> --}}
                        <th>المدينه</th>
                        <th class="not-print">المنتجات</th>
                        <th>طريقة الدفع</th>
                        <th class="text-center">الحاله</th>
                        <th>سعر التوصيل</th>
                        <th>ضريبة التوصيل</th>
                        <th>الاجمالى</th>
                        <th>الضريبه</th>
                        <th>الاجمالى شامل الضريبة</th>
                        <th>تاريخ الطلب</th>
                        <th class="not-print">العمليات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->number }}
                                <br>
                                @if ($order->items()->where('is_pre_order', 1)->exists())
                                    <span class="badge bg-primary">PREORDER </span>
                                @endif
                            </td>
                            <td>{{ $order->client?->name }}</td>
                            {{-- <td>{{ $order->driver?->name ?? 'لايوجد' }}</td> --}}
                            <td>{{ $order->city?->name }}</td>
                            <td class="not-print">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#productsModal{{ $order->id }}">
                                    <i class="fa fa-box-open"></i>
                                </button>
                            </td>
                            <td>
                                @if ($order->payment_method == 'bank')
                                    <button data-bs-toggle="modal" data-bs-target="#bank_data{{ $order->id }}"
                                        class="d-flex align-items-center gap-1 text-primary bg-transparent">
                                        {{ __($order->payment_method) }}
                                        <i class="fa fa-eye"></i>
                                    </button>
                                @else
                                    {{ __($order->payment_method) }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="status-order
                                    @if ($order->status === 'accepted') accepted
                                    @elseif($order->status === 'done')
                                        done
                                    @elseif($order->status === 'pending')
                                        pending
                                    @else
                                        rejected @endif">
                                        {{ __($order->status) }}
                                    </span>

                                    @if ($order->status === 'refused')
                                        <button type="button" class="btn btn-danger rounded-circle"
                                            style='font-size:7px;padding:2px 6px' data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="{{ $order->refused_reason }}">
                                            <i class="fa-solid fa-exclamation"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $order->shipping_price }} {{ setting('currency') }}</td>
                            <td>{{ $order->shipping_tax }} {{ setting('currency') }}</td>
                            <td>{{ $order->subtotal }} {{ setting('currency') }}</td>
                            <td>{{ $order->tax }} {{ setting('currency') }}</td>
                            <td>{{ $order->total }} {{ setting('currency') }}</td>
                            <td>{{ format_date_time($order->created_at) }}</td>

                            <td class="not-print">
                                <div class="d-flex align-items-center gap-3">
                                    @if ($order->status == 'pending')
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#accept{{ $order->id }}">قبول الطلب
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#refuse{{ $order->id }}">رفض الطلب
                                            </button>
                                        </div>
                                    @endif
                                    @include('livewire.admin.orders.modals.accept')
                                    @include('livewire.admin.orders.modals.refuse')
                                    @include('livewire.admin.orders.modals.bank_data')
                                    <!-- Modal لمعاينة المنتجات -->
                                    <div class="modal fade" id="productsModal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="productsModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="productsModalLabel{{ $order->id }}">
                                                        المنتجات في الطلب رقم {{ $order->number }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="إغلاق"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($order->items->count())
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>المنتج</th>
                                                                    <th>القسم</th>
                                                                    <th>الكمية</th>
                                                                    <th>السعر</th>
                                                                    <th>الإجمالي</th>
                                                                    <th>طلب مسبق</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order->items as $item)
                                                                    <tr>
                                                                        <td>{{ $item->product?->name ?? '—' }}</td>
                                                                        <td>{{ $item->product?->category?->name ?? '—' }}
                                                                        </td>
                                                                        <td>{{ $item->quantity ?? 1 }}</td>
                                                                        <td>{{ $item->product->sell_price ?? 0 }}
                                                                            {{ setting('currency') }}
                                                                        </td>
                                                                        <td>{{ $item->product->sell_price * ($item->quantity == 0 ? 1 : $item->quantity) }}
                                                                            {{ setting('currency') }}
                                                                        </td>
                                                                        <td>{{ $item->is_pre_order ? 'نعم' : 'لا' }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p class="text-danger">لا توجد منتجات لهذا الطلب</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    @can('update_orders')
                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="">
                                            <i class="fa-solid fa-pen text-info icon-table"></i>
                                        </a>
                                    @endcan
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    @can('delete_orders')
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $order->id }}">
                                            <i class="fa-solid fa-trash text-danger icon-table"></i>
                                        </button>
                                        @include('deleteModal', ['item' => $order])
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="not-print">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
