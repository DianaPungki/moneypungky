<?php

use App\Http\Controllers\Admin\DashboardController as DashboardAdmin;
use App\Http\Controllers\Admin\UserController as UserAdmin;
use App\Http\Controllers\Admin\BankController as BankAdmin;
use App\Http\Controllers\Admin\KategoriController as KategoriAdmin;
use App\Http\Controllers\Admin\TransaksiController as TransaksiAdmin;
use App\Http\Controllers\Admin\PerBankController as PerBankAdmin;
use App\Http\Controllers\Admin\PerkantongController as PerkantongAdmin;
use App\Http\Controllers\Auth\LoginController;
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



Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('login-functionality',[LoginController::class,'login_functionality'])->name('login.functionality');
Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::middleware('auth:admin')->prefix('admin')->group(function() {
    Route::get('/',[DashboardAdmin::class,'index'])->name('dashboardadmin');
    
    Route::prefix('users')->group(function() {
        Route::get('admin',[UserAdmin::class,'index']);

    });

    Route::prefix('/data')->group(function() {
        Route::get('/bank',[BankAdmin::class,'index']);
        Route::post('/bank/add',[BankAdmin::class,'store']);
        Route::post('/bank/edit',[BankAdmin::class,'edit']);
        Route::put('/bank',[BankAdmin::class,'update']);
        Route::delete('/bank',[BankAdmin::class,'destroy']);

        // kategori
        Route::get('/kategori',[KategoriAdmin::class,'index']);
        Route::post('/kategori/add',[KategoriAdmin::class,'store']);
        Route::post('/kategori/edit',[KategoriAdmin::class,'edit']);
        Route::put('/kategori',[KategoriAdmin::class,'update']);
        Route::delete('/kategori',[KategoriAdmin::class,'destroy']);

    });

    Route::prefix('transaksi')->group(function() {
        // masuk
        Route::get('masuk',[TransaksiAdmin::class,'index_masuk']);
        Route::post('masuk/add',[TransaksiAdmin::class,'store_masuk']);
        Route::post('masuk/edit',[TransaksiAdmin::class,'edit_masuk']);
        Route::put('masuk',[TransaksiAdmin::class,'update_masuk']);
        Route::delete('masuk',[TransaksiAdmin::class,'destroy_masuk']);
        // keluar
        Route::get('keluar',[TransaksiAdmin::class,'index_keluar']);
        Route::post('keluar/add',[TransaksiAdmin::class,'store_keluar']);
        Route::post('keluar/edit',[TransaksiAdmin::class,'edit_keluar']);
        Route::put('keluar',[TransaksiAdmin::class,'update_keluar']);
        Route::delete('keluar',[TransaksiAdmin::class,'destroy_keluar']);
    });

    // perbank
    Route::get('/bank/{bank}',[PerBankAdmin::class,'index']);

    // perkantong
    Route::get('/kantong/{kantong}',[PerkantongAdmin::class,'index']);
});


Route::view('/user', 'admin.users.admin');



