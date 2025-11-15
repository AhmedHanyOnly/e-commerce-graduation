<div class="col-content col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <x-admin-alert></x-admin-alert>
    <div class="card ">
        <div class="card-body">
            <div class="row gutters g-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h5 class="mb-2 text-primary">{{ __('personal information') }}</h5>
                </div>
                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="name" class="mb-2 small-label">{{ __('Name') }}</label>
                        <input type="text" wire:model="name" class="form-control" id="name">


                    </div>
                </div>
                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="eMail" class="mb-2 small-label">{{ __('E-Mail Address') }}</label>
                        <input type="email" wire:model="email" class="form-control" id="eMail">

                    </div>
                </div>
                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone" class="mb-2 small-label">@lang('Phone')</label>
                        <input type="number" wire:model="phone" class="form-control" id="phone">

                    </div>
                </div>

                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="" class="mb-2">{{ __('profile picture') }}</label>
                        <input type="file" wire:model.defer="image" class="form-control">
                    </div>
                </div>


                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="password" class="small-label mb-2">{{ __('Password') }}</label>
                        <input type="password" autocomplete="one-time-code" name="password" class="form-control"
                            id="password">

                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex  justify-content-center  my-3">
            <div class="text-right">
                <button type="button" wire:click="submit"
                    class="btn btn-sm btn-success">{{ __('Save Changes') }}</button>
            </div>
        </div>
    </div>
    <div id="mapParent" class="mt-4" wire:ignore>
        <div id="map" style="height: 100vh"></div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@push('js')
    <script data-navigate-once
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASM7VEAkM0XHKds0Tlp7w--Hqd24k0BSo&callback=initMap" async
        defer></script>
    <script data-navigate-once>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng('{{ $user?->latitude ?? 23 }}', '{{ $user?->longitude ?? 48 }}'),
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker;
            map.addListener("click", function(event) {
                placeMarker(event.latLng);
            });
            placeMarker(new google.maps.LatLng('{{ $user?->latitude }}', '{{ $user?->longitude }}'));

            function placeMarker(location) {
                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    map,
                    position: location
                });
                @this.set('latitude', location.lat().toFixed(6));
                @this.set('longitude', location.lng().toFixed(6));
            }

        }
    </script>
@endpush
