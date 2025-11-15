<nav class="navbar bottom-nav navbar-expand-lg d-none d-lg-block not-print">
    <div class="container gap-5">
        <a href="{{ route('home') }}" class="logo">
            <img
                src="{{ setting('logo') != '' ? display_file(setting('logo')) : asset('front-asset/img/logo-white.svg') }}"
                alt="" class="logo"/>

        </a>
        <div class="inp-search"></div>
               {{-- <div class="inp-search">--}}
        {{--            <input type="text" class="form-control" name="" id=""--}}
        {{--                placeholder="{{ __('Search word') }}" />--}}
        {{--            <img src="/images/search.svg" class="search" alt="" />--}}
        {{--        </div> --}}

        @auth
            <div class="btn-nav-holder">
                <div class="dropdown">
                    <a class="btn-toggle d-flex gap-2 align-items-center" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img
                            src="{{ auth()->user()->image ? display_file(auth()->user()->image) : asset('front-asset/img/user.webp') }}"
                            alt="">
                    </a>
                    <ul class="dropdown-menu user-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('orders') }}">
                                <i class="fa-solid fa-box-archive text-secondary"></i>
                                {{ __('Orders') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('favorites.index') }}">
                                <i class="fa-regular fa-star text-secondary"></i>
                                {{ __('Favorites') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fa-regular fa-circle-user ms-1 text-secondary "></i>
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fa-solid fa-right-from-bracket text-danger ms-1 "></i>
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <div class="btn-group  mt-2">
                    <button class="btn-cart bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="icon-holder">
                            <span class="count">
                                {{ auth()->user()->notifications->whereNull('seen_at')->count() }}
                            </span>
                            <i class="fa-regular fa-bell"></i>
                        </div>
                    </button>
                    <ul class="dropdown-menu notice-menu">
                        @if (auth()->user())
                            @forelse (auth()->user()->notifications()->orderByDesc('created_at')->get() as $notification)
                                <li>
                                    <a class="dropdown-item" href="{{ route('notice') }}">
                                        <div class="avatar">
                                            <img
                                                src="{{ auth()->user()->image ? display_file(auth()->user()->image) : asset('admin-asset/img/no-image.jpeg') }}"
                                                alt=""/>
                                        </div>
                                        <div class="text">
                                            <div class="desc"> {!! $notification->title !!}</div>
                                            <div class="date">
                                                <i class="fa-regular fa-clock"></i>
                                                {{ $notification->created_at?->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="p-2 text-center">{{ __('No unread notifications') }}</li>
                            @endforelse
                        @endif
                    </ul>
                </div>
            </div>
        @endauth

        @livewire('components.cart-icon')

        @guest
            <div class="btn-nav-holder gap-3">
                <a href="{{ route('login') }}" class="main-btn text-light">
                    {{ __('Login') }}
                </a>
                @if(setting('client_registration'))
                <a href="{{ route('register') }}" class="main-btn white">
                    {{ __('Create an account') }}
                </a>
                @endif
            </div>
        @endguest

        @auth
            @if (auth()->user()->type == 'admin')
                <a href="{{ route('admin.home') }}" class="main-btn text-light">
                    {{ __('Dashboard') }}
                </a>
            @endif
        @endauth
    </div>
</nav>
