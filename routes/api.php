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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::post('/viewer_register', 'ApiauthController@register')->name('viewer_register');
Route::post('/viewer_register', 'ApiauthController@register');
Route::post('/check_token', 'ApiauthController@check_token');
Route::post('/getvideos', 'VideosapiController@GetVideos');
Route::post('/getsliders', 'VideosapiController@GetSliders');
Route::post('/like', 'socialapiController@like');
Route::post('/getnews', 'VideosapiController@GetNews');
Route::post('/getvideosbyid/{id}', 'VideosapiController@getvideosbyid');
Route::post('/getnewsdetail/{id}', 'VideosapiController@getnewsdetail');
