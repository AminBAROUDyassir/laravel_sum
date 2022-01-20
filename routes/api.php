<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

});

Route::get('get_code_bar', 'BarcodeController@get_code_bar');
Route::get('get_code_bar_text', 'BarcodeController@get_code_bar_text');

Route::post('get_number', 'OtherController@get_number');

Route::post('adjust', 'OtherController@adjuts_data_post');
Route::get('adjust', 'OtherController@adjuts_data_get');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('users', 'AuthController@user');

    Route::get('/coupon/get/{code}', 'AdminCouponController@get_coupon');
    Route::post('/coupon/update', 'AdminCouponController@update_coupon');

    // Partie statistiques
    Route::get('/recent_log_events', 'LogEventController@recent_log_events');
    Route::get('/recent_add_product', 'LogEventController@recent_add_product');
    Route::get('/recent_add_users', 'LogEventController@recent_add_users');
    Route::get('/monthly_products', 'LogEventController@monthly_products');
    Route::get('/client_nbr', 'LogEventController@client_nbr');
    Route::get('/vendor_nbr', 'LogEventController@vendor_nbr');
    Route::get('/vendor_users_nbr', 'LogEventController@vendor_users_nbr');
    Route::get('/product_nbr', 'LogEventController@product_nbr');
    Route::get('/product_selled_nbr', 'LogEventController@product_selled_nbr');
    Route::get('/product_selled_not_activated_nbr', 'LogEventController@product_selled_not_activated_nbr');
    Route::get('/product_scanned_after_expiration', 'LogEventController@product_scanned_after_expiration');
    Route::get('/aging_of_products', 'LogEventController@aging_of_products');
    Route::get('/nbr_product_created_by_market', 'LogEventController@nbr_product_created_by_market');
    Route::get('/nbr_product_created_by_app', 'LogEventController@nbr_product_created_by_app');

});
