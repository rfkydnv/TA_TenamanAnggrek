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

Route::prefix('master/artikel')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'ArtikelController@index')->name('artikel.index');
	    Route::get('/create', 'ArtikelController@create')->name('artikel.create');
        Route::get('/get', 'ArtikelController@get')->name('artikel.get');
        Route::get('/single_data/{id}', 'ArtikelController@get_single_data')->name('artikel.single_data');
	    Route::get('/show/{id}', 'ArtikelController@show')->name('artikel.show');
	    Route::get('/edit/{id}', 'ArtikelController@edit')->name('artikel.edit');
	    Route::post('/store', 'ArtikelController@store')->name('artikel.store');
	    Route::post('/update/{id}', 'ArtikelController@update')->name('artikel.update');
	    Route::post('/delete/{id}', 'ArtikelController@delete')->name('artikel.delete');
	});
});
