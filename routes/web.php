<?php

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

Route::get('/', 'PageController@getHomePage');
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/rss-channel', 'Web\RssChannelController@index')->name('rss-channels');
Route::get('/rss-feed', 'Web\RssFeedController@index')->name('rss-feeds');

/* Payment URLs */
Route::get('/payment/get-snap-token/{price?}', 'PaymentController@getSnapToken');
Route::get('/payment/notif', 'PaymentController@getNotif');
Route::get('/payment/success', 'PaymentController@getSuccess');
Route::get('/payment/cancel', 'PaymentController@getCancel');
Route::get('/payment/error', 'PaymentController@getError');
Route::get('/payment/checkout', 'PaymentController@getCheckout')->name('payment.checkout');

Route::get('/client/home', function(){})->name('client.home');
Route::get('/admin/dashboard', function(){})->name('admin.dashboard');