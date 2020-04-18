<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/rss-channel/{id}', 	'RssChannelController@getChannel');
Route::put('/rss-channel/{id}', 	'RssChannelController@putChannel');
Route::post('/rss-channel', 		'RssChannelController@postChannel');
Route::delete('/rss-channel/{id}',	'RssChannelController@deleteChannel');

Route::get('/rss-feed/all', 'RssFeedController@getAllFeeds');
