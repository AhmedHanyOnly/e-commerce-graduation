<div class="main-side">
    <x-admin-alert></x-admin-alert>
    <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
        <div class="main-title mb-0">
            <div class="small">@lang('Home')</div>
            <div class="large">@lang(($screen == 'edit' ? 'Edit' : 'Add') . ' client')</div>
        </div>
        <div class="d-flex gap-2">
            {{-- <button class="main-btn btn-main-color" wire:click='$set("screen","index")'>@lang("View all clients")</button> --}}
            <a href="{{ route('admin.clients') }}" wire:navigate class="main-btn btn-main-color">@lang('View all clients') <i
                    class="fas fa-arrow-left-long"></i></a>

        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang('Name')</label>
            <input type="text" wire:model="name" class="form-control">
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang('Phone')</label>
            <input type="text" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                wire:model="phone" class="form-control">
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang('email')</label>
            <input type="email" id="email" wire:model="email" class="form-control">
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang('admin.Password')</label>
            <input type="password" wire:model="password" id="password" class="form-control">
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang('City')</label>
            <select wire:model.live="city_id" id="city_id" class="form-control">
                <option value="">@lang('Select city')</option>
                @foreach ($select_citites as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang('admin.Country')</label>
            <select wire:model.live="neighborhood_id" id="neighborhood_id" class="form-control">
                <option value="">@lang('admin.Choose')</option>
                @foreach ($select_neighborhoods as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="col-12 col-md-4 col-lg-3">
            <label for="">صورة شخصية</label>
            <input type="file" wire:model="image" class="form-control">
        </div> --}}
        <div class="col-12 col-md-4 col-lg-3" x-data="{ upload_image: false, progress: 0 }" x-on:livewire-upload-start="upload_image = true"
            x-on:livewire-upload-finish="upload_image = false" x-on:livewire-upload-cancel="upload_image = false"
            x-on:livewire-upload-error="upload_image = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <label class="special-input">
                <span>@lang('Image')</span>
                <input class="form-control" wire:model="image" type="file" accept="image/*">
                <div class="progress-bar mt-2" x-show="upload_image">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </label>


            @if ($obj && $obj->image)
                <img src="{{ display_file($obj->image) }}" alt="" class="img-thumbnail img-preview"
                    width="60px">
            @else
                <img src="{{ asset('admin-asset/img/image-preview.webp') }}" alt=""
                    class="img-thumbnail img-preview" width="60px">
            @endif


        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <label for="">@lang('Status')</label>
            <select wire:model="active" class="form-control">
                <option value="1">@lang('Active')</option>
                <option value="0">غير مفعل</option>
            </select>
        </div>
        {{-- <div class="col-12 col-md-4 col-lg-3">
            <label for="">نوع الحديقة</label>
            <select wire:model.live="garden_types" id="garden_types" class="form-select select2" multiple>
                <option value="">اختر نوع الحديقة</option>
                @foreach ($select_garden_types as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div> --}}

        <div id="mapParent" class="mt-4" wire:ignore>
            <div id="map" style="height: 100vh"></div>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center my-3">
                {{-- <button class="main-btn" wire:click='submit'>@lang("Save")</button> --}}
                <button class="main-btn" wire:click="submitAndRedirect">حفظ</button>

            </div>
        </div>
    </div>

</div>
@push('js')
    <script data-navigate-once
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASM7VEAkM0XHKds0Tlp7w--Hqd24k0BSo&callback=initMap" async
        defer></script>
    <script data-navigate-once>
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
                @this.set('latitude', location.lat().toFixed(6));
                @this.set('longitude', location.lng().toFixed(6));
            }

        }
    </script>
@endpush
