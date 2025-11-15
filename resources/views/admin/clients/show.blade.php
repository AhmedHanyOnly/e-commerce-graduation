@extends('admin.layouts.admin')
@section('content')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
            <div class="main-title mb-0">
                <div class="small">@lang('Home')</div>
                <div class="large">عرض العميل</div>
            </div>
            <div class="d-flex gap-2">
                <a class="main-btn btn-main-color" href="{{ route('admin.clients') }}">@lang('View all clients')</a>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12 col-md-4 col-lg-3">
                <label for="">@lang('Name')</label>
                <input type="text" value="{{ $client->name }}" disabled class="form-control">
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <label for="">@lang('Phone')</label>
                <input type="number" value="{{ $client->phone }}" disabled class="form-control">
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <label for="">@lang('admin.Email')</label>
                <input type="email" id="email" value="{{ $client->email }}" disabled class="form-control">
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <label for="">@lang('City')</label>
                <input type="city" id="city" value="{{ $client->city?->name }}" disabled class="form-control">
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <label for="">@lang('admin.Neighborhoods')</label>
                <input type="neighborhood_id" id="neighborhood_id" value="{{ $client->neighborhood?->name }}" disabled
                    class="form-control">
            </div>
            {{-- <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang("Garden type")</label>
            <div>
                @foreach ($client->gardens as $garden)
                <span class="badge bg-dark">{{ $garden->name }}</span>
                @endforeach
            </div>
            </div> --}}
            <div class="col-12 col-md-4 col-lg-3">
                <label for="">@lang('Status')</label>
                <input type="active" id="active" value="{{ $client->active ? 'مفعل' : 'غير مفعل' }}" disabled
                    class="form-control">
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <label for="">صورة شخصية</label>
                <div>
                    <img src="{{ display_file($client->image) }}" alt="" class="img-thumbnail img-preview" width="50">
                </div>
            </div>
        </div>

        <div id="mapParent" class="mt-4">
            <div id="map" style="height: 100vh"></div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASM7VEAkM0XHKds0Tlp7w--Hqd24k0BSo&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng('{{ $client?->latitude ?? 23 }}', '{{ $client?->longitude ?? 48 }}'),
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker;
            map.addListener("click", function(event) {
                placeMarker(event.latLng);
            });
            placeMarker(new google.maps.LatLng('{{ $client?->latitude }}', '{{ $client?->longitude }}'));

            function placeMarker(location) {
                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    map,
                    position: location
                });
            }

        }
    </script>
@endpush
