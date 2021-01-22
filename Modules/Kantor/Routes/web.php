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

Route::prefix('master/kantor')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'KantorController@index')->name('kantor');
		Route::get('/get', 'KantorController@get')->name('kantor.datatable');
	    Route::get('/create', 'KantorController@create')->name('kantor.create');
	    Route::get('/show/{id}', 'KantorController@show')->name('kantor.view');
	    Route::get('/edit/{id}', 'KantorController@edit')->name('kantor.edit');
	    Route::post('/store', 'KantorController@store')->name('kantor.store');
	    Route::post('/update/{id}', 'KantorController@update')->name('kantor.update');
		Route::post('/delete/{id}', 'KantorController@delete')->name('kantor.delete');
		Route::get('/get_single_data/{id}', 'KantorController@get_single_data')->name('kantor.single_data');
		Route::get('/get_single_data_lihat/{id}', 'KantorController@get_single_data_lihat')->name('kantor.single_data_lihat');
		Route::get('/select', 'KantorController@getselect2')->name('kantor.select');
	});
});
