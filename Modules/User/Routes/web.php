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

Route::prefix('master/user')->group(function() {
	Route::middleware(['auth','authCore'])->group(function(){
		Route::get('/', 'UserController@index')->name('user.index');
		Route::get('/get', 'UserController@get')->name('user.datatable');
		Route::get('/getedit/{id}', 'UserController@getedit')->name('user.getedit');
		Route::get('/create', 'UserController@create')->name('user.create');
		Route::get('/view', 'UserController@show')->name('user.view');
		Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
		Route::get('/create/form1', 'UserController@create2')->name('user.form2');
		Route::post('/store', 'UserController@store')->name('user.store');
		Route::post('/update', 'UserController@update')->name('user.update');
		Route::post('/delete/{id}', 'UserController@delete')->name('user.delete');
	});
});
