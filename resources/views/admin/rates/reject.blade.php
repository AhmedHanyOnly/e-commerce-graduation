<div class="modal fade" id="reject{{ $rate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">رفض التعليق</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
{{--                <div class="form-group">--}}
{{--                    <label for="">سبب الرفض</label>--}}
{{--                    <textarea class="form-control" wire:model='reject_reason' id="" cols="30" rows="10"></textarea>--}}
{{--                </div>--}}
                هل انت متاكد من الرفض ؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" wire:click='reject({{ $rate->id }})' data-bs-dismiss="modal" class="btn btn-danger">رفض</button>
            </div>
        </div>

    </div>
</div>
</div>
