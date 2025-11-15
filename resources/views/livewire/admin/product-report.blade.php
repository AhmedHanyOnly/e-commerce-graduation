<div class="main-side">
    <x-message-admin />
    <div class="main-title">
        <div class="small">
            @lang('Home')
        </div>
        <div class="large">
            تقرير المنتجات
        </div>
    </div>
    <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <div class="holder-inp-btn d-flex align-items-center gap-1">
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" wire:model.live="search" placeholder="بحث عن منتج أو عميل..." />
            </div>
        </div>
        <button class="btn btn-sm btn-warning" id='btn-prt-content'><i class="fas fa-print"></i></button>
        <button wire:click="exportExcel" class="btn btn-sm btn-success">
            <i class="fas fa-file-excel"></i> تصدير Excel
        </button>
    </div>
    <div id='prt-content'>
        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العميل</th>
                        <th>المنتج</th>
                        <th>تاريخ البيع</th>
                        <th>سعر البيع</th>
                        <th>الكميه</th>
                        <th>طريقة الدفع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->item?->client?->name }}</td>
                        <td>{{$item->product?->name}}</td>
                        <td>{{$item->created_at->format('Y-m-d')}}</td>
                        <td>{{$item->product->sell_price}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{ $item->item?->payment_method ?? '--' }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th class="p-2">الإجمالي</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $totalAmount }}</td>
                        <td>{{ $totalQty }}</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
</div>
