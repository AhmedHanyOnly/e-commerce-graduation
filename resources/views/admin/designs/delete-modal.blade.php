<div class="modal fade" id="delete{{$product->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">حذف مقال</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          هل أنت متأكد من حذف المنتج
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إلغاء</button>
          <button  wire:click="delete({{$product->id}})" data-bs-dismiss="modal" class="btn btn-primary btn-sm px-3">نعم</button>
        </div>
    </div>
  </div>
</div>
