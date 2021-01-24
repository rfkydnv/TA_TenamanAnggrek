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

Route::prefix('master/komentar')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'KomentarController@index')->name('komentar.index');
	    Route::get('/create', 'KomentarController@create')->name('komentar.create');
        Route::get('/get', 'KomentarController@get')->name('komentar.get');
        Route::get('/single_data/{id}', 'KomentarController@get_single_data')->name('komentar.single_data');
	    Route::get('/show/{id}', 'KomentarController@show')->name('komentar.show');
	    Route::get('/edit/{id}', 'KomentarController@edit')->name('komentar.edit');
	    Route::post('/store', 'KomentarController@store')->name('komentar.store');
	    Route::post('/update/{id}', 'KomentarController@update')->name('komentar.update');
	    Route::post('/delete/{id}', 'KomentarController@delete')->name('komentar.delete');
	});
});
