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

Route::prefix('master/konfig')->group(function () {
	Route::middleware(['auth', 'authCore'])->group(function () {
		Route::get('/', 'KonfigController@index')->name('konfig.index');
		Route::get('/get', 'KonfigController@get')->name('konfig.datatable');
		Route::get('/create', 'KonfigController@create')->name('konfig.create');
		Route::get('/view/{id}', 'KonfigController@view')->name('konfig.view');
		Route::get('/edit/{id}', 'KonfigController@edit')->name('konfig.edit');
		Route::get('/getConfig', 'KonfigController@getConfig')->name('konfig.getconfig');
		Route::post('/store', 'KonfigController@store')->name('konfig.store');
		Route::post('/update/{id}', 'KonfigController@update')->name('konfig.update');
		Route::post('/action_edit', 'KonfigController@action_edit')->name('konfig.action_edit');
		Route::post('/delete/{id}', 'KonfigController@edit')->name('konfig.delete');
	});
});
