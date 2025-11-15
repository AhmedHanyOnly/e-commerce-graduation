<div class="main-side">
    <x-admin-alert />
    <div class="main-title">
        <div class="small">
            @lang("Home")
        </div>
        <div class="large">
            {{ $obj ? 'تعديل':'اضافة'}} مزود خدمة
        </div>
    </div>
    <div class="row mb-2 g-3">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang("Name")</span>
                    <input type="text" wire:model="name" id="" class="form-control">
                </label>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang("Phone")</span>
                    <input type="tel" id="" wire:model="phone" class="form-control">
                </label>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span> البريد الالكتروني</span>
                    <input type="email" wire:model="email" class="form-control" id="">
                </label>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span> @lang("Password")</span>
                    <input type="password" wire:model="password" class="form-control" id="">
                </label>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-label" for="">@lang("City")</label>
                <select wire:model.live="city_id" id="city_id" class="form-select">
                    <option value="">@lang("Select city")</option>
                    @foreach($cities as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-label" for="">@lang("admin.Neighborhoods")</label>
                <select wire:model="neighborhood_id" id="neighborhood_id" class="form-select">
                    <option value="">@lang("Select Neighborhood")</option>
                    @foreach($neighborhoods as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span>رقم السجل التجاري</span>
                    <input type="number" wire:model="commercial_record_number" class="form-control" id="">
                </label>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="form-group mb-1">
                <label class="mb-1">صورة السجل التجاري</label>
                <input wire:model="commercial_record_image" id="commercial_record_image" class="form-control" type="file" accept="image/*">
            </div>
            <img src="{{ $obj?->commercial_record_image? display_file($obj->commercial_record_image):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span>الحساب البنكي</span>
                    <input type="text" wire:model="bank_account" class="form-control" id="">
                </label>
            </div>
        </div>


        <div class="col-12 col-md-4 col-lg-3">
            <div class="form-group mb-1">
                <label class="mb-1">@lang("Image")</label>
                <input wire:model="image" class="form-control" type="file" accept="image/*">
            </div>
            <img src="{{ $obj?->image? display_file($obj->image):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="form-group mb-1">
                <label class="mb-1">صورة الشعار</label>
                <input wire:model="logo" class="form-control" type="file" accept="image/*">
            </div>
            <img src="{{ $obj?->logo? display_file($obj->logo):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="60px">
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span>وقت العمل من</span>
                    <input type="time" wire:model="from_time" class="form-control" id="from_time">
                </label>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="inp-holder">
                <label class="special-input">
                    <span>وقت العمل الي</span>
                    <input type="time" wire:model="to_time" class="form-control" id="to_time">
                </label>
            </div>
        </div>
        <div id="mapParent" class="mt-4" wire:ignore>
            <div id="map" style="height: 100vh"></div>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center my-3">
                <button class="main-btn" wire:click='submit'>@lang("Save")</button>
            </div>
        </div>
    </div>

</div>
@push('js')
<script data-navigate-once src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASM7VEAkM0XHKds0Tlp7w--Hqd24k0BSo&callback=initMap" async defer></script>
<script data-navigate-once>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng('{{ $vendor?->latitude ?? 23 }}', '{{ $vendor?->longitude ?? 48 }}')
            , zoom: 7
            , mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker;
        map.addListener("click", function(event) {
            placeMarker(event.latLng);
        });
        placeMarker(new google.maps.LatLng('{{ $vendor?->latitude }}', '{{ $vendor?->longitude }}'));

        function placeMarker(location) {
            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                map
                , position: location
            });
            @this.set('latitude', location.lat().toFixed(6));
            @this.set('longitude', location.lng().toFixed(6));
        }

    }

</script>
@endpush
