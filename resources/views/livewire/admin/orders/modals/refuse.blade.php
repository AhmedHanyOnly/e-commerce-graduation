<div class="modal fade" id="refuse{{$order->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <textarea class="form-control" wire:model="refused_reason" placeholder="سبب الرفض ..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3"
                        data-bs-dismiss="modal">إغلاق
                </button>
                <button wire:click="refuse({{$order->id}})" data-bs-dismiss="modal"
                        class="btn btn-primary btn-sm px-3">نعم
                </button>
            </div>
        </div>
    </div>
</div>
