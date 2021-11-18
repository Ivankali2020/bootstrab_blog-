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

/*
this is for blog section route
*/

Route::get('/','BlogController@index')->name('blog.index');
Route::get('/blog/detail/{article_id}','BlogController@show')->name('blog.show');
Route::get('/blog/category/{slug}','BlogController@slug')->name('blog.slug');



Route::view('/about','blog.about')->name('about');

Auth::routes();


Route::get('redirect', 'GoogleController@redirectToGoogle');
Route::get('callback', 'GoogleController@handleGoogleCallback');

Route::middleware('auth')->group(function (){


    Route::get('userManagement','UserManagerController@index')->name('userManagement');
    Route::post('adminUpgrade','UserManagerController@adminUpgrade')->name('adminUpgrade');
    Route::post('banuser','UserManagerController@banuser')->name('banuser');
    Route::post('unBan','UserManagerController@unBan')->name('unBan');
    Route::post('changePassword','UserManagerController@changePassword')->name('changePassword');

});


Route::prefix('profile')->middleware('auth')->group(function (){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('name','ProfileController@name')->name('name');
//    Route::post('updateName','ProfileController@updateName')->name('updateName');
//    Route::post('updateEmail','ProfileController@updateEmail')->name('updateEmail');


    Route::post('update/{name}','ProfileController@updateAll')->name('update');

    Route::get('showPassword','ProfileController@showPassword')->name('showPassword');
    Route::post('updatePassword','ProfileController@updatePassword')->name('updatePassword');

    Route::get('showPhoto','ProfileController@showPhoto')->name('showPhoto');
    Route::post('updatePhoto','ProfileController@updatePhoto')->name('updatePhoto');

    Route::get('showInfo','ProfileController@showInfo')->name('showInfo');
    Route::post('updateInfo','ProfileController@updateInfo')->name('updateInfo');

    Route::post("update-user-info","ProfileController@updateInfo")->name("profile.update.info");

    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');

    Route::get('dataTable','ArticleController@dataTable')->name('dataTable');
    Route::get('dataTable/show','ArticleController@showDataTable')->name('dataTable.show');

    //this is for mainCover route
    Route::get('mainCover/{article}','ArticleController@mainCover')->name('article.mainCover');

    //this is for co_main route
    Route::get('co_main/right/{article}','ArticleController@coMainRight')->name('article.comainright');
    Route::get('co_main/left/{article}','ArticleController@coMainLeft')->name('article.comainleft');
});


