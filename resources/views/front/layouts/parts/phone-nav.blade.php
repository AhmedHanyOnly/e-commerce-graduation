    <!-- Start nav-phone -->
    <header class="phone-header d-lg-none not-print">
        <nav class="phone-nav py-2">
            <div class="container d-flex flex-column gap-2">
                <div class="nav-content">
                    <div class="d-flex align-items-center gap-3">
                        <button class="navbar-toggler" data-bs-theme="dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        @auth
                        <div class="btn-group btn-cart mt-2">
                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="icon-holder bg-white">
                                <span class="count">{{ auth()->user()->notifications->whereNull('seen_at')->count() }}</span>
                                <i class="fa-regular fa-bell" fill="var(--main-color)"></i>
                            </button>
                            <ul class="dropdown-menu notice-menu">
                                @if (auth()->user())
                                @forelse (auth()->user()->notifications()->orderByDesc('created_at')->get() as $notification)
                                <li>
                                    <a class="dropdown-item" href="{{ route('notice') }}">
                                        <div class="avatar">
                                            <img src="{{ auth()->user()->image? display_file(auth()->user()->image) : asset('admin-asset/img/no-image.jpeg') }}" alt="" />
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
                        @endauth
                        @livewire('components.cart-icon')
                    </div>
                    <div class="offcanvas offcanvas-start" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header d-felx align-items-center justify-content-between">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1">
                                @auth
                                <li class="nav-item nav-img text-center">
                                    <img src="{{ auth()->user()->image ? display_file(auth()->user()->image) : asset('front-asset/img/user.webp') }}" class=" img-user" alt="img">
                                    <h5>{{ auth()->user()->name}}</h5>
                                    <h6>{{ auth()->user()->email}}</h6>
                                </li>
                                @endauth
                                @guest
                                <a href="{{route('login')}}" class="main-btn w-100 mb-1">{{ __('Log in') }}</a>
                                <a href="{{route('register')}}" class="main-btn w-100 mb-3">{{ __('membership registration') }}</a>
                                @endguest
                                @auth

                                <li class="nav-item">
                                    <a class="nav-link {{request()->routeIs('home')? "active":""}}" href="{{route('home')}}">{{ __('Home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{request()->routeIs('orders')? "active":""}}" href="{{route('orders')}}">{{ __('Orders') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{request()->routeIs('favorites.index')? "active":""}}" href="{{route('favorites.index')}}">{{ __('Favorites') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{request()->routeIs('products')? "active":""}} " href="{{route('products')}}">{{ __('Products') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{request()->routeIs('profile')? "active":""}}" href="{{route('profile')}}">{{ __('Profile') }}</a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{route('logout')}}" method="POST" id="logout-form">
                                        @csrf
                                        <button type="submit" class="nav-link red w-100 ">{{ __('Logout') }}</button>
                                    </form>
                                </li>
                                @endauth
                                <li class="nav-item d-flex flex-column gap-2 mt-3">
                                    <div class="info">
                                        <a href="tel:{{ setting('phone') }}" class="contact pb-2">
                                            <i class="fa-solid fa-phone icon"></i>
                                            <div class="text">
                                                <div class="title">{{ __('Contact us') }}</div>
                                                <div class="desc">{{setting('phone')}}</div>
                                            </div>
                                        </a>
                                        <a href="mailto:{{setting('email')}}?subject=Mail from Our Site" class="contact pb-2">
                                            <i class="fa-solid fa-envelope icon"></i>
                                            <div class="text">
                                                <div class="title">{{ __('E-Mail Address') }}</div>
                                                <div class="desc">{{setting('email')}}</div>
                                            </div>
                                        </a>
                                    </div>
                                    <ul class="social-list justify-content-center">
                                        <li>
                                            <a href="{{ setting('facebook') }}" class="btn-link-social" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ setting('instagram') }}" class="btn-link-social" target="_blank"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ setting('snapchat') }}" class="btn-link-social" target="_blank"><i class="fab fa-youtube"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ setting('twitter') }}" class="btn-link-social" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                                                    <path d="M 5.9199219 6 L 20.582031 27.375 L 6.2304688 44 L 9.4101562 44 L 21.986328 29.421875 L 31.986328 44 L 44 44 L 28.681641 21.669922 L 42.199219 6 L 39.029297 6 L 27.275391 19.617188 L 17.933594 6 L 5.9199219 6 z M 9.7167969 8 L 16.880859 8 L 40.203125 42 L 33.039062 42 L 9.7167969 8 z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://api.whatsapp.com/send?phone={{ setting('whatsapp') }}" class="btn-link-social" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="{{route('home')}}" class="logo">
                        <img src="{{setting('logo')!='' ? display_file(setting('logo')) : asset('front-asset/img/logo-white.svg')}}" alt="" class="logo" />
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <script>
        const phoneHeader = document.querySelector(".phone-header");
        if (phoneHeader) {
            window.addEventListener("scroll", () => {
                const headerHeight = phoneHeader.offsetHeight;
                const scrollPosition = window.scrollY;

                if (scrollPosition > headerHeight) {
                    phoneHeader.classList.add("scroll");
                } else {
                    phoneHeader.classList.remove("scroll");
                }
            });
        }
    </script>
    <!-- End phone nav -->
