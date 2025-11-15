<?php

use Livewire\Livewire;
use App\Http\Livewire\Admin\Menus;
use App\Http\Livewire\Admin\Pages;
use App\Http\Livewire\Admin\Roles;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Cities;
use App\Http\Livewire\Admin\Clients;
use App\Http\Livewire\Admin\Vendors;
use App\Http\Livewire\Admin\Programs;
use App\Http\Livewire\Admin\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\EmailMenu;
use App\Http\Livewire\Admin\Categories;
use App\Http\Livewire\Admin\ClientCart;
use App\Http\Livewire\Admin\ClientForm;
use App\Http\Livewire\Admin\VendorForm;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Admin\Maintenances;
use App\Http\Livewire\Admin\Orders\Index;
use App\Http\Livewire\Admin\ProductTypes;
use App\Http\Livewire\Admin\Messages\Text;
use App\Http\Livewire\Admin\Neighborhoods;
use App\Http\Livewire\Admin\SubCategories;
use App\Http\Livewire\Admin\Messages\Image;
use App\Http\Livewire\Admin\ProductRates;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Livewire\Admin\ProductCategories;

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Livewire\Admin\Messages\SendMessage;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Livewire\Admin\Messages\MessagesSent;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsagePolicyController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SuccessPaymentController;
use App\Http\Livewire\Admin\Orders\Edit as EditOrders;
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
Route::prefix('admin')->group(function () {
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

    Route::view('login', 'admin.login')->middleware('admin_guest')->name('login');
    Route::post('login', [AuthController::class, 'login'])->middleware('admin_guest')->name('login.post');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::resource('faqs', FaqsController::class);

        // Route::get('settings', Settings::class)->name('settings');
        Route::view('settings', 'admin.settings')->name('settings');

        Route::get('programs', Programs::class)->name('programs');
        Route::get('cities', Cities::class)->name('cities');
        Route::get('neighborhoods', Neighborhoods::class)->name('neighborhoods');
        Route::get('clients', Clients::class)->name('clients');
        Route::get('clients/create', ClientForm::class)->name('clients.create');
        Route::get('clients/{client}/edit', ClientForm::class)->name('clients.edit');
        Route::get('clients/{client}', [ClientController::class, 'show'])->name('clients.show');
        Route::get('categories', Categories::class)->name('categories');
        Route::get('sub_categories', SubCategories::class)->name('sub-categories');
        Route::get('/sub-categories/{parent_id}', [SubCategoryController::class, 'index'])->name('sub-categories.index');

        Route::view('/all_articles', 'admin.articles.index')->name('all_articles');
        Route::view('/product-number', 'admin.product-number')->name('product-number');
        Route::resource('articles', ArticlesController::class);
        // Route::resource('articles', ArticlesController::class);
        Route::get('product_types', ProductTypes::class)->name('product_types')->middleware('can:read_product_types');
        // Route::get('product_categories', ProductCategories::class)->name('product_categories')->middleware('can:read_product_categories');

        Route::get('menus', Menus::class)->name('menus');
        Route::get('pages', Pages::class)->name('pages');

        Route::get('users', Users::class)->name('users');
        Route::get('roles', Roles::class)->name('roles');
        Route::get('text-message', Text::class)->name('texts');
        Route::get('images-message', Image::class)->name('images');
        Route::get('sendMessage', SendMessage::class)->name('SendMessage');
        Route::get('MessagesSent', MessagesSent::class)->name('MessagesSent');
        Route::resource('contact-us', ContactUsController::class);
        Route::get('contactes', \App\Http\Livewire\Admin\ContactUs::class)->name('contactes');
        Route::get('email_menu', EmailMenu::class)->name('email_menu');

        Route::resource('/library', \App\Http\Controllers\Admin\LibraryController::class);
        Route::post('/library/deleteAll', [\App\Http\Controllers\Admin\LibraryController::class, 'deleteAll'])->name('library.deleteAll');

        /*====================== Orders ============================*/
        Route::get('orders', Index::class)->name('orders')->middleware('can:read_orders');
        Route::get('maintenance_orders', Maintenances::class)->name('maintenance_orders');
        Route::get('orders/create', function () {
            return view('admin.orders.create');
        })->name('orders.create')->middleware('can:create_orders');
        Route::get('orders/{order}/edit', EditOrders::class)->name('orders.edit')->middleware('can:update_orders');
        Route::get('order/{id}', function ($id) {
            $order = \App\Models\Order::with('client')->find($id);
            return view('admin.orders.show', compact('order'));
        })->name('orders.show');
        Route::get('carts', ClientCart::class)->name('carts');
        Route::get('cart/{id}', function ($id) {
            $cart = \App\Models\Cart::find($id);
            return view('admin.carts.show', compact('cart'));
        })->name('carts.show');

        /*====================== End Orders ============================*/
        Route::get('bank-accounts', \App\Http\Livewire\Admin\BankAccounts::class)->name('bank-accounts');
        Route::get('sizes', \App\Http\Livewire\Admin\Sizes::class)->name('sizes');
        //    Route::view('/vendors/create', 'admin.vendors.create')->name('vendors.create');
        //    Route::view('/vendors/edit', 'admin.vendors.edit')->name('vendors.edit');
        //
        /* Route::get('/vendors', Vendors::class)->name('vendors.index');
        Route::get('/vendors/create', VendorForm::class)->name('vendors.create');
        Route::get('/vendors/{vendor}/edit', VendorForm::class)->name('vendors.edit');
        Route::get('vendors/{vendor}', [VendorController::class, 'show'])->name('vendors.show'); */
        Route::view('/articles-categories', 'admin.articles-categories.index')->name('articles-categories.index');
        Route::view('/articles-categories/create', 'admin.articles-categories.createOrUpdate')->name('articles-categories.create');
        Route::view('/articles-categories/edit', 'admin.articles-categories.edit')->name('articles-categories.edit');
        Route::view('/visitors', 'admin.visitors')->name('visitors');
        Route::get('email-subscriptions', \App\Http\Livewire\Admin\EmailSubscriptions::class)->name('email-subscriptions');

        Route::view('/sliders', 'admin.sliders.index')->name('sliders.index');

        Route::get('/color', \App\Http\Livewire\Admin\WebsiteColor::class)->name('color');
        Route::get('/colors', \App\Http\Livewire\Admin\Colors::class)->name('colors');

        Route::resource('tickets', TicketController::class);
        Route::post('tickets/storeComment', [TicketController::class, 'storeComment'])->name('tickets.storeComment');

        // livewire
        Route::get('products', \App\Http\Livewire\Admin\Products::class)->name('products');
        Route::get('products/{product}/comments', ProductRates::class)->name('product.comments');
        Route::view('/articles', 'admin.articles.index')->name('articles.index');
        // livewire
        Route::get('products', \App\Http\Livewire\Admin\Products::class)->name('products');
        Route::get('products-report', \App\Http\Livewire\Admin\ProductReport::class)->name('products-report');
        // Route::view('/articles', 'admin.articles.index')->name('articles.index');
        Route::get('designs', \App\Http\Livewire\Admin\Designs::class)->name('designs');

        Route::get('/notifications', \App\Http\Livewire\Admin\Notifications::class)->name('notifications.index');
        Route::resource('privacy-policy', PrivacyPolicyController::class)->only('index', 'update');
        Route::resource('usage-policy', UsagePolicyController::class)->only('index', 'update');
        Route::get('about-us', [AboutController::class, 'index'])->name('about');
        Route::post('about-us/update', [AboutController::class, 'update'])->name('about_update');
        Route::get('banner', [BannerController::class, 'index'])->name('banner.index');
        Route::post('banner/update', [BannerController::class, 'update'])->name('banner_update');
        Route::resource('terms', TermsController::class)->only('index', 'update');
        // Route::resource('success_payment', SuccessPaymentController::class)->only('index', 'update');
        Route::put('success_payment', [SuccessPaymentController::class, 'update'])->name('success_payment.update');

        Route::get('/generate-translation', function () {
            Artisan::call('translations:find');
            return back()->with('success', 'تم بنجاح !');
        })->name('generate-translation');
        //    Route::view('/notifications/create','admin.notifications.create')->name('notifications.create');
    });
});
}
);