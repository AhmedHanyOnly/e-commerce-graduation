@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
    <div class="main-title">
        <div class="small">
            @lang('Home')
        </div>
        <div class="large">
            @lang('admin.Dashboard')
        </div>
    </div>
    <div class="row g-3 mb-2">
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Clients')</h6>
                    <h3 class="amount"><span class="num-stat" data-goal="{{ \App\Models\User::where('type', 'client')->count() }}">0</span></h3>
                    <a href="{{ route('admin.clients') }}" class="link-view">@lang('admin.View all clients')</a>
                </div>
                <div class="left-side">
                    <p class="status-number up"> </i></p>
                    <div class="icon-holder green">
                        <i class="fa-regular fa-circle-user"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic purple">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Sections')</h6>
                    <h3 class="amount num-stat" data-goal="{{ \App\Models\Category::count() }}">0</h3>
                    <a href="{{ route('admin.categories') }}" class="link-view">@lang('admin.Show all sections')</a>
                </div>
                <div class="left-side">
                    <p class="status-number up"> </i></p>
                    <div class="icon-holder yellow">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic green">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Products')</h6>
                    <h3 class="amount"><span class="num-stat" data-goal="{{ \App\Models\Product::count() }}">0</span>
                    </h3>
                    <a href="{{ route('admin.products') }}" class="link-view">@lang('admin.Show all products')</a>
                </div>
                <div class="left-side">
                    <p class="status-number"></p>
                    <div class="icon-holder">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic ">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Groups')</h6>
                    <h3 class="amount num-stat" data-goal="{{ \App\Models\Program::count() }}">0</h3>
                    <a href="{{ route('admin.roles') }}" class="link-view">@lang('admin.View all groups')</a>
                </div>
                <div class="left-side">
                    <p class="status-number up"></p>
                    <div class="icon-holder blue">
                        <i class="fa-solid fa-bars-progress"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="row g-3">
            @php
            $latest_orders = \App\Models\Order::where('status', 'pending')->latest()->take(5)->get();
            @endphp
            <div class="col-12 col-md-6 d-none d-md-block">
                <div class="card">
                    <div class="card-header bg-white text-secondary fw-bold">
                        <i class="fa-solid fa-box me-2"></i>
                        @lang('admin.LatestOrders')
                    </div>

                    @forelse ($latest_orders as $order)
                    <div class="card-body box-order-user">
                        <div class="content">
                            <div class="avatar">
                                <img src="{{ optional($order->client)->image ? display_file($order->client->image) : asset('front-asset/img/user.webp') }}" alt="img">
                            </div>
                            <div class="about">
                                <div class="name">
                                    {{ $order->client?->name }}
                                </div>
                                <div class="data-user">
                                    <div class="id">
                                        {{ $order->number }}
                                    </div>
                                    <div class="location">
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $order->city?->name }}
                                    </div>

                                    <div class="status-order {{ $order->status === 'accepted' ? 'text-success' : ($order->status === 'refused' ? 'text-danger' : 'text-warning') }}">
                                        @if ($order->status === 'accepted')
                                        <i class="fa-solid fa-check"></i>
                                        @elseif($order->status === 'refused')
                                        <i class="fa-solid fa-x"></i>
                                        @else
                                        <i class="fa-solid fa-clock"></i>
                                        @endif
                                        {{ __('admin.' . ucfirst($order->status)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="price">
                                {{ number_format($order->total, 2) }} @lang('admin.SAR')
                            </div>
                            <div class="date">
                                {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-warning">@lang('admin.NoOrders')</div>
                    @endforelse

                    <a href="{{ route('admin.orders') }}" class="btn-order">
                        @lang('admin.MoreOrders')
                        <i class="fa-solid fa-angle-left ms-3"></i>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="row g-3">

                    <!-- <div class="col-12 col-md-6">
                    <div class="box-statistic ">
                        <div class="right-side">
                            <h6 class="name">@lang('admin.Groups')</h6>
                            <h3 class="amount num-stat" data-goal="{{ \App\Models\Program::count() }}">0</h3>
                            <a href="#" class="link-view">@lang('admin.View all groups')</a>
                        </div>
                        <div class="left-side">
                            <p class="status-number up"></p>
                            <div class="icon-holder blue">
                                <i class="fa-solid fa-bars-progress"></i>
                            </div>
                        </div>
                    </div>
                </div> -->
                    <div class="col-12 col-md-6">
                        <div class="box-statistic blue">
                            <div class="right-side">
                                <h6 class="name">@lang('admin.Technical support')</h6>
                                <h3 class="amount num-stat" data-goal="{{ \App\Models\Ticket::count() }}">0</h3>
                                <a href="{{ route('admin.tickets.index') }}" class="link-view">@lang('admin.View support messages')</a>
                            </div>
                            <div class="left-side">
                                <p class="status-number"> </p>
                                <div class="icon-holder">
                                    <i class="fa-solid fa-headset"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="box-statistic purple">
                            <div class="right-side">
                                <h6 class="name">@lang('admin.Contact Us')</h6>
                                <h3 class="amount num-stat" data-goal="{{ \App\Models\ContactUs::count() }}">0</h3>
                                <a href="{{ route('admin.contactes') }}" class="link-view">@lang('admin.View communication messages')</a>
                            </div>
                            <div class="left-side">
                                <p class="status-number up"></p>
                                <div class="icon-holder yellow">
                                    <i class="fa-solid fa-handshake-angle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="box-statistic green">
                            <div class="right-side">
                                <h6 class="name">@lang('admin.Visitors')</h6>
                                <h3 class="amount num-stat" data-goal="{{ \App\Models\WebsiteView::count() }}">0</h3>
                                <a href="{{ route('admin.visitors') }}" class="link-view">@lang('admin.ViewAllVisitors')</a>
                            </div>
                            <div class="left-side">
                                <p class="status-number up"></p>
                                <div class="icon-holder yellow">
                                    <i class="fa-solid fa-users-viewfinder"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="box-statistic red">
                            <div class="right-side">
                                <h6 class="name">@lang('admin.OutOfStockProducts')</h6>
                                <h3 class="amount num-stat" data-goal="{{ \App\Models\Product::where('quantity', 0)->count() }}">0</h3>
                                <a href="{{ route('admin.products', ['quantity_filter' => 1]) }}" class="link-view">
                                    @lang('admin.ViewAllOutOfStockProducts')
                                </a>
                            </div>
                            <div class="left-side">
                                <p class="status-number up"></p>
                                <div class="icon-holder yellow">
                                    <i class="fas fa-box-open"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
          <div class="col-12 col-md-6 d-md-none d-block">
    <div class="card">
        <div class="card-header bg-white text-secondary fw-bold">
            <i class="fa-solid fa-box me-2"></i>
            @lang('admin.LatestOrders')
        </div>

        @forelse ($latest_orders as $order)
            <div class="card-body box-order-user">
                <div class="content">
                    <div class="avatar">
                        <img src="{{ optional($order->client)->image ? display_file($order->client->image) : asset('front-asset/img/user.webp') }}" alt="img">
                    </div>
                    <div class="about">
                        <div class="name">
                            {{ $order->client?->name }}
                        </div>
                        <div class="data-user">
                            <div class="id">
                                {{ $order->number }}
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $order->city?->name }}
                            </div>
                            <div class="status-order {{ $order->status === 'accepted' ? 'text-success' : ($order->status === 'refused' ? 'text-danger' : 'text-warning') }}">
                                @if ($order->status === 'accepted')
                                    <i class="fa-solid fa-check"></i>
                                @elseif($order->status === 'refused')
                                    <i class="fa-solid fa-x"></i>
                                @else
                                    <i class="fa-solid fa-clock"></i>
                                @endif
                                {{ __('admin.' . ucfirst($order->status)) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data">
                    <div class="price">
                        {{ number_format($order->total, 2) }} @lang('admin.SAR')
                    </div>
                    <div class="date">
                        {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">@lang('admin.NoOrders')</div>
        @endforelse

        <a href="{{ route('admin.orders') }}" class="btn-order">
            @lang('admin.MoreOrders') <i class="fa-solid fa-angle-left ms-3"></i>
        </a>
    </div>
</div>

        </div>
    </div>
</div>
</div>
@endsection
@push('js')
<script>
    let xValues = ["January", "February", "March", "April", "May", "June", "July"];
    new Chart("myChartDate", {
        type: "bar", // الرسم البياني من نوع الأعمدة
        data: {
            labels: xValues,
            datasets: [{
                    label: 'الأرباح',
                    data: [00, 100, 400, 500, 600, 700, 100],
                    backgroundColor: "#22baa6",
                    borderWidth: 1,
                    barThickness: 20,
                },
                {
                    type: 'line',
                    label: 'الطلبات',
                    data: [0, 50, 500, 200, 400, 300, 100],
                    borderWidth: 2,
                    pointRadius: 1,
                    borderColor: "#405189",
                    backgroundColor: "rgb(64 81 137 / 10%)",
                    fill: true
                },
                {
                    label: 'الربح',
                    data: [100, 200, 700, 800, 500, 600, 300],
                    type: 'line',
                    borderWidth: 2,
                    pointRadius: 1,
                    borderColor: "#f06548",
                    borderDash: [5, 5] // تحديد نمط متقطع للخط
                }
            ],
            options: {
                responsive: true,
                legend: {
                    display: true
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'index',
                    intersect: false
                }
            }
        },
    });


    if (document.querySelectorAll(".num-stat")) {
        let numStats = document.querySelectorAll(".num-stat");
        let started = false;
        document.addEventListener("DOMContentLoaded", function() {
            numStats.forEach((num) => startCount(num));
        });

        function startCount(el) {
            let goal = el.dataset.goal;
            let duration = 2000; // تحديد المدة الزمنية
            let start = null;

            function updateCount(timestamp) {
                if (!start) start = timestamp;
                let progress = timestamp - start;
                let increment = Math.floor((progress / duration) * goal);
                el.textContent = increment > goal ? goal : increment;
                if (progress < duration) {
                    requestAnimationFrame(updateCount);
                }
            }
            requestAnimationFrame(updateCount);
        }
    }
</script>
@endpush
