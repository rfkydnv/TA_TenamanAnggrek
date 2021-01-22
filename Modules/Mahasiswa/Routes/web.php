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

Route::prefix('master/mahasiswa')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){ 
		Route::get('/select2', 'MahasiswaController@getselect2')->name('mahasiswa.select2');
		Route::get('/', 'MahasiswaController@index')->name('mahasiswa.index');
        Route::get('/get', 'MahasiswaController@get_data')->name('mahasiswa.datatable');
        Route::get('/create', 'MahasiswaController@create')->name('mahasiswa.create');
        Route::get('/show', 'MahasiswaController@show');
        Route::get('/edit/{id}', 'MahasiswaController@edit')->name('mahasiswa.edit');
        Route::get('/get_single_data/{id}', 'MahasiswaController@get_single_data')->name('mahasiswa.single_data');
		Route::get('/lihat/{id}', 'MahasiswaController@lihat')->name('mahasiswa.lihat');
	    Route::post('/store', 'MahasiswaController@store')->name('mahasiswa.store');
	    Route::post('/fileUpload', 'MahasiswaController@fileUpload')->name('mahasiswa.fileUpload');
		Route::post('/update/{id}', 'MahasiswaController@update')->name('mahasiswa.update');
		Route::post('/delete/{id}', 'MahasiswaController@delete')->name('mahasiswa.delete');
		Route::get('/form', 'MahasiswaController@form');
		Route::get('/test-validate', 'MahasiswaController@testValidate');
	});
});
