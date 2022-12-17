<?php

use App\Models\Order;
use App\Models\Productorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(
    [
        'namespace' => 'Backpack\CRUD\app\Http\Controllers',
        'middleware' => [config('backpack.base.web_middleware', 'web'), 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'prefix' => LaravelLocalization::setLocale(),
    ],
    function () {
        // if not otherwise configured, setup the auth routes
        if (config('backpack.base.setup_auth_routes')) {


            // if not otherwise configured, setup the password recovery routes
            if (config('backpack.base.setup_password_recovery_routes', true)) {
                Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('backpack.auth.password.reset');
                Route::post('password/reset', 'Auth\ResetPasswordController@reset');
                Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('backpack.auth.password.reset.token');
                Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('backpack.auth.password.email')->middleware('backpack.throttle.password.recovery:' . config('backpack.base.password_recovery_throttle_access'));
            }
        }
    });

Route::group([
    'namespace' => 'App\Http\Controllers\Front',
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    // Home Route
    Route::get('/', 'WebController@index')->name('site.home');

    // About us Route
    Route::get('/about-us', 'WebController@about')->name('site.about-us');

    // Contact us Route
    Route::get('/contact-us', 'WebController@contact')->name('site.contact-us');
    Route::post('/contact/send', 'WebController@storeMessage')->name('send.contact.us');
    Route::post('/subscribe', 'WebController@subscribe')->name('site.subscribe');



    // Products Section
    Route::get('/product-details/{slug}', 'ProductsController@productDetails')->name('site.product.details');

    // Route Track Your Order
    Route::get('/track-order', 'ProductOrdersController@trackOrder')->name('site.track');
    Route::post('/track-result', 'ProductOrdersController@trackResult')->name('site.track-result');

    // Route Projects
    Route::get('projects', 'ProjectsController@index')->name('site.projects');
    Route::get('project/{slug}', 'ProjectsController@show')->name('site.project');

    // Route Posts
    Route::get('blog', 'PostsController@index')->name('site.blog');
    Route::get('post/{slug}', 'PostsController@show')->name('site.post');

    // Route Privacy Policy
    Route::get('privacy-policy', 'WebController@privacy')->name('site.privacy.policy');

    Route::group(['middleware' => 'UserAuth'], function () {

        // Services Section
        Route::get('service-order', 'ServicesController@order')->name('site.service-order');
        Route::post('service-order', 'ServicesController@placeOrder')->name('site.place.order');

        // Wish list Section
        Route::get('/wish-list', 'WishlistController@index')->name('site.wish');
        Route::post('add-to-wish/{slug}', 'WishlistController@addToWish')->name('add.to.wish');
        Route::post('delete-wish/{id}', 'WishlistController@destroyWish')->name('delete.wish');

        // Cart Section
        Route::get('/cart', 'CartsController@index')->name('site.cart');
        Route::post('/add-to-cart/{slug}', 'CartsController@addToCart')->name('add.to.cart');
        Route::get('cart-delete/{id}', 'CartsController@cartDelete')->name('cart-delete');
        Route::post('cart-update', 'CartsController@cartUpdate')->name('cart.update.items');
        Route::get('/checkout', 'CartsController@checkout')->name('site.checkout');

        // Route Order
        Route::post('cart/order', 'ProductOrdersController@store')->name('cart.order');
        Route::get('order-done/{id}', 'ProductOrdersController@doneOrder')->name('site.order-complete');


        // Route User Dashboard Pages
        Route::group(['prefix' => 'my-account'], function () {
            Route::get('/', 'UserDashboardController@index')->name('site.user.dashboard');
            Route::get('/services-orders', 'UserDashboardController@serviceOrders')->name('site.user.serviceOrders');
            Route::get('/products-orders', 'UserDashboardController@orders')->name('site.user.productsOrders');
            Route::get('/products-orders/{id}', 'UserDashboardController@orderShow')->name('site.user.orders.show');
            Route::get('/ship-pill-details', 'UserDashboardController@shipDetails')->name('site.user.ship.pill.details');
            Route::get('/ship-pill-details/edit', 'UserDashboardController@shipDetailsEdit')->name('site.user.ship.pill.details.edit');
            Route::post('/ship-pill-details/update', 'UserDashboardController@shipDetailsUpdate')->name('site.user.ship.pill.details.update');
            Route::get('/Personal-info/edit', 'UserDashboardController@personalInfoEdit')->name('site.user.personal.info.edit');
            Route::post('/Personal-info-name/update', 'UserDashboardController@personalInfoNameUpdate')->name('personalInfoNameUpdate');
            Route::post('/Personal-info-pass/update', 'UserDashboardController@personalInfoPassUpdate')->name('personalInfoPassUpdate');
        });

    });


});

Route::get('/credit', 'App\Http\Controllers\Front\CreditController@credit')->name('site.credit');









//Route::get('/privacy-policy', function () {
//    $privacy = \App\Models\Setting::select('privacy')->first();
//    return view('front.pages.privacy-policy', compact('privacy'));
//})->name('site.privacy.policy');





//Route::get('order', 'WebController@order')->name('site.order');




