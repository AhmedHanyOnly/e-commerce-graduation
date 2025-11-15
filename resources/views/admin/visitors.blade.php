@extends('admin.layouts.admin')
@section('title', 'الزيارات')

@section('content')
    <div class="main-side">
        <div class="main-title">
            <div class="small">
                الرئيسية
            </div>
            <div class="large">
                الزيارات
            </div>
        </div>
        <!-- <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
                            <a class="main-btn" href="">@lang('admin.Add') <i class="fas fa-plus"></i></a>

                        </div> -->

        @php
            $views = \App\Models\WebsiteView::paginate(10);
        @endphp

        <div class="table-responsive">
            <table class="main-table " style="text-align:center">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">IP</th>
                        <th class="text-center">العنوان</th>

                        <th class="text-center">الموقع ع الخريطة</th>

                        <th class="text-center">التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($views as $view)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $view->ip }}</td>
                            <td>{{ $view->address }}</td>
                            <td>
                                @if ($view->lat && $view->long)
                                    <a href="{{ "https://www.google.com/maps?q=$view->lat,$view->long" }}"
                                        class="btn btn-warning btn-sm"><i class="fa-solid fa-map-location-dot"></i></a>
                                @endif
                            </td>

                            <td>{{ $view->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="mt-3">
                {{ $views->links() }}
            </div>
        </div>
    </div>
@endsection
