<div class="modal fade" id="delete{{$slider->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف السلايدر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    هل أنت متأكد من حذف سلايدر؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-3 btn-sm" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary px-3 btn-sm" data-bs-dismiss="modal" wire:click="delete({{$slider->id}})">نعم</button>
                </div>
        </div>
    </div>
</div>
