<div class="main-side">
    <div class="main-title">
        <div class="small">@lang("Home")</div>
        <div class="large">القوائم</div>
    </div>
    {{-- @dump($collapse) --}}
    <div id="collapse-add" class="collapse {{ $collapse ? 'fade show' : '' }} mb-4">
        <div class="issue-main-info">
            <div class="content-header">
                اضف عنصر قائمة جديد
                <a data-bs-toggle="collapse" wire:click="$set('collapse',0)" href="#collapse-add" aria-expanded="false" class="main-btn btn-main-color">
                    إغلاق <i class="fas fa-minus"></i>
                </a>
            </div>
            <div class="container">
                <x-admin-alert></x-admin-alert>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>@lang("Address")</span>
                        <div class="box-input">
                            <input type="text" wire:model.defer='name' id="" />
                        </div>
                    </label>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-label" for="tax">
                        موقعه في القائمة</label>
                    <select wire:model.defer='location' id="tax" class="form-select select-setting">
                        <option value="">اختيار الموقع</option>
                        <option value="header">الهيدر</option>
                        <option value="footer">الفوتر</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-label" for="tax">
                        صفحة او رابط</label>
                    <select wire:model.debounce='page_id' id="tax" class="form-select select-setting">
                        <option value="">اختر نوع الرابط</option>
                        <option value="0">رابط</option>
                        @foreach ($pages as $page)
                        <option value="{{ $page->id }}">{{ $page->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if($page_id == '0')
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الرابط</span>
                        <div class="box-input">
                            <input type="link" wire:model.defer="url" id="" />
                        </div>
                    </label>
                </div>
                @endif
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-label" for="tax">
                        عنصر القائمة الاب </label>
                    <select wire:model.defer='parent' id="tax" class="form-select select-setting">
                        <option value="">إختار عنصر اب</option>
                        @foreach ($menus as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="button" wire:click='submit' class="main-btn"> @lang("Save")</button>
            </div>
        </div>
    </div>
    <div class="issue-main-info">
        <div class="bar-obtions d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a data-bs-toggle="collapse" href="#collapse-add" wire:click='$toggle("collapse")' aria-expanded="false" class="main-btn btn-main-color">
                    @lang("Add") <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <div class="box-search">
                <img src="{{asset('admin-asset/img/icons/search.png')}}" alt="icon" />
                <input type="search" wire:model.live="search" id="" placeholder="بحث" />
            </div>
        </div>
        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang("Address")</th>
                        <th>الموقع</th>
                        <th>الرابط</th>
                        <th>العنصر الاب</th>
                        <th>@lang("Actions")</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allMenus as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->location }}</td>
                        <td>{{ $item->page_id ? $item->page_id : $item->url }}</td>
                        <td>{{ $item->parent }}</td>
                        <td>
                            <div class="btn-holder d-flex align-items-center gap-3">
                                <button type="button" wire:click='edit({{ $item->id }})'>
                                    <i class="fas fa-pen text-info icon-table"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                                    <i class="fas fa-trash text-danger icon-table"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
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
                                    <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $item->id }})'>حذف</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan='6'>
                            <div class="alert alert-warning">
                                @lang("No results")
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>