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

Route::prefix('')->group(function() {
	Route::get('/', 'HomeController@index')->name('home.index');
	Route::get('/galery', 'HomeController@index_galery')->name('home.index_galery');
	Route::get('/edit/{id}', 'HomeController@edit')->name('home.edit');
	Route::get('/single_data/{id}', 'HomeController@get_single_data')->name('home.single_data');
	Route::get('/about/', 'HomeController@about')->name('home.about');
	Route::get('/contact/', 'HomeController@contact')->name('home.contact');
	Route::post('/store', 'HomeController@store')->name('home.store');
	Route::middleware(['auth','authCore'])->group(function(){
	    Route::get('/create', 'HomeController@create')->name('home.create');
        Route::get('/get', 'HomeController@get')->name('home.get');
	    Route::get('/show/{id}', 'HomeController@show')->name('home.show');
	    Route::post('/update/{id}', 'HomeController@update')->name('home.update');
	    Route::post('/delete/{id}', 'HomeController@delete')->name('home.delete');
	});
});
