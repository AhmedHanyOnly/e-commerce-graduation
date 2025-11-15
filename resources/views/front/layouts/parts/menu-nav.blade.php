<nav class="menu-nav d-none d-lg-block not-print">
    <div class="container">
        @php
$main_categories = \App\Models\Category::active()
    ->whereNull('parent_id')
    ->whereHas('children')   
    ->get();
        @endphp
        <div class="d-flex justify-content-between align-items-center">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                @foreach ($main_categories as $main)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products', ['category_id' => $main->id]) }}">
                            {{ $main->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a class="main-btn white" href="{{ route('contact') }}">{{ __('Contact us') }}</a>
        </div>
    </div>
</nav>
