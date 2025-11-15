<div class="modal fade" id="reject{{ $product->id }}" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">رفض منتج</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من رفض المنتج ؟

                <div class="form-group">
                    <label for="">سبب الرفض</label>
                    <textarea wire:model="rejected_reason" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إلغاء</button>
                <button wire:click="reject({{ $product->id }})" data-bs-dismiss="modal"
                    class="btn btn-primary btn-sm px-3">نعم</button>
            </div>
        </div>
    </div>
</div>
