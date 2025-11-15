<div class="sidebar" wire:ignore.self>
    <div class="tog-active d-none d-lg-block" data-tog="true" data-active=".app">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="list">
        <li class="list-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}">
                <div>
                    <i class="fa-solid fa-grip"></i>
                    @lang('admin.Home')
                </div>
            </a>
        </li>
        <li class="list-item">
            <a href="{{ route('home') }}" target="_blank">
                <div>
                    <i class="fas fa-house"></i>
                    @lang('admin.Visit front page')
                </div>
            </a>
        </li>
        @can('read_notifications')

        <li class="list-item {{ request()->routeIs('admin.notifications.index') || request()->routeIs('admin.library.index') ? 'active' : 'false' }}">
            <a data-bs-toggle="collapse" href="#Notifications" aria-expanded="
          {{ request()->routeIs('admin.notifications.index') || request()->routeIs('admin.library.index') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-bell"></i>
                    @lang('admin.Notifications')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div wire:ignore.self id="Notifications" class="collapse item-collapse
      {{ request()->routeIs('admin.notifications.index') || request()->routeIs('admin.library.index') ? 'show' : '' }}
  ">
            <li class="list-item {{ request()->routeIs('admin.notifications.index') ? 'active' : '' }}">
                <a href="{{ route('admin.notifications.index') }}">
                    <div>
                        <i class="fa-solid fa-bell"></i>
                        @lang('admin.Notifications')
                    </div>
                </a>
            </li>
            <li class="list-item {{ request()->routeIs('admin.library.index') ? 'active' : '' }}">
                <a href="{{ route('admin.library.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-envelope-open-text"></i>
                        @lang('admin.Notifications Library')
                    </div>
                </a>
            </li>
        </div>
        @endcan
        <!-- <li class="list-item {{ request()->routeIs('admin.bank-accounts') || request()->routeIs('admin.settings', ['screen' => 'gateways']) ? 'active' : '' }}">
            <a data-bs-toggle="collapse" href="#money" aria-expanded="{{ request()->routeIs('admin.bank-accounts') || request()->routeIs('admin.settings', ['screen' => 'gateways']) ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-money-bill icon"></i>
                    @lang('admin.FinancialManagement')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="money" class="collapse item-collapse {{ request()->routeIs('admin.bank-accounts') || request()->routeIs('admin.settings', ['screen' => 'gateways']) ? 'show' : '' }}">
            <li class="list-item {{ request()->routeIs('admin.bank-accounts') ? 'active' : '' }}">
                <a href="{{ route('admin.bank-accounts') }}" class="">
                    <div>
                        <i class="fa-solid fa-bank"></i>
                        @lang('admin.BankAccounts')
                    </div>
                </a>
            </li>

        </div> -->

        @can('read_settings')
        <li class="list-item {{ request()->routeIs('admin.settings') || request()->routeIs('admin.faqs.index') ? 'active' : '' }}">
            <a data-bs-toggle="collapse" href="#settings" aria-expanded="{{ request()->routeIs('admin.settings') || request()->routeIs('admin.faqs.index') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-gear icon"></i>
                    @lang('admin.Settings')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="settings" class="collapse item-collapse {{ request()->routeIs('admin.settings') || request()->routeIs('admin.faqs.index') ? 'show' : '' }}">
            <li class="list-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}" class="">
                    <div>
                        <i class="fa-solid fa-gear icon"></i>
                        @lang('admin.Settings')
                    </div>
                </a>
            </li>
            <li class="list-item {{ request()->routeIs('admin.faqs.index') ? 'active' : '' }}">
                <a href="{{ route('admin.faqs.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-layer-group"></i>
                        @lang('admin.Faq')
                    </div>
                </a>
            </li>

        </div>
        @endcan
        @can('read_users')
        <li class="list-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <a href="{{ route('admin.users') }}" class="">
                <div>
                    <i class="fas fa-user-tie"></i>
                    @lang('admin.Moderators')
                </div>
            </a>
        </li>
        @endcan
        <li class="list-item {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
            <a href="{{ route('admin.categories') }}" class="">
                <div>
                    <i class="fa-solid fa-list"></i>
                    @lang('admin.SiteCategories')
                </div>
            </a>
        </li>

        @can('read_categories')
        @endcan
        @can('read_clients')
        <li class="list-item {{ request()->routeIs('admin.clients') ? 'active' : '' }}">
            <a data-bs-toggle="collapse" href="#users" aria-expanded="{{ request()->routeIs('admin.clients') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-users"></i>
                    @lang('admin.Users')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="users" class="collapse item-collapse {{ request()->routeIs('admin.clients') ? 'show' : '' }}">

            <li class="list-item {{ request()->routeIs('admin.clients') ? 'active' : '' }}">
                <a href="{{ route('admin.clients') }}" class="">
                    <div>
                        <i class="fa-solid fa-users"></i>
                        @lang('admin.Clients')
                    </div>
                </a>
            </li>



        </div>
        @endcan
        @can('read_products')
        <li class="list-item {{ request()->routeIs('admin.products') || request()->routeIs('admin.products.show') || request()->routeIs('admin.sizes') || request()->routeIs('admin.colors') || request()->routeIs('admin.products-report')? 'active' : '' }}">
            <a data-bs-toggle="collapse" href="#products" aria-expanded="{{ request()->routeIs('admin.products') || request()->routeIs('admin.products.show') || request()->routeIs('admin.sizes') || request()->routeIs('admin.colors') || request()->routeIs('admin.products-report')? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-boxes-stacked"></i>
                    @lang('admin.Products')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>

     <div id="products" class="collapse item-collapse {{ request()->routeIs('admin.products') || request()->routeIs('admin.products.show') || request()->routeIs('admin.sizes') || request()->routeIs('admin.colors') || request()->routeIs('admin.products-report') ? 'show' : '' }}">
    {{-- @can('read_products') --}}
    <li class="list-item {{ request()->routeIs('admin.products') || request()->routeIs('admin.products.show') ? 'active' : '' }}">
        <a href="{{ route('admin.products') }}" class="">
            <div>
                <i class="fa-solid fa-layer-group icon"></i>
                @lang('admin.Products')
            </div>
        </a>
    </li>

    @can('read_product_types')
    <li class="list-item {{ request()->routeIs('admin.product_types') ? 'active' : '' }}">
        <a href="{{ route('admin.product_types') }}" class="">
            <div>
                <i class="fa-solid fa-layer-group icon"></i>
                @lang('admin.ProductTypes')
            </div>
        </a>
    </li>
    @endcan

    <li class="list-item {{ request()->routeIs('admin.sizes') ? 'active' : '' }}">
        <a href="{{ route('admin.sizes') }}" class="">
            <div>
                <i class="fa fa-vest"></i>
                @lang('admin.Sizes')
            </div>
        </a>
    </li>

    <li class="list-item {{ request()->routeIs('admin.colors') ? 'active' : '' }}">
        <a href="{{ route('admin.colors') }}" class="">
            <div>
                <i class="fa-solid fa-water"></i>
                @lang('admin.Colors')
            </div>
        </a>
    </li>

    <li class="list-item {{ request()->routeIs('admin.products-report') ? 'active' : '' }}">
        <a href="{{ route('admin.products-report') }}" class="" wire:navigate>
            <div>
                <i class="fa-solid fa-handshake-angle"></i>
                @lang('admin.ProductsReport')
            </div>
        </a>
    </li>
</div>

        @endcan
        @can('read_orders')
      <li class="list-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
    <a data-bs-toggle="collapse" href="#order" aria-expanded="{{ request()->routeIs('admin.orders') ? 'true' : 'false' }}">
        <div>
            <i class="fa-solid fa-box"></i>
            @lang('admin.Orders')
        </div>
        <i class="fa-solid fa-angle-right arrow"></i>
    </a>
</li>

        <div id="order" class="collapse item-collapse {{ request()->routeIs('admin.orders') ? 'show' : '' }}">

            <li class="list-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                <a href="{{ route('admin.orders') }}" class="">
                    <div>
                        <i class="fa-solid fa-shop"></i>
                        @lang('admin.Orders')
                        <div class="main-badge">{{ \App\Models\Order::count() }}</div>
                    </div>
                </a>
            </li>

        </div>
        @endcan
        <li class="list-item {{ request()->routeIs('admin.color') || request()->routeIs('admin.sliders.index') || request()->routeIs('admin.banner') || request()->routeIs('admin.designs') ? 'active' : '' }}">
            <a data-bs-toggle="collapse" href="#banner" aria-expanded="{{ request()->routeIs('admin.color') || request()->routeIs('admin.sliders.index') || request()->routeIs('admin.banner') || request()->routeIs('admin.designs') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-users"></i>
                    @lang('admin.DesignControl')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="banner" class="collapse item-collapse {{ request()->routeIs('admin.color') || request()->routeIs('admin.sliders.index') || request()->routeIs('admin.banner') || request()->routeIs('admin.designs') ? 'show' : '' }}">
            <li class="list-item {{ request()->routeIs('admin.sliders.index') ? 'active' : '' }}">
                <a href="{{ route('admin.sliders.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-layer-group"></i>
                        @lang('admin.Sliders')
                    </div>
                </a>
            </li>
            <li class="list-item {{ request()->routeIs('admin.banner') ? 'active' : '' }}">
                <a href="{{ route('admin.banner.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-users"></i>
                        @lang('admin.Banners')
                    </div>
                </a>
            </li>
            <li class="list-item {{ request()->routeIs('admin.designs') ? 'active' : '' }}">
                <a href="{{ route('admin.designs') }}" class="" wire:navigate>
                    <div>
                        <i class="fa-solid fa-users"></i>
                        @lang('admin.FrontDesigns')
                    </div>
                </a>
            </li>
            <li class="list-item {{ request()->routeIs('admin.color') ? 'active' : '' }}">
                <a href="{{ route('admin.color') }}" class="" wire:navigate>
                    <div>
                        <i class="fas fa-palette"></i>
                        @lang('admin.PrimaryColorChange')
                    </div>
                </a>
            </li>
        </div>


        <!-- <li class="list-item {{ request()->routeIs('admin.cities') ? 'active' : '' }}">
            <a data-bs-toggle="collapse" href="#pages" aria-expanded="{{ request()->routeIs('admin.cities') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-layer-group"></i>
                    @lang('admin.Site services')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="pages" class="collapse item-collapse {{ request()->routeIs('admin.cities') ? 'show' : '' }}">
            @can('read_city')
            <li class="list-item {{ request()->routeIs('admin.cities') ? 'active' : '' }}">
                <a href="{{ route('admin.cities') }}" class="">
                    <div>
                        <i class="fa-solid fa-layer-group"></i>
                        @lang('admin.Cities')
                    </div>
                </a>
            </li>
            @endcan
        </div> -->
        <li class="list-item {{ request()->routeIs('admin.tickets.index') ? 'active' : '' }}">
            <a data-bs-toggle="collapse" href="#support" aria-expanded="{{ request()->routeIs('admin.tickets.index') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-headset "></i>
                    @lang('admin.Technical support')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div class="collapse item-collapse {{ request()->routeIs('admin.tickets.index') ? 'show' : '' }}" id="support">
            <li class="list-item {{ request()->routeIs('admin.tickets.index') ? 'active' : '' }}">
                <a href="{{ route('admin.tickets.index') }}">
                    <div>
                        <i class="fa-solid fa-ticket "></i>
                        @lang('admin.Ticket')
                        <div class="main-badge">{{ App\Models\Ticket::count() }}</div>
                    </div>
                </a>
            </li>
        </div>
        <!-- <li class="list-item {{ request()->routeIs('admin.email-subscriptions') ? 'active' : '' }}">
            <a href="{{ route('admin.email-subscriptions') }}" class="" wire:navigate>
                <div>
                    <i class="fa-solid fa-handshake-angle"></i>
                    @lang('Mailing list')
                    <div class="main-badge">{{ App\Models\EmailSubscription::count() }}</div>
                </div>
            </a>
        </li> -->


        <li class="list-item {{ request()->routeIs('admin.contactes') ? 'active' : '' }}">
            <a href="{{ route('admin.contactes') }}" class="">
                <div>
                    <i class="fa-solid fa-handshake-angle"></i>
                    @lang('admin.Contact Us')
                    <div class="main-badge">{{ App\Models\ContactUs::count() }}</div>

                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.visitors') ? 'active' : '' }}">
            <a href="{{ route('admin.visitors') }}">
                <div>
                    <i class="fa-solid fa-users-rectangle"></i>
                    @lang('Visitors')
                    <div class="main-badge">{{ \App\Models\WebsiteView::count() }}</div>
                </div>
            </a>
        </li>

    </ul>
</div>
