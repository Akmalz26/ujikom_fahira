<?php

use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
Route::get('/logout', 'App\Http\Controllers\DashboardController@logout')->name('dashboard.logout');

Route::get('/', 'App\Http\Controllers\Frontend\HomeController@index')->name('home');
Route::get('shop', 'App\Http\Controllers\Frontend\HomeController@shop')->name('shop');

Route::get('pesan/{id}', 'App\Http\Controllers\PesanController@index');
Route::post('pesan/{id}', 'App\Http\Controllers\PesanController@pesan');
Route::get('check-out', 'App\Http\Controllers\PesanController@check_out');
Route::delete('check-out/{id}', 'App\Http\Controllers\PesanController@delete');

Route::get('konfirmasi-check-out', 'App\Http\Controllers\PesanController@konfirmasi');

Route::get('profile', 'App\Http\Controllers\ProfileController@index');
Route::get('edit-profile', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');;
Route::post('profile', 'App\Http\Controllers\ProfileController@update');

Route::get('history', 'App\Http\Controllers\HistoryController@index');
Route::get('history/{id}', 'App\Http\Controllers\HistoryController@detail');

Route::resource('produk', ProdukController::class);
Route::resource('penjualan', PenjualanController::class);