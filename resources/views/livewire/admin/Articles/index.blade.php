<div class="main-side">
    <x-message-admin />
    @if($screen == 'index')
    <div class="main-title">
        <div class="small">
            @lang("Home")
        </div>
        <div class="large">
            @lang("admin.Articles")
        </div>
    </div>
    <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
        <div class="btn-holder">
            <a href="{{route('admin.articles.create')}}" class="main-btn">@lang("Add") <i class="fas fa-plus"></i></a>
        </div>
        <div class="holder-inp-btn d-flex align-items-center gap-1">
            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" id="" placeholder="بحث" />
            </div>
            <a href="{{ route('admin.articles-categories.index') }}" wire:navigate class="main-btn btn-main-color">@lang("admin.Article sections") <i class="fas fa-arrow-left-long rotate-arrow"></i></a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="main-table mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang("Address")</th>
                    {{-- <th>@lang('admin.The categorie')</th> --}}
                    <th>@lang("Image")</th>
                    <th>@lang("Status")</th>
                    <th>@lang("Actions")</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$article->title}}</td>
                    {{-- <td>{{$article->category?->name}}</td> --}}
                    <td>
                        @if(!$article->image)
                        <img src="{{ asset('admin-asset/img/no-image.jpeg') }}" alt="" class="img-thumbnail img-preview" width="50">
                        @else
                        <img src="{{ display_file($article->image) }}" alt="" class="img-thumbnail img-preview" width="50">
                        @endif
                    </td>
                    <td>{{$article->active ?'مفعل': 'غير مفعل'}}</td>
                    <td class="">
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{route('admin.articles.edit' ,$article)}}" class="">
                                <i class="fa-solid fa-pen text-info icon-table"></i>
                            </a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$article->id}}">
                                <i class="fa-solid fa-trash text-danger icon-table"></i>
                            </button>
                            @include('livewire.admin.Articles.delete-modal')
                        </div>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
        {{$articles->links()}}
    </div>
    @else
    @include('livewire.admin.Articles.createOrUpdate')
    @endif
</div>