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
Route::get('order','OrderPekerjaanController@order');
Route::post('order','OrderPekerjaanController@tambah');
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

//produksi
Route::get('produksi','ProduksiController@index');
Route::get('produksi/tambah','ProduksiController@tambah');
Route::post('produksi/tambah','ProduksiController@simpan');
Route::get('produksi/edit/{id}','ProduksiController@edit');
Route::post('produksi/update/{id}','ProduksiController@update');

//model
Route::get('model','ModelController@index');
Route::post('model','ModelController@tambah');
Route::get('model/edit/{id}','ModelController@edit');
Route::post('model/update/{id}','ModelController@update');

//warna
Route::get('warna','WarnaController@index');
Route::post('warna','WarnaController@tambah');
Route::get('warna/edit/{id}','WarnaController@edit');
Route::post('warna/update/{id}','WarnaController@update');

//pola
Route::get('pola','PolaController@index');
Route::post('pola','PolaController@tambah');
Route::get('pola/edit/{id}','PolaController@edit');
Route::post('pola/update/{id}','PolaController@update');

//label
Route::get('label','LabelController@index');
Route::get('label/edit/{id}','LabelController@edit');
Route::post('label','LabelController@tambah');
Route::post('label/update/{id}','LabelController@update');

//list order
Route::get('list_order','ListOrderController@index');
Route::get('list_order/edit/{id}','ListOrderController@edit');
Route::post('list_order/update','ListOrderController@terima_proses');
