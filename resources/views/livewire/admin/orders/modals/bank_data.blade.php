<div class="modal fade" id="bank_data{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 rounded border d-flex align-items-center gap-2 flex-column fs-6">
                <div class="d-flex align-items-center gap-1">
                    <label for="" class="text-secondary">
                    البنك:
                    </label>
                    {{ $order->bank?->bank_name }}
                </div>
                <div class="d-flex align-items-center gap-1">
                    <label for="" class="text-secondary">
                    رقم الحساب المحول منه:
                    </label>
                    {{ $order->transfer_account_number }}
                </div>
                <a target="_blank" download="" class="btn btn-success" href="{{ display_file($order->transfer_img) }}">تحميل صورة التحويل</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إغلاق
                </button>
            </div>
        </div>
    </div>
</div>
