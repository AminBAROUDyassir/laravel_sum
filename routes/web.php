<?php

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

Route::get('/', 'AdminHomeController@home');
Route::get('/users', 'UserController@get_users');

Auth::routes();

Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/home', 'AdminHomeController@index')->name('admin_index');
    Route::get('/vendor/index', 'AdminVendorController@index')->name('vendors');
    Route::get('/vendor/add', 'AdminVendorController@add');
    Route::post('/vendor/add', 'AdminVendorController@add_vendor');

    Route::get('/vendor/edit/{id}', 'AdminVendorController@edit');
    Route::get('/vendor/delete/{id}', 'AdminVendorController@delete');
    Route::get('/vendor/activate/{id}', 'AdminVendorController@activate');
    Route::get('/vendor/desactivate/{id}', 'AdminVendorController@desactivate');
    //liste users for vendor
    Route::get('/vendor/users/{id}', 'AdminVendorController@vendor_users')->name('vendor_users');

    Route::get('/vendor/user/add', 'AdminVendorController@add_vendor_users');
    Route::post('/vendor/user/add', 'AdminVendorController@add_vendor_users_save');

    Route::get('/vendor/user/edit/{id}', 'AdminVendorController@edit_vendor_users');
    Route::get('/vendor/user/delete/{id}', 'AdminVendorController@delete_vendor_users');
    Route::get('/vendor/user/activate/{id}', 'AdminVendorController@activate_vendor_users');
    Route::get('/vendor/user/desactivate/{id}', 'AdminVendorController@desactivate_vendor_users');

    Route::get('/event/index', 'AdminEventController@index')->name('events');
    Route::get('/event/add', 'AdminEventController@add');
    Route::post('/event/add', 'AdminEventController@add_event');

    Route::get('/event/link/{id}', 'AdminEventController@link');
    Route::get('/event/change/{id}', 'AdminEventController@change');

    Route::post('/event/link', 'AdminEventController@link_save');

    Route::get('/event/edit/{id}', 'AdminEventController@edit');
    Route::get('/event/delete/{id}', 'AdminEventController@delete');
    Route::get('/event/activate/{id}', 'AdminEventController@activate');
    Route::get('/event/desactivate/{id}', 'AdminEventController@desactivate');

    Route::get('/event/coupon/{id}', 'AdminCouponController@coupon')->name('coupons');

    Route::get('/coupon/pay/{id}', 'AdminCouponController@pay');
    Route::get('/coupon/notpay/{id}', 'AdminCouponController@notpay');
    Route::get('/coupon/edit/{id}', 'AdminCouponController@edit');
    Route::get('/coupon/delete/{id}', 'AdminCouponController@delete');
    Route::get('/coupon/activate/{id}', 'AdminCouponController@activate');
    Route::get('/coupon/desactivate/{id}', 'AdminCouponController@desactivate');

    Route::post('/coupon/update', 'AdminCouponController@update');
});

Route::middleware('vendor')->group(function () {

    Route::get('/vendor/home', 'VendorHomeController@index')->name('vendor_index');

    Route::get('/vendor/user/add', 'VendorHomeController@add_vendor_users');
    Route::post('/vendor/user/add', 'VendorHomeController@add_vendor_users_save');

    Route::get('/vendor/user/edit/{id}', 'VendorHomeController@edit_vendor_users');
    Route::get('/vendor/user/delete/{id}', 'VendorHomeController@delete_vendor_users');
    Route::get('/vendor/user/activate/{id}', 'VendorHomeController@activate_vendor_users');
    Route::get('/vendor/user/desactivate/{id}', 'VendorHomeController@desactivate_vendor_users');

    Route::get('/event/index', 'VendorEventController@index')->name('vendor_events');
    Route::get('/event/add', 'VendorEventController@add');
    Route::post('/event/add', 'VendorEventController@add_event');

    Route::get('/event/link/{id}', 'VendorEventController@link');
    Route::get('/event/change/{id}', 'VendorEventController@change');

    Route::post('/event/link', 'VendorEventController@link_save');

    Route::get('/event/edit/{id}', 'VendorEventController@edit');
    Route::get('/event/delete/{id}', 'VendorEventController@delete');
    Route::get('/event/activate/{id}', 'VendorEventController@activate');
    Route::get('/event/desactivate/{id}', 'VendorEventController@desactivate');

    Route::get('/event/coupon/{id}', 'VendorCouponController@coupon')->name('vendor_coupons');

    Route::get('/coupon/pay/{id}', 'VendorCouponController@pay');
    Route::get('/coupon/notpay/{id}', 'VendorCouponController@notpay');
    Route::get('/coupon/edit/{id}', 'VendorCouponController@edit');
    Route::get('/coupon/delete/{id}', 'VendorCouponController@delete');
    Route::get('/coupon/activate/{id}', 'VendorCouponController@activate');
    Route::get('/coupon/desactivate/{id}', 'VendorCouponController@desactivate');

    Route::post('/coupon/update', 'VendorCouponController@update');
});

//Route::get('/home', 'HomeController@index')->name('home');
/*
Auth::routes([
'register' => false, // Registration Routes...
'reset' => false, // Password Reset Routes...
'verify' => false, // Email Verification Routes...
]);
 */
