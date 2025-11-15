<a href="{{route('cart')}}" class="btn-cart mt-2">
    <div class="icon-holder">
        <span class="count">{{\App\Services\CartService::getCart()->items_count}}</span>

        <i class="fa-solid fa-bag-shopping" fill="var(--main-color)"></i>
    </div>
    {{-- {{\App\Services\CartService::getTotal()}} ر.س
    --}}
</a>