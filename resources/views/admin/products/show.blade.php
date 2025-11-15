@extends('admin.layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

<div class="main-side">

    <div class="card ">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-12">
                    <h5 class="mb-2 text-primary">عرض منتج</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">أسم المنتج</label>
                        <input disabled type="text" value="{{ $product->name }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">نوع المنتج</label>
                        <input disabled type="text" value="{{ $product->type?->name }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">قسم المنتج</label>
                        <input disabled type="text" value="{{ $product->category?->name }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">مزود الخدمة</label>
                        <input disabled type="text" value="{{ $product->user?->name }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">الكمية</label>
                        <input disabled type="number" value="{{ $product->quantity }}" class="form-control">
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">سعر الشراء</label>
                        <input disabled type="number" value="{{ $product->purchase_price }}" class="form-control">
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">سعر البيع</label>
                        <input disabled type="number" value="{{ $product->sell_price }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">نوع التوصيل</label>
                        <input disabled type="text" value="{{ __('admin.' . $product->delivery_type) }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group form-check mb-0">
                        <label for="" class="small-label form-check-label mb-0">السماح بالبيع بدون
                            الكمية</label>
                        <input disabled type="text" value="{{ $product->no_quantity == 1 ? 'نعم' : 'لا' }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group form-check mb-0">
                        <label for="" class="small-label form-check-label d-block mb-0">الحالة</label>
                        <span class="badge text-wihte  {{
                            $product->status === 'accepted' ? 'accepted-bg' :
                            ($product->status === 'pending' ? 'pending-bg' : 'rejected-bg')
                        }} ">
                            {{ __('admin.' . $product->status) }}
                        </span>
                        @if ($product->rejected_reason)
                        <p>{{ $product->rejected_reason }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group form-check mb-0">
                        <label for="" class="small-label form-check-label mb-0">الباركود</label>
                        <input disabled type="text" value="{{ $product->barcode }}" class="form-control">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="" class="mb-2 small-label">الوصف</label>
                        <textarea disabled class="form-control">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="col-12">
                    <h6 class="mb-0 text-primary">صور المنتج</h6>
                </div>
                <div class="col-sm-6 col-md-4">
                    <a data-fancybox href="{{ display_file($product->image) }}" data-caption="{{ $product->name }}">
                        <img src="{{ display_file($product->image) }}" alt="{{ $product->name }}" class="w-100 h-200px object-fit-cover">
                    </a>
                </div>
                @foreach ($product->files as $item)
                <div class="col-sm-6 col-md-4">
                    <a data-fancybox href="{{ display_file($item->path) }}" data-caption="{{ $product->name }}">
                        <img src="{{ display_file($item->path) }}" alt="{{ $product->name }}" class="w-100 h-200px object-fit-cover">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox", {
        groupAll: true, // Group all items
        Toolbar: {
            display: ["close"],
        },
    });
</script>
@endsection
