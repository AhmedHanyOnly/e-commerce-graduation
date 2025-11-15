<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">ارسال للبريد الالكتروني</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-message-admin />
                <div class="row">
                    <div class="col-sm-12">
                        <label class="small-label" for="">الرساله</label>
                        <textarea wire:model.defer="message"  class="form-control"></textarea>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">الغاء</button>
                <button type="button" class="btn btn-sm btn-success" wire:click="submit">ارسال <i
                        class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
