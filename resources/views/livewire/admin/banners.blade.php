<div class="main-side">
    <x-message-admin/>
    @if($screen == 'index')
        <div class="main-title">
            <div class="small">
               @lang("Home")
            </div>
            <!-- <div class="form-check form-switch">
                تفعيل البانر الافتراضى
                                    <input class="form-check-input" type="checkbox" role="switch" id=""
                                        wire:click='toggleDefaultBanner' @checked($defaultBanner)>
                                </div> -->
            <div class="large">

            </div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder">
                <button wire:click="$set('screen','create')" class="main-btn">@lang("Add") <i
                        class="fas fa-plus"></i></button>
            </div>
            <div class="holder-inp-btn d-flex align-items-center gap-1">
                <div class="box-search">
                    <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon"/>
                    <input type="search" id="" placeholder="بحث"/>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                <tr>
                    <th>#</th>
                    <th>بانر علوى</th>
                    <th>بانر اسفل</th>
                    <th>الحاله</th>
                    <th>العمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $banners as $banner)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <img src="{{ $banner->image_one ? display_file($banner->image_one) : asset('admin-asset/img/image-preview.webp') }}" alt="" width="100px">
                    </td>
                    <td>
                        <img src="{{ $banner->image_two ? display_file($banner->image_two) : asset('admin-asset/img/image-preview.webp') }}" alt="" width="100px">
                    </td>
                    {{-- <td>
                        {{ $banner->status ? 'مفعل' : 'غير مفعل' }}
                    </td> --}}
                    <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id=""
                                        wire:click='toggle({{ $banner->id }})' @checked($banner->status)>
                                </div>
                            </td>

                        <td class="">
                            <div class="d-flex align-items-center gap-3">
                                <a href="#" wire:click="edit({{ $banner->id }})" class="">
                                    <i class="fa-solid fa-pen text-info icon-table"></i>
                                </a>
                               
                                <button type="button" class="" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $banner->id }}">
                                        <i class="fa-solid fa-trash text-danger icon-table"></i>
                                    </button>
                            </div>
                             @include('admin.banners.delete-modal')
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            {{ $banners->links() }}
        </div>
    @else
        @include('admin.banners.createOrUpdate')
    @endif
</div>
