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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {
    //route for video
    Route::get('/addvideo', 'VideosController@AddVideoform');

    //news routes
    Route::get('/addnews', 'NewsController@AddNewsform');
    Route::post('/addnews', 'NewsController@SaveNews');
    Route::get('/newslist', 'NewsController@NewsList');
    Route::get('/newsdetail/{id}', 'NewsController@NewsDetail');
    Route::post('/deletenews', 'NewsController@DeleteNews');
    Route::get('/newsedit/{id}', 'NewsController@NewsEdit');
    Route::post('/newsedit/{id}', 'NewsController@NewsEditSave');
    //end news routes


    //slider routes
    Route::get('/addslider', 'SliderController@AddSliderform');
    Route::post('/addslider', 'SliderController@SaveSlider');
    Route::get('/sliderslist', 'SliderController@SlidersList');
    Route::get('/sliderdetail/{id}', 'SliderController@SliderDetail');
    Route::post('/deleteslider', 'SliderController@DeleteSlider');
    Route::get('/slideredit/{id}', 'SliderController@SliderEdit');
    Route::post('/slideredit/{id}', 'SliderController@SliderEditSave');
    //end slider routes




    Route::post('/addvideo', 'VideosController@SaveVideo');
    Route::post('/deletevideo', 'VideosController@DeleteVideo');
    Route::get('/videoslist', 'VideosController@VideosList');
    Route::get('/videoedit/{id}', 'VideosController@VideoEdit');
    Route::post('/videoedit/{id}', 'VideosController@VideoEditSave');
    Route::get('/videodetail/{id}', 'VideosController@VideoDetail');

});
Route::get('/template_test', function(){
    return view('admins.videolist');
});
Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('need_register', 'Auth\RegisterController@showRegistrationForm')->name('register');


//zero auth 2 dashboard can access only by superadmin
Route::get('/passport', 'ZeroAuthSettingController@index')->name('settings');
//zero auth 2 dashboard can access only by superadmin
