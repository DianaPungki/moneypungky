<?php

use App\Http\Controllers\Admin\DashboardController as DashboardAdmin;
use App\Http\Controllers\Admin\UserController as UserAdmin;
use App\Http\Controllers\Admin\BankController as BankAdmin;
use App\Http\Controllers\Admin\KategoriController as KategoriAdmin;
use App\Http\Controllers\Admin\TabMasukController as TabMasukAdmin;
use App\Http\Controllers\Admin\TabKeluarController as TabKeluarAdmin;
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
        Route::get('masuk',[TabMasukAdmin::class,'index']);
        Route::post('masuk/add',[TabMasukAdmin::class,'store']);
        Route::post('masuk/edit',[TabMasukAdmin::class,'edit']);
        Route::put('masuk',[TabMasukAdmin::class,'update']);
        Route::delete('masuk',[TabMasukAdmin::class,'destroy']);
        // keluar
        Route::get('keluar',[TabKeluarAdmin::class,'index']);
        Route::post('keluar/add',[TabKeluarAdmin::class,'store']);
        Route::post('keluar/edit',[TabKeluarAdmin::class,'edit']);
        Route::put('keluar',[TabKeluarAdmin::class,'update']);
        Route::delete('keluar',[TabKeluarAdmin::class,'destroy']);
    });

    // perbank
    Route::get('/bank/{bank}',[PerBankAdmin::class,'index']);
    Route::post('/bank/{bank}',[PerBankAdmin::class,'filterkantong']);

    // perkantong
    Route::get('/kantong/{kantong}',[PerkantongAdmin::class,'index']);
});


Route::view('/user', 'admin.users.admin');



