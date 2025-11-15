<div class="main-side">
    <x-admin-alert />
    @if ($screen == 'index')
        <div class="main-title">
            <div class="small">
                @lang('Home')
            </div>
            <div class="large">
                السلايدر
            </div>
        </div>

        @if (setting('is_slider_active') == 0)
            <div class="alert alert-warning">السلايدر غير مفعل</div>
        @endif

        <div class="btn-holder d-flex align-items-center gap-1 flex-wrap mb-2">
            <div class="btn-holder">
                <a wire:click="$set('screen','create')" class="main-btn">@lang('Add')</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('Address')</th>
                        <th>@lang('Address') الثانى</th>
                        {{-- <th>@lang("Status")</th> --}}
                        <th>@lang('Image')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->subtitle }}</td>
                            {{-- <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id=""
                                        wire:click='toggle({{ $slider->id }})' @checked($slider->status)>
                                </div>
                            </td> --}}
                            <td>
                                @if ($slider->cover)
                                    <img src="{{ display_file($slider->cover) }}" class="img-thumbnail img-preview"
                                        alt="slider img" width="50">
                                @else
                                    <img src="{{ asset('admin-asset/img/image-preview.webp') }}"
                                        class="img-thumbnail img-preview" alt="slider img" width="50">
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="#" wire:click="edit({{ $slider->id }})" class="">
                                        <i class="fa-solid fa-pen text-info icon-table"></i>
                                    </a>
                                    <button type="button" class="" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $slider->id }}">
                                        <i class="fa-solid fa-trash text-danger icon-table"></i>
                                    </button>
                                </div>
                                @include('admin.sliders.delete-modal')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $sliders->links() }}
        </div>
    @else
        @include('admin.sliders.createOrUpdate')
    @endif
</div>
