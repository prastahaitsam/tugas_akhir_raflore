<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController;
use App\Models\Pesanan;
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
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/home', function () {
        return view('pages/admin/home');
    });
});

Route::middleware(['auth:customer'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::delete('/keranjang', [keranjangController::class, 'destroy']);

    Route::post('/checkout', [PesananController::class, 'store']);
});

Route::middleware(['guest'])->group(function () {
    Route::post('/login-proses', [AuthController::class, 'index']);

    Route::get('/login', array('as' => 'login', function () {
        return view('pages/auth/login');
    }));
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::post('/register', [AuthController::class, 'store']);

Route::get('/keranjang', [keranjangController::class, 'index']);
Route::post('/keranjang', [keranjangController::class, 'store']);

Route::get('/pesanan', [PesananController::class, 'index']);

Route::get('/viewproduk', function () {
    return view('pages/user/produk/viewProduk');
});

Route::get('/register', function () {
    return view('pages/auth/register');
});
