<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Observers\NotificationObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Notification::observe(NotificationObserver::class);
        Order::observe(OrderObserver::class);
        Product::observe(ProductObserver::class);
        Paginator::useBootstrapFour();


    }
}
