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

Route::prefix('master/jabatan')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'JabatanController@index')->name('jabatan.index');
	    Route::get('/create', 'JabatanController@create')->name('jabatan.create');
        Route::get('/get', 'JabatanController@get')->name('jabatan.get');
        Route::get('/single_data/{id}', 'JabatanController@get_single_data')->name('jabatan.single_data');
	    Route::get('/show/{id}', 'JabatanController@show')->name('jabatan.show');
	    Route::get('/edit/{id}', 'JabatanController@edit')->name('jabatan.edit');
	    Route::post('/store', 'JabatanController@store')->name('jabatan.store');
	    Route::post('/update/{id}', 'JabatanController@update')->name('jabatan.update');
	    Route::post('/delete/{id}', 'JabatanController@delete')->name('jabatan.delete');
	});
});
