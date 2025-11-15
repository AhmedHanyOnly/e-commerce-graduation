@section('title', $title)
<section class="main-section py-5">
    <div class="container">

        <div class="row gutters app-profile">
            <div class="col-side col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card card-side  h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile text-center">
                                <div class="user-avatar">
                                    <img src="{{ $user->image ? display_file($user->image) : asset('front-asset/img/image-preview.webp') }}"
                                        alt="">
                                </div>
                                <h5 class="user-name">{{ $user->name }}</h5>
                                <h6 class="user-email">{{ $user->email }}</h6>
                            </div>
                            <div class="card-slide ">
                                <a href="javascript:void(0)" wire:click='$set("screen","profile")'
                                    class="btn-icon justify-content-between d-flex">
                                    {{ __('Edit my data') }}
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="javascript:void(0)" wire:click='$set("screen","orders")'
                                    class="btn-icon justify-content-between d-flex">
                                    {{ __('my orders') }}
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="javascript:void(0)" wire:click='$set("screen","address")'
                                    class="btn-icon justify-content-between d-flex">
                                    {{ __('my address') }}
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            {{-- <div class="card-slide ">
                                <a href="javascript:void(0)" wire:click='$set("screen","balance")' class="btn-icon justify-content-between d-flex">
                                    محفظتي
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="" class="btn-icon justify-content-between d-flex">
                                    أضف رأيك
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div> --}}
                            <div class="card-slide ">
                                <a href="{{ route('contact') }}" class="btn-icon justify-content-between d-flex">
                                    {{ __('Contact us') }}
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card-slide ">
                                <a href="javascript:void(0)" wire:click='$set("screen","ticket.index")'
                                    class="btn-icon justify-content-between d-flex">
                                    {{ __('ticket') }}
                                    <div class="icon">
                                        <i class="fas fa-angle-left"></i>
                                    </div>
                                </a>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                <div class="card-slide ">
                                    @csrf
                                    <button type="submit"
                                        class="btn-icon justify-content-between w-100 text-danger d-flex bg-transparent">
                                        {{ __('Logout') }}
                                        <div class="icon text-danger">
                                            <i class="fas fa-angle-left"></i>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('client.profile.' . $screen)
        </div>
    </div>
</section>


