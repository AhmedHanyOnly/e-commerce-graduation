<div class="data-product">
    <div class="info">
        <div class="name">
            {{ $product->name }}
        </div>
        <div class="tax">
            {{ __('Price incl. VAT') }}
        </div>
        <div class="d-flex align-items-center justify-content-between my-4 ">
            <div class="right-rates flex-wrap">
                <div class="rate">
                    @if ($product->rates->count() > 0)
                        @php
                            $total_rate = $product->rates->sum('rate') / $product->rates->count();
                        @endphp
                        <div class="stars">
                            @if ($total_rate > 0)
                                @foreach (range(1, 5) as $i)
                                    @if ($total_rate > 0)
                                        @if ($total_rate > 0.5)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @else
                                            <i class="fa-solid fa-star-half-stroke fa-flip-horizontal text-warning"></i>
                                        @endif
                                    @else
                                        <i class="fa-regular fa-star text-warning"></i>
                                    @endif
                                    <?php $total_rate--; ?>
                                @endforeach
                            @endif
                        </div>
                        <span class="text">({{ $product->rates->count() }} {{ __('Rate') }})</span>
                    @else
                        <span class="text">{{ __('There are no reviews yet.') }}</span>
                    @endif
                </div>

                <div class="addFav">
                    <button type="button" wire:click='addToFavorite' onclick='ToggleFav()'
                        class="add-fav-text {{ $favourite ? 'active' : '' }}">
                        <i class="fa-{{ $favourite ? 'solid' : 'regular' }} fa-heart"></i>
                        {{ $favourite ? __('Added') : __('addition') }} {{ __('For Wishlist') }}
                    </button>
                </div>
            </div>
            <div class="buttons-options">
                <button type="button" id="btn-shere" class="btn-icon-pr share">
                    <i class="fa-solid fa-share-from-square"></i>
                </button>
            </div>
        </div>
        {{ $product->category?->name }}/{{ $product->categoryChild?->name }}
        <div class="desc-product mb-3">
            {!! Str::limit($product->description, 150) !!}
            @if (strlen($product->description) > 150)
                <a href="#description" class="fw-bold">{{ __('View More') }}</a>
            @endif
        </div>
        <x-admin-alert />
        <!-- <div>
            {{ $product->category?->name }}
        </div> -->

        @if ($product->quantity > 0)

            @if ($product->variants()->exists())
                <div class="size-pr my-3">
                    <span class="title mb-3">{{ __('volume') }}</span>
                    <div class="btn-holder-sizes d-flex gap-2 flex-wrap align-items-center py-3">
                        @foreach ($product->variants as $variant)
                            <button wire:click="$set('variant_id','{{ $variant->id }}')" @class(['btn-size', 'active' => $variant_id == $variant->id])>
                                {{ $variant->size?->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (setting('product_colors_active'))
                @if (count($colors) > 0)
                    <div class="size-pr my-3">
                        <span class="title mb-3">{{ __('Color') }}</span>
                        <div class="btn-holder-sizes d-flex gap-2 flex-wrap align-items-center py-3">
                            @foreach ($colors as $color)
                                <button @class(['btn-size', 'active' => $color_id == $color->color->id])
                                    wire:click="$set('color_id','{{ $color->color->id }}')">{{ $color->color?->name }}</button>
                            @endforeach

                        </div>
                    </div>

                @endif
            @endif
        @endif

    </div>
    <div class="control mt-1">
        @if ($product->quantity > 0)
            <div class="count">
                <button class="increment" wire:click="increment">+</button>
                <span class="val">{{ $qty }}</span>
                <button class="decrement" wire:click="decrement">-</button>
            </div>
        @endif
        <div class="d-flex gap-3">
            <div class="price-gl">
                {{ $variant_id ? $sell_price : $product->sell_price }} {{ setting('currency') }}
            </div>
            @if ($product->discount > 0)
                <div class="price-old">
                    {{ $variant_id ? $discount : $product->discount }} {{ setting('currency') }}
                </div>
            @endif
        </div>
    </div>
    @if ($product->quantity > 0 || $product->digital_product)
        <div class="control-btn">
            @if ($product->quantity > 0 || $product->digital_product)
                <button wire:click="add({{ $product->id }})" class="main-pr">{{ __('Add to cart') }}</button>
            @else
                <span class="text-danger">{{ __('Quantity expired') }}</span>
            @endif

            @php
                $avilableItem = App\Services\CartService::getCart()->items()->count();
            @endphp
            @if ($avilableItem)
                <button data-bs-toggle="modal" data-bs-target="#purchase" class="main-pr">
                    {{ __('Buy Now') }}
                    <i class="fa-solid fa-wallet me-2"></i>
                </button>
                <div class="modal fade" id="purchase" aria-hidden="true" wire:ignore>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Buy the product now') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ __('The current basket will be deleted and added to favorites Are you sure?') }}
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إلغاء</button>  --}}
                                <button wire:click="purchase({{ $product->id }})" data-bs-dismiss="modal"
                                    class="main-pr">{{ __('Buy Now') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <button wire:click="purchase({{ $product->id }})" class="main-pr">
                    {{ __('Buy Now') }}
                    <i class="fa-solid fa-wallet me-2"></i>
                </button>
            @endif


        </div>
    @else
        @if (setting('is_active_pre_order') && setting('pre_order_days'))
            <div class="alert alert-warning text-center fw-bold" role="alert">
                {{ __('messages.out_of_stock_message', ['days' => setting('pre_order_days')]) }}
            </div>
            <div class="control-btn">
                <button wire:click="add({{ $product->id }},true)" class="main-pr">{{ __('Add to cart') }}</button>
            </div>
        @else
            <div class="alert alert-warning text-center fw-bold" role="alert">
                {{ __('You have sold out of stock') }}
            </div>
        @endif
    @endif



    <script>
        const shareData = {
            url: "{{ Request::url() }}",
        };

        const btn = document.querySelector("#btn-shere");

        btn.addEventListener("click", async () => {
            try {
                await navigator.share(shareData);
            } catch (err) {}
        });

        async function addAnimation(eleImg) {
            // Animation
            const cartSpan = document.querySelector(".btn-cart .icon-holder .count");
            const rect = cartSpan.getBoundingClientRect();
            const imgCart = document.querySelector(eleImg);
            console.log(imgCart);
            const imgCartRect = imgCart.getBoundingClientRect();
            imgCart.style.transform = `translate(${rect.left - imgCartRect.left}px, ${rect.top - imgCartRect.top}px)`;
            imgCart.style.transition = "1s ease-out";
            imgCart.style.width = "20px";
            imgCart.style.height = "20px";
            imgCart.style.opacity = "0.5";
            setTimeout(() => {
                imgCart.style.transition = "0s";
                imgCart.style.transform = `translate(0, 0)`;
                imgCart.style.width = "100%";
                imgCart.style.height = "350px";
                imgCart.style.opacity = "1";
            }, 1000);
        }
    </script>

</div>
