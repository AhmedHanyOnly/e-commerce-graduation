<div class="main-side">
    <x-message-admin />
    @if($screen == 'index')
    <div class="main-title">
        <div class="small">
            @lang("Home")
        </div>
        <div class="large">
            تصميم الواجهة
        </div>
    </div>
    <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <div class="btn-holder">
            <a wire:click="$set('screen','create')" class="main-btn">@lang("Add")</a>
        </div>
        <div class="box-search">
            <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
            <input type="search" id="" placeholder="بحث" />
        </div>
    </div>
    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang("Name")</th>
                    <th>@lang("Image")</th>
                    <th>@lang("admin.Description")</th>
                    <th>@lang("Actions")</th>
                </tr>
            </thead>
            <tbody>
                @foreach($designs as $product)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                        @if(!$product->image)
                        <img src="{{ asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="50">
                        @else
                        <img src="{{ display_file($product->image) }}" alt="" class="img-thumbnail img-preview" width="50">
                        @endif
                    </td>
                    <td>{{$product->description}}</td>
                    <td class="">
                        <div class="d-flex align-items-center gap-3">
                            <a wire:click="edit({{$product->id}})" class="">
                                <i class="fa-solid fa-pen text-info icon-table"></i>
                            </a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$product->id}}">
                                <i class="fa-solid fa-trash text-danger icon-table"></i>
                            </button>
                            @include('admin.designs.delete-modal')
                        </div>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    @else
    @include('admin.designs.createOrUpdate')
    @endif
</div>