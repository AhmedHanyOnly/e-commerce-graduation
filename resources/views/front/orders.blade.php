@extends('front.layouts.front')
@section('title', 'الطلبات')

@section('content')
    <section class="fqa-section main-section">
        <div class="container">
            <div class="bg-white rounded shadow p-3">
                <h5 class="main-title mb-4">{{ __('Orders') }}</h5>
                <div class="main-table">
                    <div class="table-responsive">
                        <table class="main-table">
                            <thead>
                            <tr>
                                <th>{{ __('order number') }}</th>
                                <th>{{ __('total') }}</th>
                                <th>{{ __('order date') }}</th>
                                <th>{{ __('order status') }}</th>
                                <th>{{ __('payment method') }}</th>
                                <th>{{ __('rating') }}</th>
                                <th>{{ __('control') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (auth()->user()->clientOrders()->orderBy('created_at', 'desc')->get() as $order)
                                <tr>
                                    <td class="fw-bold">#{{ $order->number }}</td>
                                    <td>{!!   money($order->total) !!}</td>
                                    <td>{{ $order->created_at->translatedFormat('D d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1  align-items-center">
                                            <div
                                                class="status-order
                                        {{ $order->status === 'accepted' ? 'text-success' : ($order->status === 'done' ? 'text-primary' : ($order->status === 'refused' ? 'text-danger' : 'text-warning')) }}">
                                                @if ($order->status === 'accepted')
                                                    <i class="fa-solid fa-check"></i>
                                                @elseif($order->status === 'done')
                                                    <i class="fa-solid fa-check-circle"></i>
                                                @elseif($order->status === 'refused')
                                                    <i class="fa-solid fa-x"></i>
                                                @else
                                                    <i class="fa-solid fa-clock"></i>
                                                @endif
                                                {{ __($order->status) }}
                                            </div>

                                            @if ($order->refused_reason)
                                                <button type="button"
                                                        class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center p-0"
                                                        style='font-size:10px; width: 20px; height: 20px;'
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="{{ $order->refused_reason }}">
                                                    <i class="fa-solid fa-exclamation"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{ __($order->payment_method) }}
                                        @if($order->payment_status)
                                            <i class="fa fa-check-circle text-success" title="تم الدفع"></i>
                                        @endif

                                    </td>
                                    <td>
                                        @livewire('front.order-rating', ['orderId' => $order->id], key($order->id))
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 ">
                                            <a href="{{ route('show-order', $order->id) }}"
                                               class="main-btn text-light">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            @if(!$order->payment_status)
                                                <form method="post" action="{{route('stripe.pay',$order->id)}}">
                                                    @csrf
                                                    <button type="submit" class="main-btn">
                                                        دفع
                                                    </button>
                                                </form>
                                            @endif

                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
