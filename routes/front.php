<?php

use App\Http\Controllers\Front\HotelController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('lang')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::post('/set_language', 'HomeController@setLanguage')->name('set_language');
    Route::get('/wishlist', 'HomeController@wishlist')->name('home.wishlist');
    Route::get('/cart', 'HomeController@cart')->name('home.cart');
    Route::get('/checkout', 'HomeController@checkout')->name('home.checkout');
    Route::post('/place_order', 'HomeController@placeOrder')->name('place_order');
    Route::get('/contact', 'HomeController@contact')->name('home.contact');
    Route::get('/underconstruction', 'HomeController@underconstruction')->name('home.underconstruction');
    Route::get('/customer-login', 'HomeController@cuslogin')->name('home.cuslogin');
    Route::get('/product-details/{id?}', 'HomeController@productdetails')->name('home.productdetails');
    Route::get('/customer-registration', 'HomeController@cusregistration')->name('home.cusregistration');
    Route::get('/all-products', 'HomeController@shop')->name('home.shop');
    Route::get('/user-account', 'HomeController@useraccount')->name('home.useraccount');
    Route::post('/user-review', 'HomeController@review')->name('home.review');
    Route::post('/create/wishlist', 'HomeController@storewishlist')->name('home.storewishlist');
    Route::post('/create/cart', 'HomeController@storecart')->name('home.storecart');
    Route::post('/create/hotel/cart', 'HomeController@hotelstorecart')->name('home.hotelstorecart');
    Route::get('/allcategory', 'HomeController@allcategory')->name('home.allcategory');
    Route::get('/allservices/{id?}', 'HomeController@allservices')->name('home.allservices');

    Route::get('/login', 'HomeController@cuslogin')->name('front.login')->middleware(VerifyCsrfToken::class);

    Route::get('/regestration', 'HomeController@cusRegestration')->name('front.regestration')->middleware(VerifyCsrfToken::class);

    Route::get('/password/reset', 'HomeController@customerReset')->name('front.reset')->middleware(VerifyCsrfToken::class);

    Route::post('/cart/removeFromCart', 'HomeController@removeFromCart')->name('home.removeFromCart');
    Route::post('/wishlist/removeFromWishlist', 'HomeController@removeFromWishlist')->name('home.removeFromWishlist');
    Route::get('/service-details/{id?}', 'HomeController@servicedetails')->name('home.servicedetails');
    Route::post('/user-account', 'HomeController@storeCusAddress')->name('home.storeCusAddress');
    Route::post('/update-user-account', 'HomeController@updateUserAccount')->name('home.updateUserAccount');
    Route::post('/update-user-password', 'HomeController@updateUserPassword')->name('home.updateUserPassword');

    Route::get('/saloon/{id}', 'SaloonController@show')->name('saloon.show');

    Route::get('/saloon', 'SaloonController@index')->name('home.saloon');
    Route::get('/saloon/service/{service_id}', 'SaloonController@serviceDetails')->name('saloon.booking');
    Route::post('/saloon/checkout/{service_id}', 'SaloonController@checkout')->name('saloon.checkout');
    Route::post('/saloon/place_order/{service_id}', 'SaloonController@placeOrder')->name('saloon.place_order');
    Route::get('/user/booking/{id}', 'BookingController@show')->name('booking.show');
    Route::get('/user/order/{id}', 'OrderController@show')->name('order.show');
    Route::get('/user/order/return/{id}', 'OrderController@return')->name('order.return');
    Route::get('/user/order/return/show/{id}', 'OrderController@returnshow')->name('order.returnshow');
    Route::get('/user/review/{id}', 'BookingController@review')->name('booking.review');

    // Route::get('/saloon-all', [SaloonController::class, 'all'])->name('home.allsaloon');
    Route::get('/saloon-all', 'SaloonController@all')->name('home.allsaloon');



    Route::get('/hotel/{id}', 'HotelController@show')->name('hotel.show');
    // Route::get('/hotel/all', 'HotelController@all')->name('hotel.all');
    Route::get('/hotel-all', [HotelController::class,'all'])->name('hotel.all');

    Route::get('/hotel', 'HotelController@index')->name('home.hotel');
    Route::get('/hotel/service/{service_id}', 'HotelController@serviceDetails')->name('hotel.booking');
    Route::post('/hotel/checkout/{service_id}', 'HotelController@checkout')->name('hotel.checkout');
    Route::post('/hotel/reserve', 'HotelController@reserve')->name('hotel.reserve');
    Route::post('/hotel/place_order/{service_id}', 'HotelController@placeOrder')->name('hotel.place_order');
    Route::get('/user/booking/{id}', 'BookingController@show')->name('booking.show');
    Route::get('/addressinfo/{id}', 'HomeController@addressinfo')->name('shipaddinfo');
    Route::get('/addressdelete/{id}', 'HomeController@addrressdelete')->name('address.destroy');



});
