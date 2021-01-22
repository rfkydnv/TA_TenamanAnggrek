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

Route::prefix('master/roledetail')->group(function() {
	// Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'RoleDetailController@index')->name('roledetail.index');
		Route::get('/getdata', 'RoleDetailController@get_data')->name('roledetail.datatable');
	    Route::get('/create', 'RoleDetailController@create')->name('roledetail.create');
	    Route::get('/edit/{id}', 'RoleDetailController@edit')->name('roledetail.edit');
		Route::get('/lihat/{id}', 'RoleDetailController@show')->name('roledetail.lihat');
		Route::post('/store', 'RoleDetailController@store')->name('roledetail.store');
		Route::post('/update/{id}', 'RoleDetailController@update')->name('roledetail.update');
		Route::post('/delete/{id}', 'RoleDetailController@delete')->name('roledetail.delete');
		Route::get('/get_single_data/{id}', 'RoleDetailController@get_single_data')->name('roledetail.single_data');
		Route::get('/get_single_data_detail/{id}', 'RoleDetailController@get_single_data_detail')->name('roledetail.single_data_detail');
		Route::get('/select2', 'RoleDetailController@getselect2')->name('roledetail.select2');
	// });
});
