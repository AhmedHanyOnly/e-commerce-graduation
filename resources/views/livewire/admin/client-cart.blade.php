<div class="main-side">
    @section('title', 'الطلبات المعلقة في السلة')
    <x-message-admin />
    <div class="main-title">
        <div class="small">
            @lang('Home')
        </div>
        <div class="large">
            الطلبات المعلقة في السلة
        </div>
    </div>
    <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">

        <div class="filter-options d-flex flex-wrap align-items-center gap-1">

            <div class="inp-holder">
                <button class="main-btn btn-main-color" wire:click='$set("filter","")'>
                    الكل: {{ \App\Models\Cart::whereHas('items')->count() }}</button>
            </div>

            <div class="inp-holder">
                <button class="btn btn-warning" wire:click='$set("filter","guest")'>
                    زائر: {{ \App\Models\Cart::whereHas('items')->whereNull('user_id')->count() }}</button>
            </div>
            <div class="inp-holder">
                <button class="main-btn btn-success" wire:click='$set("filter","client")'>
                    مستخدم: {{ \App\Models\Cart::whereHas('items')->whereNotNull('user_id')->count() }}</button>
            </div>


        </div>
        <div class="holder-inp-btn d-flex align-items-center gap-1">
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input wire:model.live="search" type="search" id="" placeholder="بحث برقم الطلب " />
            </div>
        </div>

    </div>
    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>ip</th>
                    <th>المستخدم</th>
                    <th>عدد المنتجات</th>
                    <th>الاجمالي</th>
                    <th>تاريخ الانشاء</th> 
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->id }}</td>
                        <td>{{ $cart->ip }}</td>
                        <td>{{ $cart->client?->name ?? 'زائر' }}</td>
                        <td>{{ $cart->items_count }}</td>
                        <td>{{ number_format($cart->items->sum('total'), 2) }}</td>
                        <td>{{ $cart->created_at->format('Y-m-d H:i') }}</td> {{-- ✅ التاريخ بصيغة جميلة --}}
                        <td class="">
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('admin.carts.show', $cart->id) }}" class="">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $carts->links() }}
    </div>
</div>
