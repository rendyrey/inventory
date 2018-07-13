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

//Dashboard
Route::get('/','DashboardController@index');
//untuk autentikasi
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('dashboard','DashboardController@index');

//Order Pekerjaan ke Pemotong Pola
Route::get('order_pola','OrderPekerjaanController@order_pola');
Route::post('order_pola','OrderPekerjaanController@tambah');
Route::get('validate_order','OrderPekerjaanController@validate_order');

//gudang
Route::get('gudang','GudangController@index');
Route::post('gudang','GudangController@tambah');
Route::get('gudang/edit/{id}','GudangController@edit');
Route::post('gudang/update/{id}','GudangController@update');

//bahan
Route::get('bahan','BahanController@index');
Route::post('bahan','BahanController@tambah');
Route::get('bahan/edit/{id}','BahanController@edit');
Route::post('bahan/update/{id}','BahanController@update');

//pemotong pola
Route::get('pemotong_pola','PemotongPolaController@index');
Route::post('pemotong_pola','PemotongPolaController@tambah');
Route::get('pemotong_pola/edit/{id}','PemotongPolaController@edit');
Route::post('pemotong_pola/update/{id}','PemotongPolaController@update');

Route::get('produksi','ProduksiController@index');
