<div wire:ignore.self class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between ">
                <h1 class="modal-title fs-5" id="exampleModalLabel">يرجي وضع تقييمك لطلبك</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 justify-content-center mb-4">
                    <i wire:click="$set('rate',1)"
                       class="fa-{{ $rate >= 1 ? 'solid' : 'regular' }} fa-star text-warning fs-3"></i>
                    <i wire:click="$set('rate',2)"
                       class="fa-{{ $rate >= 2 ? 'solid' : 'regular' }} fa-star text-warning fs-3"></i>
                    <i wire:click="$set('rate',3)"
                       class="fa-{{ $rate >= 3 ? 'solid' : 'regular' }} fa-star text-warning fs-3"></i>
                    <i wire:click="$set('rate',4)"
                       class="fa-{{ $rate >= 4 ? 'solid' : 'regular' }} fa-star text-warning fs-3"></i>
                    <i wire:click="$set('rate',5)"
                       class="fa-{{ $rate >= 5 ? 'solid' : 'regular' }} fa-star text-warning fs-3"></i>

                </div>
                <textarea wire:model="comment" class="form-control" rows="2" placeholder="يرجي وضع تعليقك علي الطلب"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                {{-- <button wire:click="add_rate({{$order->id}},{{$type}})" class="btn btn-success" data-bs-dismiss="modal">حفظ</button> --}}
                <button wire:click="add_rate({{$order}})"
                class="btn btn-success btn-sm px-3"
                data-bs-dismiss="modal">تقييم </button>
            </div>
        </div>
    </div>
</div>
