<div class="col-content col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card ">
        <div class="card-body">
            <h5 class="mb-0 text-primary mb-3">اضافة طلب</h5>
            <x-admin-alert/>
                <div class="row">
                    <div class="col-lg-3">
                        <label class="form-label">حاله الحديقه</label>
                        <select class="form-select select2 " id="garden_status" wire:model="garden_status">
                            <option>-- اختر --</option>
                            <option value="new">جديد</option>
                            <option value="old">قديم</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">القسم</label>
                        <select wire:model="category_id" id="category_id" class="form-select select2 ">
                            <option>-- اختر --</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">المدينه</label>
                        <select wire:model.live="city_id" id="city" class="form-select">
                            <option>-- اختر --</option>
                            @foreach($cities as $id=>$city)
                                <option value="{{$id}}">{{$city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">الحي</label>
                        <div>
                            <select wire:model="neighborhood_id" id="neighborhood" class="form-select">
                                <option>-- اختر --</option>
                                @foreach($neighborhoods as $id=>$name)
                                    <option value="{{$id}}">{{$name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">نوع الحديقه</label>
                        <select wire:model="garden_type_id" id="garden_type_id" class="form-select  ">
                            <option>-- اختر --</option>
                            @foreach($gardens as $id=>$name)
                                <option value=" {{ $id }}"> {{ $name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">وقت التسليم</label>
                        <input type="datetime-local" class="form-control" wire:model="delivery_time">
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">المكان</label>
                        <select class="form-select select2 " id="place" wire:model="place">
                            <option>-- اختر --</option>
                            <option value="internal">داخلي</option>
                            <option value="external">خارجي</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">وصف الطلب</label>
                        <textarea class="form-control" wire:model="description"></textarea>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">العنوان</label>
                        <input class="form-control" wire:model="address">
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">مساحة الحديقة</label>
                        <input type="number" min="0" class="form-control" wire:model="garden_space">
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">ارفاق صوره</label>
                        <input type="file" class="form-control" wire:model="image" accept="image/*">
                    </div>
                </div>
                <div class="my-3" wire:ignore>
                    <div id="map" style="width: 100%;height: 200px"></div>
                </div>
                <div class="d-flex justify-content-center ">
                    <button wire:click="submitOrder" class="btn btn-success my-2">حفظ</button>
                </div>
        </div>

    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASM7VEAkM0XHKds0Tlp7w--Hqd24k0BSo&callback=initMap"
async defer></script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: {{auth()->user()->latitude ?? 24 }},
                lng: {{auth()->user()->longitude ?? 31.2357}}
            },
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker;
        map.addListener("click", function(event) {
            placeMarker(event.latLng);
        });

        function placeMarker(location) {
            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: location,
                map: map
            })

            // Round the latitude and longitude values to six decimal places and keep them as numbers
            // var lat = Math.round(location.lat() * 1000000) / 1000000;
            //var lng = Math.round(location.lng() * 1000000) / 1000000;

            // document.getElementById("latitude").value = location.lat().toFixed(6);
            // document.getElementById("longitude").value = location.lng().toFixed(6);
        @this.set('latitude',location.lat().toFixed(6))
        @this.set('longitude',location.lng().toFixed(6))
        }

        placeMarker(new google.maps.LatLng('{{ auth()->user()->latitude }}', '{{ auth()->user()->longitude }}'));

    }

</script>

