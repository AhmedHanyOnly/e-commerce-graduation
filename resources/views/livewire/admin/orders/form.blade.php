<div class="main-side">
    <x-admin-alert/>
    <div class="main-title">
        <div class="small">
            {{--            @lang("Home")--}}
        </div>
        <div class="large">
            {{$obj ? 'تعديل' : 'اضافة'}} @lang("admin.Orders")
        </div>
    </div>
    <style>
        .product-list {
            max-height: 300px;
            overflow-y: auto;
            display: flex;
            flex-wrap: wrap;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            width: 200px;
        }

        .product-image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            margin-right: 10px;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-title {
            font-size: 12px;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 10px;
            margin: 0;
        }
        .order-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .order-list h5 {
            margin-top: 0;
        }

        .order-list ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .order-list li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
    </style>
    <div class="row">

        <div class="col-lg-3">
            <label class="form-label">العميل</label>
            <select wire:model="user_id" id="client_id" class="form-select select2 ">
                <option value="">-- اختر --</option>
                @foreach($clients as $name=>$id)
                    <option value="{{$name}}">{{$id}}</option>
                @endforeach
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

        {{-- <div class="col-lg-3">
            <label class="form-label">السائق</label>
            <select wire:model="driver_id" id="driver_id" class="form-select select2 ">
                <option>-- اختر --</option>
                @foreach($drivers as $name=>$id)
                    <option value="{{$name}}">{{$id}}</option>
                @endforeach
            </select>
        </div>  --}}

        <div class="col-lg-3">
            <label class="form-label">المدينه</label>
            <select wire:model.live="city_id" id="city_id" class="form-select select2  ">
                <option>-- اختر --</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-3">
            <label class="form-label">الحي</label>
            <div>
                <select wire:model.live="neighborhood_id" id="neighborhood_id" class="form-select select2 ">
                    <option>-- اختر --</option>
                    @foreach($neighborhoods as $name=>$id)
                        <option value="{{$name}}">{{$id}}</option>
                    @endforeach
                </select>
            </div>
        </div>

{{--        <div class="col-lg-3">--}}
{{--            <label class="form-label">وقت التسليم</label>--}}
{{--            <input type="datetime-local" class="form-control" wire:model="delivery_time">--}}
{{--        </div>--}}

        {{--        <div class="col-lg-3">--}}
        {{--            <label class="form-label">الحاله</label>--}}
        {{--            <select wire:model="status" class="form-select select2 ">--}}
        {{--                <option>-- اختر --</option>--}}
        {{--                <option value="pending">بانتظار الموافقه</option>--}}
        {{--                <option value="accepted">مقبول</option>--}}
        {{--                <option value="waiting">في الانتظار</option>--}}
        {{--                <option value="in_progress">جاري التوصيل</option>--}}
        {{--                <option value="done">تم التوصيل</option>--}}
        {{--                <option value="rejected">مرفوض</option>--}}
        {{--            </select>--}}
        {{--        </div>--}}


        {{--        <div class="col-lg-3" >--}}
        {{--            <label class="form-label">المنتجات</label>--}}
        {{--            <select class="form-select select2 " multiple id="items" wire:model="items">--}}
        {{--                <option>-- اختر --</option>--}}
        {{--                @foreach(\App\Models\Product::get() as $product)--}}
        {{--                    <option value="{{$product->id}}">{{$product->name}}</option>--}}
        {{--                @endforeach--}}
        {{--            </select>--}}
        {{--        </div>--}}


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
            <label class="form-label">المسافه (كم)</label>
            <input type="number" min="0" class="form-control" wire:model="distance" disabled>
        </div>


        <div class="col-lg-3">
            <label class="form-label">سعر التوصيل</label>
            <input type="number" min="0" class="form-control" wire:model="shipping_price" disabled>
        </div>
        <div class="col-lg-3">
            <label class="form-label">الضريبه علي التوصيل</label>
            <input type="number" min="0" class="form-control" wire:model="shipping_tax" disabled>
        </div>
        <div class="col-lg-3">
            <label class="form-label">الاجمالي</label>
            <input type="number" min="0" class="form-control" wire:model="total" disabled>
        </div>

{{--        @if($city_id)--}}
{{--            <div wire:ignore class="col-lg-3">--}}
{{--                <label class="form-label">اضافة منتجات للطلب</label>--}}
{{--                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button>--}}
{{--                <div  class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"--}}
{{--                     aria-hidden="true">--}}
{{--                    <div class="modal-dialog">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>--}}
{{--                                <button type="button" class="btn-close" data-bs-dismiss="modal"--}}
{{--                                        aria-label="Close"></button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <input  class="form-control" placeholder="بحث">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-6">--}}
{{--                                        <div class="product-list">--}}
{{--                                            @foreach(\App\Models\Product::whereRelation('user', 'city_id',$city_id)->get() as $product)--}}
{{--                                                <div class="product-item" wire:click="addToItems({{$product}})">--}}
{{--                                                    <img src="{{ display_file($product->image) }}" class="product-image" alt="{{ $product->name }}">--}}
{{--                                                    <div class="product-details">--}}
{{--                                                        <h6 class="product-title">{{ Str::limit($product->name, 50) }}</h6>--}}
{{--                                                        <p class="product-price">${{ $product->sell_price }}</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                        <div class="col-6">--}}
{{--                                            <div class="order-list">--}}
{{--                                                <h5>Order Details</h5>--}}
{{--                                                <ul id="order-items"></ul>--}}
{{--                                                <p>Subtotal: $<span id="subtotal">0</span></p>--}}
{{--                                                <p>Total: $<span id="total">0</span></p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

    </div>
    <div wire:ignore>
        <div style="height: 80vh" class="mt-2" id="map"></div>
    </div>
    <button wire:click="submit" class="btn btn-success my-2">حفظ</button>
</div>
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASM7VEAkM0XHKds0Tlp7w--Hqd24k0BSo&callback=initMap"
            async defer></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng({{$obj->latitude ?? 25}}, {{$obj->longitude ?? 48}})
                , zoom: 5
                , mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker;
            map.addListener("click", function (event) {
                placeMarker(event.latLng);
            });

            function placeMarker(location) {
                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    position: location
                    , map: map
                });
                @this.
                set('latitude', location.lat().toFixed(6));
                @this.
                set('longitude', location.lng().toFixed(6));
            }

            marker = new google.maps.Marker({
                position: location
                , map: map
            });
            {{--placeMarker(new google.maps.LatLng('{{$obj?->latitude ?? null}}', '{{$obj?->longitude ?? null}}'))--}}


            {{--placeMarker(new google.maps.LatLng('{{$obj?->latitude}}', '{{$obj?->longitude}}'))--}}



            document.addEventListener('resetMap', function () {
                initMap()
            });


        }


    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function select2init() {
            $(document).ready(function () {
                $('.select2').each(function () {
                    $(this).select2();

                    $(this).on('change', function () {
                        var data = $(this).val();
                        var name = $(this).attr('id');
                        @this.
                        set(name, data);
                    });
                })

            });
        }

        select2init();

        document.addEventListener('refreshSelect2', () => {
            select2init();
        });

    </script>
@endpush
