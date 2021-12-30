<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth'], function ()
{
	//AP Management
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('view-search-account','NpkController@viewSearchAccount')->name('view-search-account');
	Route::post('search-account','NpkController@searchAccount')->name('search-account');
	Route::get('view-cek-pembayaran','NpkController@viewCekPembayaran')->name('view-cek-pembayaran');
	Route::post('cek-pembayaran','NpkController@cekPembayaran')->name('cek-pembayaran');
	Route::get('cetak-pembayaran','NpkController@cetakPembayaran')->name('cetak-pembayaran');
	Route::post('surat-pembayaran','NpkController@suratPembayaran')->name('surat-pembayaran');
	Route::get('export-to-excel','NpkController@exportToExcel')->name('export-to-excel');
	Route::get('view-create-npk','NpkController@viewCreateNpk')->name('view-create-npk');
	Route::post('create-npk','NpkController@createNpk')->name('create-npk');
	Route::get('view-data-npk','NpkController@viewDataNpk')->name('view-data-npk');
	Route::get('search-npk','NpkController@searchNpk')->name('search-npk');
	Route::get('view-create-npk-lanjutan/{id}','NpkController@viewCreateNpkLanjutan')->name('view-create-npk-lanjutan/{id}');
	Route::get('view-edit-npk/{id}','NpkController@viewEditNpk')->name('view-edit-npk/{id}');
	Route::post('edit-npk','NpkController@editNpk')->name('edit-npk');
	Route::get('view-print-npk/{id}','NpkController@viewPrintNpk')->name('view-print-npk/{id}');
	Route::post('print-npk/{id}','NpkController@printNpk')->name('print-npk/{id}');
	Route::get('delete-npk/{id}','NpkController@delete')->name('delete-npk/{id}');
	Route::get('search-segmen/{account}','NpkController@searchSegmen')->name('search-segmen/{account}');
	//Marketing
	Route::get('marketing', 'HomeController@marketingDashboard')->name('marketing');
	Route::get('export-to-excel-mkt','NpkController@exportToExcelMkt')->name('export-to-excel-mkt');
	Route::get('view-create-npk-mkt','NpkController@viewCreateNpkMkt')->name('view-create-npk-mkt');
	Route::post('create-npk-mkt','NpkController@createNpkMkt')->name('create-npk-mkt');
	Route::get('view-data-npk-mkt','NpkController@viewDataNpkMkt')->name('view-data-npk-mkt');
	Route::post('search-npk-mkt','NpkController@searchNpkMkt')->name('search-npk-mkt');
	Route::get('view-create-npk-mkt-lanjutan/{id}','NpkController@viewCreateNpkMktLanjutan')->name('view-create-npk-mkt-lanjutan/{id}');
	Route::get('view-edit-npk-mkt-lanjutan/{id}','NpkController@viewEditNpkMkt')->name('view-edit-npk-mkt-lanjutan/{$id}');
	Route::post('edit-npk-mkt','NpkController@editNpkMkt')->name('edit-npk-mkt');
	Route::get('delete-npk-mkt/{id}','NpkController@deleteNpk')->name('delete-npk-mkt/{id}');

	//AP Management & Marketing
	Route::post('search-dashboard-periode','HomeController@searchDashboardPeriode')->name('search-dashboard-periode');
	Route::get('kl-mitra/{mitra}/{periode_awal}/{periode_akhir}','HomeController@getKlMitra')->name('kl-mitra/{mitra}');
	Route::get('kl-mitra-mkt/{mitra}','HomeController@getKlMitraMkt')->name('kl-mitra-mkt/{mitra}');
	Route::get('sp-customer/{customer}','HomeController@getSpCustomer')->name('sp-customer/{customer}');
	Route::get('spnpk','HomeController@SuratPembayaranDashboard')->name('spnpk');
	Route::get('spmkt','HomeController@SuratPembayaranDashboardMkt')->name('spmkt');
	Route::get('spli','HomeController@SuratPembayaranDashboardLi')->name('spli');
	Route::get('spfnc','HomeController@SuratPembayaranDashboardFnc')->name('spfnc');

	Route::get('logout', 'AuthController@logout')->name('logout');
});

Route::get('/admin', 'AdminController@index');
Route::get('/user', 'UserController@index');