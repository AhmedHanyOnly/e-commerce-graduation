<div class="main-side">
    @if ($screen == 'index')
    <x-admin-alert></x-admin-alert>
<div class="d-flex align-items-center flex-column flex-xl-row justify-content-between gap-3 mb-3">
    <div class="main-title mb-0 me-auto me-xl-0">
        <div class="small">@lang('admin.Home')</div>
        <div class="large">@lang('admin.Main sections')</div>
    </div>

    <div class="box-search">
        <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
        <input type="search" wire:model.live="search" placeholder="@lang('admin.Search')" />
    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1">
            <button class="main-btn" wire:click='$set("screen","create")'>@lang('admin.Add')</button>
        </div>
        <div class="btn-holder d-flex align-items-center gap-1">
            <a href="{{ route('admin.sub-categories') }}" wire:navigate class="main-btn btn-main-color">
                @lang('admin.Sub sections') <i class="fas fa-arrow-left-long"></i>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('admin.Photo')</th>
                    <th>@lang('admin.Main section')</th>
                    <th>@lang('admin.Status')</th>
                    <th>@lang('admin.Sub sections')</th>
                    <th>@lang('admin.Date created')</th>
                    <th>@lang('admin.Actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <img src="{{ $category->cover ? display_file($category->cover) : asset('admin-asset/img/image-preview.webp') }}"
                             alt="{{ $category->name }}"
                             style="max-width: 50px; max-height: 50px;">
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @lang($category->status == 1 ? 'admin.Active' : 'admin.Inactive')
                    </td>
                    <td>
                        <a href="{{ route('admin.sub-categories.index', ['parent_id' => $category->id]) }}" class="main-btn btn-orange">
                            {{ $category->children->count() }}
                        </a>
                    </td>
                    <td>{{ $category->created_at() }}</td>
                    <td>
                        <div class="btn-holder d-flex align-items-center gap-3">
                            <button type="button" wire:click='edit({{ $category->id }})'>
                                <i class="fas fa-pen text-info icon-table"></i>
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}">
                                <i class="fas fa-trash text-danger icon-table"></i>
                            </button>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete-category-{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">@lang('admin.Delete')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">@lang('admin.Are you sure you want to delete?')</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                                                @lang('admin.Cancel')
                                            </button>
                                            <button data-bs-dismiss="modal" class="btn btn-danger btn-sm px-3" wire:click='delete({{ $category->id }})'>
                                                @lang('admin.Delete')
                                            </button>
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
                        <div class="alert alert-warning mb-0">@lang('admin.No results')</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>


    @else
    <x-admin-alert></x-admin-alert>
    @include('livewire.admin.categories.createOrUpdate')
    @endif
    </div>
