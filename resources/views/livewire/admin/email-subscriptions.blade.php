<div class="main-side">
    <x-message-admin/>
    @if($screen == 'index')
        <div class="main-title">
            <div class="small">
                الرئيسية
            </div>
            <div class="large">
             القائمة البريدية
            </div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder">
                <a wire:click="$set('screen','create')" class="main-btn">إضافة <i class="fas fa-plus"></i></a>
            </div>
            <div class="holder-inp-btn d-flex align-items-center gap-1">
                <div class="box-search">
                    <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon"/>
                    <input type="search" wire:model.live="search" placeholder="بحث"/>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                <tr>
                    <th>#</th>
                    <th>الايميل</th>
                    <th>العمليات</th>

                </tr>
                </thead>
                <tbody>
                @foreach($mails as $mail)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$mail->email}}</td>

                        <td class="">
                            <div class="d-flex align-items-center gap-3">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$mail->id}}">
                                    <i class="fa-solid fa-trash text-danger icon-table"></i>
                                </button>
                                <div class="modal fade" id="delete{{$mail->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">حذف مقال</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                هل أنت متأكد من حذف المقال
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إلغاء</button>
                                                <button  wire:click="delete({{$mail->id}})" data-bs-dismiss="modal" class="btn btn-primary btn-sm px-3">نعم</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            {{$mails->links()}}
        </div>
    @else
        @include('livewire.admin.Articles.createOrUpdate')
    @endif
</div>
