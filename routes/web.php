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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@get_users');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/vendor/index', 'VendorController@index')->name('vendors');
Route::get('/vendor/add', 'VendorController@add');
Route::post('/vendor/add', 'VendorController@add_vendor');

Route::get('/vendor/edit/{id}', 'VendorController@edit');
Route::get('/vendor/delete/{id}', 'VendorController@delete');
Route::get('/vendor/activate/{id}', 'VendorController@activate');
Route::get('/vendor/desactivate/{id}', 'VendorController@desactivate');
//liste users for vendor
Route::get('/vendor/users/{id}', 'VendorController@vendor_users')->name('vendor_users');

Route::get('/vendor/user/add', 'VendorController@add_vendor_users');
Route::post('/vendor/user/add', 'VendorController@add_vendor_users_save');

Route::get('/vendor/user/edit/{id}', 'VendorController@edit_vendor_users');
Route::get('/vendor/user/delete/{id}', 'VendorController@delete_vendor_users');
Route::get('/vendor/user/activate/{id}', 'VendorController@activate_vendor_users');
Route::get('/vendor/user/desactivate/{id}', 'VendorController@desactivate_vendor_users');

Route::get('/event/index', 'EventController@index')->name('events');
Route::get('/event/add', 'EventController@add');
Route::post('/event/add', 'EventController@add_event');

Route::get('/event/link/{id}', 'EventController@link');
Route::get('/event/change/{id}', 'EventController@change');

Route::post('/event/link', 'EventController@link_save');

Route::get('/event/edit/{id}', 'EventController@edit');
Route::get('/event/delete/{id}', 'EventController@delete');
Route::get('/event/activate/{id}', 'EventController@activate');
Route::get('/event/desactivate/{id}', 'EventController@desactivate');

Route::get('/event/coupon/{id}', 'CouponController@coupon')->name('coupons');

Route::get('/coupon/pay/{id}', 'CouponController@pay');
Route::get('/coupon/notpay/{id}', 'CouponController@notpay');
Route::get('/coupon/edit/{id}', 'CouponController@edit');
Route::get('/coupon/delete/{id}', 'CouponController@delete');
Route::get('/coupon/activate/{id}', 'CouponController@activate');
Route::get('/coupon/desactivate/{id}', 'CouponController@desactivate');

Route::post('/coupon/update', 'CouponController@update');

//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
