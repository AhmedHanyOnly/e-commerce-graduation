@extends('admin.layouts.admin')
@section('content')
<div class="main-side product-number-section">
    <img src="{{asset('front-asset/img/product-number.png')}}" class="img-land-bg d-none d-md-block " alt="">

    <div class="main-title">
        <div class="small">
            @lang('admin.Home')
        </div>
        <div class="large">
            المنتجات الرقمية
        </div>
    </div>
    <ul class="conditions-holder">
        <li class="item">
            <span>
                المنتجات الرقمية وهي الي تباع مرة وحدة مثل اشتراكات شاهد او نت فلكس او منتجات مايكرو سوفت.
            </span>
        </li>
        <li class="item">
            <span>
                كود المنتج او بينات المنتج ستظهر للعميل مباشرة بعد الشراء ولايمكن تكرار الشراء لعميل اخر .
            </span>
        </li>
        <li class="item">
            <span>
                المنتج الرقمي لايعتمد على الكميات ولا يظهر بانتهاء المنتج عند الشراء يختفي .
            </span>
        </li>
        <li class="item">
            <span>
                الفكرة قابلة للتطور والمشاركة من قبلكم في حال وجود ملاحظات . <a href="https://wa.me/0506499275" class="text-primary">0506499275</a> </span>
        </li>
    </ul>
</div>



@endsection
