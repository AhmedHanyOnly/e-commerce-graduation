<div class="main-side">
    <x-message-admin/>
    <div class="main-title">
        <div class="small">
            @lang('Home')
        </div>
        <div class="large">
            تقييمات المنتج : {{ $product->name }}
        </div>
    </div>
    <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">
        <a type="button" wire:click='$set("filter_status",null)' class="main-btn btn-main-color">الكل:
            {{ $all }}</a>
        <a type="button" wire:click='$set("filter_status","pending")' class="main-btn bg-warning">بالانتظار:
            {{ $pending }}</a>
        <a type="button" wire:click='$set("filter_status","accepted")' class="main-btn bg-success">مقبول:
            {{ $accepted }}</a>
        <a type="button" wire:click='$set("filter_status","rejected")' class="btn btn-danger">مرفوض:
            {{ $rejected }}</a>
    </div>
    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
            <tr>
                <th>#</th>
                <th>العميل</th>
                <th>التعليق</th>
                <th>@lang('Status')</th>
                <th>التقييم</th>
                {{--                    <th>سبب الرفض</th>--}}
                {{--                    <th>التعليقات</th>--}}
                <th>@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rates as $rate)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rate->user?->name }} </td>
                    <td>{{ Str::limit($rate->comment, 50, $end = '....') }}</td>
                    <td>
                        <span class="badge bg-{{ __('status_' . $rate->status) }}">{{ __($rate->status) }}</span>
                    </td>
                    <td>
                        {{$rate->rate}} <i class="fa fa-star " style="color: orange"></i>
                    </td>

                    <td class="d-flex gap-2">
                        @if ($rate->status != 'accepted')
                            <button type="button" wire:click='approve({{ $rate->id }})'
                                    class="btn btn-success btn-sm text-white mx-1">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        @endif
                        @if ($rate->status != 'rejected')
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#reject{{ $rate->id }}">
                                <i class="fa-solid fa-x"></i>
                            </button>
                            @include('admin.rates.reject')
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $rates->links() }}
    </div>
</div>
