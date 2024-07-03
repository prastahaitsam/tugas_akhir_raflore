<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController;
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

Route::middleware(['auth:user'])->group(function () {
    Route::get('/data-produk', [ProdukController::class, 'dataProduk']);
    Route::post('/data-produk', [ProdukController::class, 'store']);
    Route::patch('/data-produk', [ProdukController::class, 'update']);
    Route::delete('/data-produk', [ProdukController::class, 'destroy']);

    Route::get('/data-customer', [CustomerController::class, 'index']);
    Route::post('/data-customer', [CustomerController::class, 'store']);
    Route::patch('/data-customer', [CustomerController::class, 'update']);
    Route::delete('/data-customer', [CustomerController::class, 'destroy']);

    Route::get('/data-user', [UserController::class, 'index']);
    Route::post('/data-user', [UserController::class, 'store']);
    Route::patch('/data-user', [UserController::class, 'update']);
    Route::delete('/data-user', [UserController::class, 'destroy']);

    Route::get('/data-pesanan', [PesananController::class, 'showPesanan']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/home', function () {
        return view('pages/admin/home');
    });
});

Route::middleware(['auth:customer'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::delete('/keranjang', [keranjangController::class, 'destroy']);

    Route::post('/checkout', [PesananController::class, 'store']);
    Route::post('/beli-sekarang', [PesananController::class, 'store']);
    Route::get('/update-transaction-status/{id}', [PesananController::class, 'updateStatusTransaksi']);

    route::get('/profile',[ProfileController::class, 'index']);

    Route::get('/pesanan', [PesananController::class, 'index']);
});

Route::middleware(['guest'])->group(function () {
    Route::post('/login-proses', [AuthController::class, 'login']);

    Route::get('/login', array('as' => 'login', function () {
        return view('pages/auth/login');
    }));
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::post('/register', [AuthController::class, 'store']);

Route::get('/keranjang', [keranjangController::class, 'index']);
Route::post('/keranjang', [keranjangController::class, 'store']);

Route::get('/viewproduk', [ProdukController::class, 'viewproduk']);

Route::get('/register', function () {
    return view('pages/auth/register');
});
