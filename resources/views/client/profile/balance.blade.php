<div class="col-content col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <h1 class="title-color">
        محفظتي
    </h1>
    <div class="btn-holder d-flex align-items-center justify-content-end gap-1 flex-wrap mb-2">
        {{-- <button type="button" class="btn-main grey sm px-4">سحب رصيد </button> --}}
        <button type="button" class="btn-main btn  sm px-4" data-bs-toggle="modal" data-bs-target="#topUpModal">شحن رصيد
        </button>
        <!-- نافذة الحوار -->
        <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between ">
                        <h5 class="modal-title" id="topUpModalLabel">قم بتعبئة رصيدك</h5>
                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- نموذج شحن الرصيد -->
                        <input type="hidden" name="_token" value="" autocomplete="off">
                        <div class="mb-3">
                            <label for="topUpAmount" class="form-label">أدخل المبلغ المراد اضافته للرصيد</label>
                            <input type="number" min="0" class="form-control" wire:model="amount">
                        </div>
                        <div class="d-flex justify-content-end ">
                            <button wire:click="add_balance" data-bs-dismiss="modal" class="btn btn-success">شحن</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-content mb-3">
        <div class="items items-money">
            <div class="item item-1">
                <div class="title gray sm">
                    الرصيد القابل للسحب </div>
                <div class="price">
                    {{$user->balance}} <span> {{setting('currency')}}</span>
                </div>
            </div>
            <div class="item item-2">
                <div class="title gray sm">
                    الرصيد المتاح </div>
                <div class="price">
                    {{$user->balance}} <span> {{setting('currency')}}</span>
                </div>
            </div>

        </div>
    </div>
    <div class="content_view border-0">
        <div class="content_header">
            <div class="title fs-13px fw-bold mb-3">
                <i class="fas fa-money-bill-transfer fs-13px main-color"></i>
                سجل المعاملات
            </div>
        </div>
        <div class="tab-content border-0 p-0">
            <div class="row g-3">
                @foreach($transactions as $transaction)
                <div class="col-12">
                    <div class="card box-transaction">
                        <div class="card-amount">
                            {{$transaction->amount}} {{setting('currency')}}
                        </div>
                        <div class="card-body">
                            <div class="info-holder">
                                <p class="card-text mb-0 fs-13px">
                                    كود العملية: {{$transaction->id}}
                                </p>
                                <p class="card-text mb-0 fs-13px">
                                    الرصيد بعد العملية: {{$transaction->balance_after_action}}
                                </p>
                                <p class="card-text mb-0 fs-13px">
                                    في تاريخ: <small class="color-a7 fs-10px">
                                        {{return_diff_for_humans($transaction->created_at)}}</small>
                                    <small class="color-a7 fs-13px">|</small>
                                    <small class="color-a7 fs-10px">{{$transaction->created_at->format('Y-m-d')}}</small>
                                </p>
                                <p class="card-text mb-0 fs-13px">
                                    نوع العملية:: {{$transaction->is_add ? 'ايداع' :'سحب'}}
                                </p>
                                <p class="card-text mb-0 fs-13px">
                                    حالة العملية: مكتملة
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            {{$transactions->links()}}
        </div>
    </div>
</div>