<?php
/*
 * File name: web.php
 * Last modified: 2022.02.02 at 23:01:35
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

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

use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelLevelController;
use App\Http\Controllers\HotelRoomController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;


Route::get('shohid/cache-clear', function() {
     Artisan::call('cache:clear');
     
     echo "done"; die();
});

Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();

Route::get('payments/failed', 'PayPalController@index')->name('payments.failed');
Route::get('payments/razorpay/checkout', 'RazorPayController@checkout');
Route::post('payments/razorpay/pay-success/{bookingId}', 'RazorPayController@paySuccess');
Route::get('payments/razorpay', 'RazorPayController@index');

Route::get('payments/stripe/checkout', 'StripeController@checkout');
Route::get('payments/stripe/pay-success/{bookingId}/{paymentMethodId}', 'StripeController@paySuccess');
Route::get('payments/stripe', 'StripeController@index');

Route::get('payments/paymongo/checkout', 'PayMongoController@checkout');
Route::get('payments/paymongo/processing/{bookingId}/{paymentMethodId}', 'PayMongoController@processing');
Route::get('payments/paymongo/success/{bookingId}/{paymentIntentId}', 'PayMongoController@success');
Route::get('payments/paymongo', 'PayMongoController@index');

Route::get('payments/stripe-fpx/checkout', 'StripeFPXController@checkout');
Route::get('payments/stripe-fpx/pay-success/{bookingId}', 'StripeFPXController@paySuccess');
Route::get('payments/stripe-fpx', 'StripeFPXController@index');

Route::get('payments/flutterwave/checkout', 'FlutterWaveController@checkout');
Route::get('payments/flutterwave/pay-success/{bookingId}/{transactionId}', 'FlutterWaveController@paySuccess');
Route::get('payments/flutterwave', 'FlutterWaveController@index');

Route::get('payments/paystack/checkout', 'PayStackController@checkout');
Route::get('payments/paystack/pay-success/{bookingId}/{reference}', 'PayStackController@paySuccess');
Route::get('payments/paystack', 'PayStackController@index');

Route::get('payments/paypal/express-checkout', 'PayPalController@getExpressCheckout')->name('paypal.express-checkout');
Route::get('payments/paypal/express-checkout-success', 'PayPalController@getExpressCheckoutSuccess');
Route::get('payments/paypal', 'PayPalController@index')->name('paypal.index');

Route::get('firebase/sw-js', 'AppSettingController@initFirebase');


Route::get('storage/app/public/{id}/{conversion}/{filename?}', 'UploadController@storage');
Route::middleware('auth')->group(function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::post('uploads/store', 'UploadController@store')->name('medias.create');
    Route::get('users/profile', 'UserController@profile')->name('users.profile');
    Route::post('users/remove-media', 'UserController@removeMedia');
    Route::resource('users', 'UserController');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['middleware' => ['permission:medias']], function () {
        Route::get('uploads/all/{collection?}', 'UploadController@all');
        Route::get('uploads/collectionsNames', 'UploadController@collectionsNames');
        Route::post('uploads/clear', 'UploadController@clear')->name('medias.delete');
        Route::get('medias', 'UploadController@index')->name('medias');
        Route::get('uploads/clear-all', 'UploadController@clearAll');
    });

    Route::group(['middleware' => ['permission:permissions.index']], function () {
        Route::get('permissions/role-has-permission', 'PermissionController@roleHasPermission');
        Route::get('permissions/refresh-permissions', 'PermissionController@refreshPermissions');
    });
    Route::group(['middleware' => ['permission:permissions.index']], function () {
        Route::post('permissions/give-permission-to-role', 'PermissionController@givePermissionToRole');
        Route::post('permissions/revoke-permission-to-role', 'PermissionController@revokePermissionToRole');
    });

    Route::group(['middleware' => ['permission:app-settings']], function () {
        Route::prefix('settings')->group(function () {
            Route::resource('permissions', 'PermissionController');
            Route::resource('roles', 'RoleController');
            Route::resource('customFields', 'CustomFieldController');
            Route::resource('currencies', 'CurrencyController')->except([
                'show'
            ]);
            Route::resource('taxes', 'TaxController')->except([
                'show'
            ]);
            Route::get('users/login-as-user/{id}', 'UserController@loginAsUser')->name('users.login-as-user');
            Route::patch('update', 'AppSettingController@update');
            Route::patch('translate', 'AppSettingController@translate');
            Route::get('sync-translation', 'AppSettingController@syncTranslation');
            Route::get('clear-cache', 'AppSettingController@clearCache');
            Route::get('check-update', 'AppSettingController@checkForUpdates');
            // disable special character and number in route params
            Route::get('/{type?}/{tab?}', 'AppSettingController@index')
                ->where('type', '[A-Za-z]*')->where('tab', '[A-Za-z]*')->name('app-settings');
        });
    });

    Route::resource('salonLevels', 'SalonLevelController')->except([
        'show'
    ]);
    Route::post('salons/remove-media', 'SalonController@removeMedia');
    Route::resource('salons', 'SalonController')->except([
        'show'
    ]);

    Route::get('requestedSalons', 'SalonController@requestedSalons')->name('requestedSalons.index');

    Route::resource('addresses', 'AddressController')->except([
        'show'
    ]);
    Route::resource('awards', 'AwardController');
    Route::resource('experiences', 'ExperienceController');

    Route::resource('availabilityHours', 'AvailabilityHourController')->except([
        'show'
    ]);
    Route::post('eServices/remove-media', 'EServiceController@removeMedia');
    Route::resource('eServices', 'EServiceController')->except([
        'show'
    ]);
    Route::resource('faqCategories', 'FaqCategoryController')->except([
        'show'
    ]);
    Route::post('categories/remove-media', 'CategoryController@removeMedia');
    Route::resource('categories', 'CategoryController')->except([
        'show'
    ]);
    Route::resource('bookingStatuses', 'BookingStatusController')->except([
        'show',
    ]);
    Route::post('galleries/remove-media', 'GalleryController@removeMedia');
    Route::resource('galleries', 'GalleryController')->except([
        'show'
    ]);


    Route::resource('salonReviews', 'SalonReviewController')->except([
        'show'
    ]);
    Route::resource('payments', 'PaymentController')->except([
        'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('paymentMethods/remove-media', 'PaymentMethodController@removeMedia');
    Route::resource('paymentMethods', 'PaymentMethodController')->except([
        'show'
    ]);
    Route::resource('paymentStatuses', 'PaymentStatusController')->except([
        'show'
    ]);
    Route::resource('faqs', 'FaqController')->except([
        'show'
    ]);
    Route::resource('favorites', 'FavoriteController')->except([
        'show'
    ]);
    Route::resource('notifications', 'NotificationController')->except([
        'create', 'store', 'update', 'edit',
    ]);
    Route::resource('bookings', 'BookingController');

    Route::resource('earnings', 'EarningController')->except([
        'show', 'edit', 'update'
    ]);

    Route::get('salonPayouts/create/{id}', 'SalonPayoutController@create')->name('salonPayouts.create');
    Route::resource('salonPayouts', 'SalonPayoutController')->except([
        'show', 'edit', 'update', 'create'
    ]);
    Route::resource('optionGroups', 'OptionGroupController')->except([
        'show'
    ]);
    Route::post('options/remove-media', 'OptionController@removeMedia');
    Route::resource('options', 'OptionController')->except([
        'show'
    ]);
    Route::resource('coupons', 'CouponController')->except([
        'show'
    ]);
    Route::post('slides/remove-media', 'SlideController@removeMedia');
    Route::resource('slides', 'SlideController')->except([
        'show'
    ]);
    Route::resource('customPages', 'CustomPageController');

    Route::resource('wallets', 'WalletController')->except([
        'show'
    ]);
    Route::resource('walletTransactions', 'WalletTransactionController')->except([
        'show', 'edit', 'update', 'destroy'
    ]);

    /*
     * HOTEL BOOKING
     * */
    Route::resource('hotelLevels', 'HotelLevelController')->except([
        'show'
    ]);
    // Route::get('hotelLevels', [HotelLevelController::class, 'index'])->name('hotelLevels.index');
    // Route::get('hotelLevels/create', [HotelLevelController::class, 'create'])->name('hotelLevels.create');
    // Route::post('hotelLevels', [HotelLevelController::class, 'store'])->name('hotelLevels.store');
    // Route::get('hotelLevels/{hotelLevel}/edit', [HotelLevelController::class, 'edit'])->name('hotelLevels.edit');
    // Route::post('hotelLevels/{hotelLevel}', [HotelLevelController::class, 'update'])->name('hotelLevels.update');
    // Route::delete('hotelLevels/{hotelLevel}', [HotelLevelController::class, 'destroy'])->name('hotelLevels.destroy');

    Route::post('hotels/remove-media', 'HotelController@removeMedia');

    Route::resource('hotels', 'HotelController')->except([
        'show'
    ]);
    // Route::get('hotels', [HotelController::class, 'index']);
    // Route::get('hotels/create', [HotelController::class, 'create']);
    // Route::post('hotels/store', [HotelController::class, 'store']);
    // Route::get('hotels/{hotel}/edit', [HotelController::class, 'edit']);
    // Route::put('hotels/{hotel}', [HotelController::class, 'update']);
    // Route::patch('hotels/{hotel}', [HotelController::class, 'update']);
    // Route::delete('hotels/{hotel}', [HotelController::class, 'destroy']);

    Route::get('requestedHotels', 'HotelController@requestedHotels')->name('requestedHotels.index');
    Route::resource('hotelReviews', 'HotelReviewController')->except([
        'show'
    ]);
    Route::get('hotelPayouts/create/{id}', 'HotelPayoutController@create')->name('hotelPayouts.create');
    Route::resource('hotelPayouts', 'HotelPayoutController')->except([
        'show', 'edit', 'update', 'create'
    ]);
    // Route::post('hotelGalleries/remove-media', 'HotelGalleryController@removeMedia');
    // Route::resource('hotelGalleries', 'HotelGalleryController')->except([
    //     'show'
    // ]);
    Route::get('hotelGalleries', [HotelGalleryController::class, 'index'])->name('hotelGalleries.index');
    Route::get('hotelGalleries/create', [HotelGalleryController::class, 'create'])->name('hotelGalleries.create');
    Route::post('hotelGalleries', [HotelGalleryController::class, 'store'])->name('hotelGalleries.store');
    Route::get('hotelGalleries/{hotelGallery}', [HotelGalleryController::class, 'show'])->name('hotelGalleries.show');
    Route::get('hotelGalleries/{hotelGallery}/edit', [HotelGalleryController::class, 'edit'])->name('hotelGalleries.edit');
    Route::put('hotelGalleries/{hotelGallery}', [HotelGalleryController::class, 'update'])->name('hotelGalleries.update');
    Route::delete('hotelGalleries/{hotelGallery}', [HotelGalleryController::class, 'destroy'])->name('hotelGalleries.destroy');

    Route::resource('hotelRooms', 'HotelRoomController')->except([
        'show'
    ]);
    Route::resource('shipping', 'ShippingCompanyController')->except([
        'show'
    ]);
    Route::resource('shippingrules', 'ShippingRulesController')->except([
        'show'
    ]);
    Route::resource('colors', 'ColorController')->except([
        'show'
    ]);
    // Route::get('hotelRooms', [HotelRoomController::class, 'index']);
    // Route::get('hotelRooms/create', [HotelRoomController::class, 'create']);
    // Route::post('hotelRooms/store', [HotelRoomController::class, 'store'])->name('hotelRooms.store');
    // Route::get('hotelRooms/{hotelRoom}/edit', [HotelRoomController::class, 'edit']);
    // Route::put('hotelRooms/{hotelRoom}', [HotelRoomController::class, 'update']);
    // Route::patch('hotelRooms/{hotelRoom}', [HotelRoomController::class, 'update']);
    // Route::delete('hotelRooms/{hotelRoom}', [HotelRoomController::class, 'destroy']);


    //Rooms
    Route::resource('rooms', 'RoomController');

    // Route::get('rooms', [RoomController::class, 'index']);
    // Route::get('rooms/create', [RoomController::class, 'create']);
    // Route::post('rooms/store', [RoomController::class, 'store']);
    // Route::get('rooms/{room}', [RoomController::class, 'show']);
    // Route::get('rooms/{room}/edit', [RoomController::class, 'edit']);
    // Route::put('rooms/{room}', [RoomController::class, 'update']);
    // Route::patch('rooms/{room}', [RoomController::class, 'update']);
    // Route::delete('rooms/{room}', [RoomController::class, 'destroy']);


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/addressinfo/{id}', 'HomeController@addressinfo')->name('shipaddinfo');
