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

Route::prefix('select-2')->group(function() {
	Route::middleware(['auth'])->group(function(){
		Route::get('/{table}-{prefix}-{key}-{value}/get', 'Select2HandlerController@get')->name('select2handler.get');
		Route::get('/{table}-{prefix}-{key}-{value}/getSales', 'Select2HandlerController@getSales')->name('select2handler.getSales');
		Route::get('/{table}-{prefix}-{key}-{value}/getProduk', 'Select2HandlerController@getProduk')->name('select2handler.getProduk');
		Route::get('/getKasBank', 'Select2HandlerController@getKasBank')->name('select2handler.getKasBank');
		Route::get('/getZona', 'Select2HandlerController@getZona')->name('select2handler.getZona');
        Route::get('/get-kode-rek-config-finance', 'Select2HandlerController@getFinanceConfigRek');
	});
});
