<div class="main-side">
    @if ($screen == 'index')
    <x-admin-alert></x-admin-alert>
    <div class="main-title mb-0 me-auto me-xl-0">
        <a href="{{route('admin.categories')}}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-chevron-right"></i></a>
        <div class="small">@lang("Home")</div>
        <div class="large">@lang("Sub sections")</div>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class=" d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1">
                <button class="main-btn" wire:click='$set("screen","create")'>@lang("Add")</button>
            </div>
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" wire:model.live="search" id="" placeholder="بحث" />
            </div>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang("Image")</th>

                        <th>@lang("Section Name") </th>
                        <th>@lang("Main section") </th>
                        <th>@lang("Status")</th>
                        <th>@lang("Date created")</th>
                        <th>@lang("Actions")</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td class="">
                            @if($category->cover)
                            <img src="{{ display_file($category->cover) }}" alt="{{ $category->name }}" style="max-width: 50px; max-height: 50px;">
                            @else
                            <img src="{{ asset('admin-asset/img/image-preview.webp') }}" alt="{{ $category->name }}" style="max-width: 50px; max-height: 50px;">
                            @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent?->name }}</td>
                        {{-- <td>{{ __($category->status) }}</td> --}}
                        <td>
                            @if ($category->status == 1)
                            @lang("Active")
                            @else
                            غير مفعل
                            @endif
                        </td>
                        <td>{{ $category->created_at()}}</td>

                        <td>
                            <div class="btn-holder d-flex align-items-center gap-3">

                                <!-- Modal -->

                                <button type="button" wire:click='edit({{ $category->id }})'>
                                    <i class="fas fa-edit text-info icon-table"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete-sub-{{ $category->id }}">
                                    <i class="fas fa-trash text-danger icon-table"></i>
                                </button>
                                <div class="modal fade" id="delete-sub-{{ $category->id }}" aria-hidden="true">
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
                                                <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $category->id }})'>حذف</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan='10'>
                            <div class="alert alert-warning mb-0">
                                @lang("No results")
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $categories->links() }}


            <!-- Modal -->
            <div class="modal fade" id="sendToWhatsapp" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="showModalLabel">إرسال رسالة عبر الواتس اب
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea wire:model="message" rows="5" class="form-control"></textarea>

                            <div class="form-group">
                                <label for="">@lang("Photo")</label>
                                <input type="file" wire:model="image" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button wire:click="sendToWhatsapp" type="button" class="btn btn-success btn-sm px-3" data-bs-dismiss="modal">إرسال</button>
                            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <x-admin-alert></x-admin-alert>
    @include('livewire.admin.sub_categories.createOrUpdate')
    @endif
</div>
