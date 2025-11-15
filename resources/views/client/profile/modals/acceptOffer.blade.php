<div class="modal fade" id="acceptOffer{{$order->id}}" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between ">
                <h1 class="modal-title fs-5" id="exampleModalLabel">الموافقه علي عرض السعر</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <label class="form-label text-start" >المسافة</label>
                <input value="{{$order->distance}}" class="form-control" disabled>

                <label class="form-label text-start">السعر</label>
                <input value="{{$order->subtotal}}" class="form-control" disabled>

                <label class="form-label text-start">الشحن</label>
                <input value="{{$order->shipping_price}}" class="form-control" disabled>

                <label class="form-label text-start">الضريبة علي الطلب</label>
                <input value="{{$order->tax}}" class="form-control" disabled>


                <label class="form-label text-start">الاجمالي</label>
                <input value="{{$order->total}}" class="form-control" disabled>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal"  wire:click="refuseOffer({{$order}})">رفض
                </button>
                <button wire:click="acceptOffer({{$order}})" type="button"  data-bs-dismiss="modal" class="btn btn-success">موافقة</button>
            </div>
        </div>
    </div>
</div>
