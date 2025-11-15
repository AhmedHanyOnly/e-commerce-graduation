<div class="main-side">
    <x-admin-alert />
    @if($screen =='index')
    <div class="main-title">
        <a href="{{url()->previous()}}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-chevron-right"></i></a>
        <div class="small">
            @lang("Home")
        </div>
        <div class="large">
            @lang("admin.Article sections")
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
                    <th>@lang("Actions")</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$cat->name}}</td>
                    <td>
                        <img src="{{ $cat->image ? display_file($cat->image):asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="50">
                    </td>
                    <td class="">
                        <div class="d-flex align-items-center gap-3">
                            <a wire:click="edit({{$cat->id}})" class="">
                                <i class="fa-solid fa-pen text-info icon-table"></i>
                            </a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$cat->id}}">
                                <i class="fa-solid fa-trash text-danger icon-table"></i>
                            </button>
                            @include('admin.articles-categories.delete-modal')
                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {{$categories->links()}}
    </div>
    @else
    @include('admin.articles-categories.createOrUpdate')
    @endif
</div>