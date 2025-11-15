<div class="row g-4">
    <div class="col-md-4">
        <div class="issue-main-info">
            <div class="content-header">
                اضف مقاسات اضافية
            </div>
            <x-admin-alert></x-admin-alert>
            <div class="col-md-12">
                <label class="small-label" for="">
                    المقاس
                    <span class="text-danger">*</span>
                </label>
                <div class="box-input">
                    <select wire:model="variant_size_id" class="form-select " style="width: 100% !important;">
                        <option>--اختر--</option>
                        @foreach(\App\Models\Size::active()->get() as $size)
                            <option value="{{$size->id}}">{{$size->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <label class="small-label" for="">
                    الالوان المتاحه للمقاس
                    <span class="text-danger">*</span>
                </label>
                <div class="box-input">
                    <select wire:model="variant_colors" multiple class="select2" id="variant_colors"
                            style="width: 100% !important;">
                        @foreach(\App\Models\Color::get() as $color)
                            <option value="{{$color->id}}">{{$color->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <label class="small-label" for="">
                    الحجم
                    {{--                        <span class="text-danger">*</span>--}}
                </label>
                <div class="box-input">
                    <input type="number" min="0" wire:model="variant_weight" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <label class="small-label" for="">
                    سعر الشراء
                    <span class="text-danger">*</span>
                </label>
                <div class="box-input">
                    <input type="number" min="0" wire:model="variant_purchase_price" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <label class="small-label" for="">
                    سعر البيع
                    <span class="text-danger">*</span>
                </label>
                <div class="box-input">
                    <input type="number" min="0" wire:model="variant_sell_price" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <label class="small-label" for="">
                    نسبة الخصم
                </label>
                <div class="box-input">
                    <input type="number" min="0" wire:model.live="variant_discount_percentage" class="form-control">
                </div>
            </div>



            <div class="d-flex justify-content-center mt-4">
                <button type="button" wire:click='addVariant' class="btn btn-sm btn-primary"> اضافة</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <form action="" class="issue-main-info">
            <div class="content-header">
                عرض كل المقاسات
            </div>
            <div class="table-responsive">
                <table class="main-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم المقاس</th>
                        <th>الحجم</th>
                        <th>سعر الشراء</th>
                        <th>سعر البيع</th>
                        <th>نسبة الخصم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($variants as $key => $value)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{\App\Models\Size::find($value['size_id'])?->name}}</td>
                            <td>{{$value['weight']}} kg</td>
                            <td>{{$value['purchase_price']}} SAR</td>
                            <td>{{$value['sell_price']}} SAR</td>
                            <td>{{$value['discount_percentage']}} %</td>
                            <td class="">
                                <div class="d-flex align-items-center gap-3">
                                    <a wire:click="editVariant({{$key}})" class="">
                                        <i class="fa-solid fa-pen text-info icon-table"></i>
                                    </a>
                                    <button type="button" wire:click="removeVariant({{$key}})">
                                        <i class="fa-solid fa-trash text-danger icon-table"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
