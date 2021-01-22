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

Route::prefix('master/role')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'RoleController@index')->name('role.index');
		Route::get('/getdata', 'RoleController@get_data')->name('role.datatable');
		Route::get('/create', 'RoleController@create')->name('role.create');
	    Route::get('/lihat/{id}', 'RoleController@lihat')->name('role.lihat');
	    Route::get('/lihatdetail/{id}', 'RoleController@lihatDetail')->name('roledetail.lihatdetail');
		Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
		Route::get('/editdetail/{id}', 'RoleController@editDetail')->name('roledetail.editdetail');
		Route::post('/store', 'RoleController@store')->name('role.store');
		Route::get('/get_single_data/{id}', 'RoleController@get_single_data')->name('role.single_data');
		Route::post('/update/{id}', 'RoleController@update')->name('role.update');
		Route::post('/delete/{id}', 'RoleController@delete')->name('role.delete');
		Route::get('/select', 'RoleController@getselect2')->name('role.select');
	});
});
