@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="main-title">
            <div class="small">
                @lang("Home")
            </div>
            <div class="large">
                رسائل صور
            </div>
        </div>
        <div class="btn-holder">
            <a href="{{ route('imageMessage.create') }}" class="main-btn">@lang("Add") <i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>@lang("Content")</th>
                    <th>المرفق</th>
                    <th>@lang("Actions")</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        محتوي نصي من النوع المتوسط الي الكبير لتجربة حجم النص و شكل عرضه
                    </td>
                    <td>
                        <button class="btn-light-purple"><i class="fas fa-eye"></i> معاينة المرفق </button>
                    </td>
                    <td>
                        <div class="btn-holder d-flex align-items-center gap-3">
                            <a href="#showModal" data-bs-toggle="modal">
                                <i class="fas fa-eye icon-table"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="showModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="showModalLabel">معاينة رسالة</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th>النحتوي</th>
                                                            <td>محتوي نصي من النوع المتوسط الي الكبير لتجربة حجم النص و شكل عرضه </td>
                                                        </tr>
                                                        <tr>
                                                            <th>المرفق</th>
                                                            <td>
                                                                هنا يظهر المرفق
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button>
                                <i class="fas fa-pen text-info icon-table"></i>
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-trash text-danger icon-table"></i>
                            </button>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" aria-hidden="true">
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
                    <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $user->id }})'>حذف</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection