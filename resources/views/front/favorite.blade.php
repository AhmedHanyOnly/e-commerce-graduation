@extends('front.layouts.front')
@section('title', __('Favorites'))
@section('content')
    <section class="fqa-section main-section">
        <div class="container">
            <div class="bg-white rounded shadow p-3">
                <h5 class="main-title mb-5">{{ __('Favorites') }}</h5>
                <div class="row g-3">
                    @if ($favorites->count() > 0)
                        @foreach ($favorites as $favorite)
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="box-product-land">
                                    <form action="{{ route('favorites.destroy', $favorite->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="love-product" type="submit">
                                            <i class="fa-solid fa-heart text-danger"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('products.show', $favorite->product->id) }}">
                                        <img src="{{ display_file($favorite->product->image) }}" class="img-product"
                                            alt="{{ $favorite->product->name }}" />
                                        <div class="text">
                                            <div class="title"> {{ $favorite->product->name }}</div>
                                            <div class="price">
                                                <div class="num">{{ $favorite->product->sell_price }}</div>
                                                {{ __('SAR') }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            {{ __('There are no products in Wishlist currently.') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
