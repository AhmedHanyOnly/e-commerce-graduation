<div class="main-side">
    <x-message-admin />
    @if($screen == 'index')
    <div class="main-title">
        <div class="small">
            @lang("Home")
        </div>
        <div class="large">
            المقاسات
        </div>
    </div>
    <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <div class="btn-holder">
            <button wire:click="$set('screen','create')" class="main-btn">@lang("Add") <i class="fas fa-plus"></i></button>
        </div>
        <div class="holder-inp-btn d-flex align-items-center gap-1">
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
            <input type="search" wire:model.live="search" placeholder="بحث" />
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sizes as $size)

                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$size->name}}</td>
                    <td>{{$size->active ? 'مفعل' : 'غير مفعل'}}</td>
                    <td class="">
                        <div class="d-flex align-items-center gap-3">
                            <a wire:click="edit({{$size->id}})" class="">
                                <i class="fa-solid fa-pen text-info icon-table"></i>
                            </a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$size->id}}">
                                <i class="fa-solid fa-trash text-danger icon-table"></i>
                            </button>
                        </div>
                        @include('deleteModal',['item' => $size])
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
        {{$sizes->links()}}
    </div>
    @else
    @include('livewire.admin.sizes.createOrUpdate')
    @endif
</div>