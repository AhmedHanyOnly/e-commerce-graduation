<?php

use App\Http\Controllers\StripeController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Client\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\FavoriteController;
use App\Http\Controllers\EmailSubscriptionController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\TicketController;
use App\Http\Livewire\Cart;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'localize',
            'localizationRedirect',
            'localeSessionRedirect',
            'localeViewPath'
        ]
    ],
    function () {

        Auth::routes();
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::post('/product/{productId}/favorites', [HomeController::class, 'addToFavorites'])->name('product.addToFavorites');

        Route::view('articles', 'front.article')->name('articles');
        Route::view('contact', 'front.contact')->name('contact');
        Route::post('contact/store', [ContactUsController::class, 'store'])->name('contact.store');
        Route::view('contracts', 'front.contracts')->name('contracts');
        Route::view('jobs', 'front.jobs')->name('jobs');
        //Route::view('orders-unpaid', 'front.orders-unpaid')->name('orders-unpaid');
        Route::view('orders', 'front.orders')->name('orders');
        Route::get('show-order/{order}', function (Order $order) {
            return view('front.show-order', compact('order'));
        })->name('show-order');
        Route::post('orders/{order}/rate', [OrderController::class, 'storeRate'])->name('orders.storeRate');

        Route::view('showProduct', 'front.showProduct')->name('showProduct');
        Route::get('cart', \App\Http\Livewire\Cart::class)->name('cart');
        Route::get('notification', [\App\Http\Controllers\Front\NotificationController::class, 'index'])->name('notice');
        Route::delete('/notifications/{id}', [\App\Http\Controllers\Front\NotificationController::class, 'destroy'])->name('notifications.destroy');
        Route::delete('/notifications', [\App\Http\Controllers\Front\NotificationController::class, 'destroyAll'])
            ->name('notifications.destroyAll');

        Route::view('faq', 'front.faq')->name('faq');
        Route::view('payment', 'front.payment')->name('payment');
        Route::view('privacy', 'front.privacy')->name('privacy');
        Route::view('policy', 'front.policy')->name('policy');
        Route::view('forgot-password', 'auth.forgot-password')->name('forgot-password');
        Route::view('return', 'front.return')->name('return');
        Route::view('about', 'front.about')->name('about');
        Route::get('profile', Profile::class)->name('profile');
        Route::view('reseat', 'front.reseat')->name('reseat');
        Route::view('show-administrative-job', 'front.show-administrative-job')->name('show-administrative-job');
        Route::view('show-employer-job', 'front.show-employer-job')->name('show-employer-job');
        Route::view('settings', 'front.site-settings')->name('settings');
        Route::view('subscriptions', 'front.subscription')->name('subscriptions');
        Route::view('treasury', 'front.treasury')->name('treasury');
        Route::view('users', 'front.users')->name('users');
        Route::post('email_subscriptions', [EmailSubscriptionController::class, 'store'])->name('email_subscriptions.store');
        Route::get('product-number', function () {
            return view('front.product-number');
        })->name('product-number');
        Route::view('products', 'front.products.index')->name('products');
        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
        // Route::get('/products/{category}', 'ProductController@showByCategory')->name('products.showByCategory');
        Route::get('products/{category}', [ProductController::class, 'showByCategory'])->name('products.showByCategory');
        Route::post('/products/{productId}/favorites', [ProductController::class, 'addToFavorites'])->name('products.addToFavorites');

        //tickets
        Route::resource('tickets', TicketController::class);
        Route::post('tickets/storeComment/{id}', [TicketController::class, 'storeComment'])->name('tickets.storeComment');

        Route::post('products/{product}/comments', [ProductController::class, 'addComment'])->name('products.addComment');
        Route::post('products/{product}/rate', [ProductController::class, 'storeRate'])->name('products.storeRate');
        Route::post('products/comments/replies/{comment}', [ProductController::class, 'addReply'])->name('products.addReply');
        Route::resource('favorites', FavoriteController::class);
        Route::view('success_payment', 'front.success_payment')->name('success_payment');

        Route::get('/clickpay/verify/{payment?}', [\App\Http\Controllers\CallbackController::class, 'clickpay'])->name('clickpay.callback');


        Route::get('/get-neighborhoods/{city_id}', function ($city_id) {
            return \App\Models\Neighborhood::where('city_id', $city_id)->pluck('name', 'id');
        });

        Route::post('stripe/{order}/pay', [StripeController::class, 'pay'])->name('stripe.pay');
        Route::any('stripe/redirect', [StripeController::class, 'handleRedirect'])->name('stripe.redirect');

    }
);

Route::post('stripe/webhook', [StripeController::class, 'webhook'])->name('stripe.webhook');

Route::view('payment/success', 'payments.success')->name('payment.success');
Route::view('payment/fail', 'payments.fail')->name('payment.fail');
