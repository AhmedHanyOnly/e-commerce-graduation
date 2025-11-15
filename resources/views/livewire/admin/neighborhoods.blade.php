<div class="main-side">
    <div class="d-flex justify-content-between align-items-center">
        <div class="main-title">
            <div class="small">@lang("Home")</div>
            <div class="large">الأحياء</div>
        </div>
        <div class="d-flex align-items-center gap-1">

            <a href="{{ route('admin.cities') }}" class="main-btn btn-main-color" wire:navigate>
                المدن <i class="fa-solid fa-arrow-up-right-from-square fs-15px"></i>
            </a>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="issue-main-info">
                <div class="content-header">
                    اضف حي جديد
                </div>
                <x-admin-alert></x-admin-alert>
                <div class="col-md-12">
                    <label class="small-label" for="">
                        اسم الحي
                        <span class="text-danger">*</span>
                    </label>
                    <div class="box-input">
                        <input type="text" class="form-control" wire:model='name' id="" />
                    </div>
                    <div class="box-input">
                        <label for="">@lang("City")</label>
                        <select wire:model.live="city_id" id="city_id" class="form-control">
                            <option value="">@lang("Select city")</option>
                            @foreach ($select_citites as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="button" wire:click='submit' class="main-btn"> @lang("Save") </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <form action="" class="issue-main-info">
                <div class="content-header">
                    عرض كل الاحياء
                </div>
                <div class="bar-obtions d-flex align-items-center justify-content-end flex-wrap gap-3 mb-4">
                    <div class="box-search">
                        <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                        <input type="search" multiple wire:model.live="search" id="" placeholder="بحث" />
                    </div>
                </div>
                <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
                    <a wire:click="$set('screen','create')" class=""></a>

                </div>
                <div class="table-responsive">
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>إسم الحي</th>
                                <th>المدينة</th>
                                <th>عدد العملاء </th>
                                <th>@lang("Actions")</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($neighborhoods as $neighborhood)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $neighborhood->name }}</td>
                                <td>{{ $neighborhood->city?->name }}</td>
                                <td><a href="{{ route('admin.clients',['neighborhood_id'=> $neighborhood->id ]) }}">{{
                                    $neighborhood->users->count() }} <i class="fa fa-eye"></i></a></td>
                                <td>
                                    <div class="btn-holder d-flex align-items-center gap-3">
                                        <button type="button" wire:click='edit({{ $neighborhood->id }})'>
                                            <i class="fas fa-pen text-info icon-table"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $neighborhood->id }}">
                                            <i class="fas fa-trash text-danger icon-table"></i>
                                        </button>
                                        <div class="modal fade" id="delete{{ $neighborhood->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">حذف</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        هل متاكد من الحذف
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                                        <button wire:click='delete({{ $neighborhood->id }})' type="button" class="btn btn-danger" data-bs-dismiss="modal">نعم</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan='4'>
                                    <div class="alert alert-warning">
                                        @lang("No results")
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $neighborhoods->links() }}

                </div>
            </form>
        </div>
    </div>
</div>