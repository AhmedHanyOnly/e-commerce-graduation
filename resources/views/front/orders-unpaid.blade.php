@extends('front.layouts.front')
@section('title', 'طلبات بانتظار الدفع')
@section('content')
    <section class="fqa-section main-section">
        <div class="container">
            <div class="bg-white rounded shadow p-3">
                <h5 class="main-title mb-4">طلبات بانتظار الدفع</h5>
                <div class="main-table">
                    <div class="table-responsive">
                        <table class="main-table">
                            <thead>
                                <tr>
                                    <th class="">رقم الطلب</th>
                                    <th class="">المجموع</th>
                                    <th class="">تاريخ الطلب</th>
                                    <th class="">حالة الطب</th>
                                    <th class="">التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->clientOrders()->where('status', 'accepted')->whereNull('paid_at')->orderBy('created_at', 'desc')->get() as $order)
                                    <tr>
                                        <td class="fw-bold">#{{ $order->number }}</td>
                                        <td>{{ $order->total }} {{ __('SAR') }}</td>
                                        <td>{{ $order->created_at->translatedFormat('الD d M Y') }}</td>

                                        <td>
                                            <div
                                                class="status-order {{ $order->status === 'accepted' ? 'text-success' : ($order->status === 'refused' ? 'text-danger' : 'text-warning') }}">
                                                @if ($order->status === 'accepted')
                                                    <i class="fa-solid fa-check"></i>
                                                @elseif($order->status === 'refused')
                                                    <i class="fa-solid fa-x"></i>
                                                @else
                                                    <i class="fa-solid fa-clock"></i>
                                                @endif
                                                {{ __($order->status) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center ">
                                                <a href="{{ route('show-order', $order->id) }}" class="main-btn text-light">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
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
