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

Route::prefix('master/anggrek')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'AnggrekController@index')->name('anggrek.index');
	    Route::get('/create', 'AnggrekController@create')->name('anggrek.create');
        Route::get('/get', 'AnggrekController@get')->name('anggrek.get');
        Route::get('/single_data/{id}', 'AnggrekController@get_single_data')->name('anggrek.single_data');
	    Route::get('/show/{id}', 'AnggrekController@show')->name('anggrek.show');
	    Route::get('/edit/{id}', 'AnggrekController@edit')->name('anggrek.edit');
	    Route::post('/store', 'AnggrekController@store')->name('anggrek.store');
	    Route::post('/update/{id}', 'AnggrekController@update')->name('anggrek.update');
	    Route::post('/delete/{id}', 'AnggrekController@delete')->name('anggrek.delete');
	});
});
