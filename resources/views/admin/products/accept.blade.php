<div class="modal fade" id="accept{{ $product->id }}" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">قبول منتج</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من قبول المنتج ؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إلغاء</button>
                <button wire:click="accept({{ $product->id }})" data-bs-dismiss="modal"
                    class="btn btn-primary btn-sm px-3">نعم</button>
            </div>
        </div>
    </div>
</div>
