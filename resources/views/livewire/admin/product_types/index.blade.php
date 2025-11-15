<div class="main-side">
    @if ($screen == 'index')
        <x-admin-alert></x-admin-alert>
        <div class="d-flex align-items-center flex-column flex-xl-row justify-content-between gap-3 mb-3">
            <div class="main-title mb-0 me-auto me-xl-0">
                <div class="small">@lang('Home')</div>
                <div class="large">@lang('admin.product_types')</div>
            </div>
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" wire:model.live="search" id="" placeholder="@lang('admin.Search')" />
            </div>
        </div>
        <div class="tab-content">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
                <div class="bar-options d-flex align-items-center justify-content-start flex-wrap gap-1">
                    @can('create_product_types')
                        <button class="main-btn" wire:click='$set("screen","create")'>@lang('Add')</button>
                    @endcan
                </div>
            </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('Name') </th>
                        <th>@lang('Photo') </th>
                        <th>@lang('Status')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product_types as $type)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $type->name }}</td>
                        <td class="">
                            @if ($type->image)
                            <img src="{{ display_file($type->image) }}" alt="{{ $type->name }}" style="max-width: 50px; max-height: 50x;">
                            @else
                            <img src="{{ asset('admin-asset/img/image-preview.webp') }}" alt="{{ $type->name }}" style="max-width: 50px; max-height: 50x;">
                            @endif
                        </td>
                        <td>
                            @if ($type->status == 1)
                            @lang('Active')
                            @else
                            غير مفعل
                            @endif
                        </td>

                        <td>
                            <div class="btn-holder d-flex align-items-center gap-3">
                                @can('update_product_types')
                                <button type="button" wire:click='edit({{ $type->id }})'>
                                    <i class="fas fa-pen text-info icon-table"></i>
                                </button>
                                @endcan
                                @can('delete_product_types')
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete" wire:click="itemId({{ $type->id }})">
                                    <i class="fas fa-trash text-danger icon-table"></i>
                                </button>
                                @endcan

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan='10'>
                            <div class="alert alert-warning mb-0">
                                @lang('No results')
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @can('delete_product_types')
            @include('livewire.admin.product_types.delete-modal')
            @endcan
            {{ $product_types->links() }}
        </div>
    </div>
    @else
    @if (auth()->user()->can('update_product_types') || auth()->user()->can('create_product_types'))
    <x-admin-alert></x-admin-alert>
    @include('livewire.admin.product_types.form')
    @endif
    @endif
</div>
