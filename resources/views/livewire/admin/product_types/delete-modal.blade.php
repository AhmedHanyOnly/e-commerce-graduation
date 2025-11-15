<div class="modal fade" id="delete" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                هل انت متأكد من الحذف؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete'>حذف</button>
            </div>
        </div>
    </div>
</div>
