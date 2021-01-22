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

Route::prefix('master/karyawan')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'KaryawanController@index')->name('karyawan');
	    Route::get('/create', 'KaryawanController@create')->name('karyawan.create');
	    Route::get('/show/{id}', 'KaryawanController@show')->name('karyawan.view');
	    Route::get('/edit/{id}', 'KaryawanController@edit')->name('karyawan.edit');
	    Route::post('/store', 'KaryawanController@store')->name('karyawan.store');
	    Route::post('/update/{id}', 'KaryawanController@update')->name('karyawan.update');
		Route::post('/delete/{id}', 'KaryawanController@delete')->name('karyawan.delete');
		Route::get('/getdata', 'KaryawanController@getdata')->name('karyawan.getdata');
		Route::get('/selectrole', 'KaryawanController@getselectrole')->name('karyawan.selectrole');
		Route::get('/selectjabatan', 'KaryawanController@getselectjabatan')->name('karyawan.selectjabatan');
		Route::get('/selectkantor', 'KaryawanController@getselectkantor')->name('karyawan.selectkantor');
		Route::get('/selectkantorsingle', 'KaryawanController@getselectkantorsingle')->name('karyawan.selectkantorsingle');
		Route::get('/select', 'KaryawanController@getselect2')->name('karyawan.select');
		Route::get('/get_single_data/{id}', 'KaryawanController@get_single_data')->name('karyawan.single_data');
	});
});
