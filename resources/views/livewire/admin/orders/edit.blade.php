<div class="main-side">
    <x-admin-alert />
    <div class="main-title">
        <div class="small">
            {{-- @lang("Home") --}}
        </div>
        <div class="large">
            تعديل @lang('admin.Orders')
        </div>
    </div>
    <style>
        .product-list {
            max-height: 300px;
            overflow-y: auto;
            display: flex;
            flex-wrap: wrap;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            width: 200px;
        }

        .product-image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            margin-right: 10px;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-title {
            font-size: 12px;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 10px;
            margin: 0;
        }

        .order-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .order-list h5 {
            margin-top: 0;
        }

        .order-list ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .order-list li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

    </style>
    <div class="row">

        <div class="col-lg-3">
            <label class="form-label">العميل</label>
            <input type="text" class="form-control" disabled value="{{ $order->client?->name }}">

        </div>
        <div class="col-lg-3">
            <label class="form-label">رقم الجوال</label>
            <input type="text" class="form-control" disabled value="{{ $order->client?->phone }}">

        </div>

        <div class="col-lg-3">
            <label class="form-label">المدينه</label>
            <select wire:model.live="city_id" id="city_id" class="form-select select2  ">
                <option>-- اختر --</option>
                @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-3">
            <label class="form-label">الحي</label>
            <div>
                <select wire:model.live="neighborhood_id" id="neighborhood_id" class="form-select select2 ">
                    <option>-- اختر --</option>
                    @foreach ($neighborhoods as $neighborhood)
                    <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- <div class="col-lg-3">
            <label class="form-label">وقت التسليم</label>
            <input type="datetime-local" class="form-control" wire:model="delivery_time">
        </div>--}}

        <div class="col-lg-3">
            <label class="form-label">الحاله</label>
            <select wire:model.live="status" class="form-select">
                <option>-- اختر --</option>
                <option value="pending">بالانتظار</option>
                <option value="accepted">مقبول</option>
                <option value="refused">مرفوض</option>
                <option value="done">تم التوصيل</option>
            </select>
        </div>
        @if ($refused_reason || $status == 'refused')
        <div class="col-lg-3">
            <label class="form-label">سبب الرفض</label>
            <textarea class="form-control" wire:model="refused_reason" rows="2"></textarea>
        </div>
        @endif

        <div class="col-lg-3">
            <label class="form-label">العنوان</label>
            <input class="form-control" wire:model="address">
        </div>

        <div class="col-lg-3">
            <label class="form-label">سعر التوصيل</label>
            <input type="number" min="0" class="form-control" wire:model="shipping_price" disabled>
        </div>
        <div class="col-lg-3">
            <label class="form-label">الضريبة علي الدفع عند الاستلام</label>
            <input type="number" min="0" class="form-control" wire:model="cash_on_delivery_tax" disabled>
        </div>
        <div class="col-lg-3">
            <label class="form-label">الضريبة</label>
            <input type="number" min="0" class="form-control" wire:model="tax" disabled>
        </div>
        <div class="col-lg-3">
            <label class="form-label">الاجمالي</label>
            <input type="number" min="0" class="form-control" wire:model="total" disabled>
        </div>

        <div class="col-lg-3">
            <div class="inp-holder">
                <label class="special-label" for="siteStatus">حالة الدفع</label>
                <select wire:model="payment_status" id="payment_status" class="form-select">
                    <option value="">اختر</option>
                    <option value="1">مدفوع</option>
                    <option value="0">غير مدفوع</option>
                </select>
            </div>
        </div>
        <div class="col-12 mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>سعر</th>
                        <th>الكمية</th>
                        <th>الضريبة</th>
                        <th>الاجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dump($items);  --}}
                    @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $item['product']['name'] }}</td>
                        <td><input class="form-control" type="text" disabled wire:model="items.{{ $index }}.sell_price"></td>
                        <td><input class="form-control" type="text" disabled wire:model="items.{{ $index }}.qty"></td>
                        <td><input class="form-control" type="text" disabled wire:model="items.{{ $index }}.tax"></td>
                        <td><input class="form-control" type="text" disabled wire:model="items.{{ $index }}.total"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <button wire:click="save" class="btn btn-success my-2">حفظ</button>
</div>
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function select2init() {
        $(document).ready(function() {
            $('.select2').each(function() {
                $(this).select2();

                $(this).on('change', function() {
                    var data = $(this).val();
                    var name = $(this).attr('id');
                    @this.set(name, data);
                });
            })

        });
    }

    select2init();

    document.addEventListener('refreshSelect2', () => {
        select2init();
    });

</script>
@endpush
