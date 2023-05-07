<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\LoginController;

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
//     if (@auth()->user()->roles->slug == "administrator") {
//         return redirect()->route('dashboard-admin');
//     }
//     return view('login');
// });

Route::get('/', [HomePagesController::class, 'index'])->name('home');
Route::get('/produk/{produk}', [HomePagesController::class, 'produk'])->name('produk');

// Route::get('/cart/{produk}', [CartController::class, 'index']);


Route::middleware(['auth', 'user-access:buyer'])->group(function () {
    Route::put('/produk/chekcout/{produk}', [HomePagesController::class, 'checkout'])->name('checkout.buyer');
    Route::post('/ordered', [HomePagesController::class, 'order']);
    Route::get('/my-order', [HomePagesController::class, 'myorder'])->name('my.order');

    // Route for Cart
    Route::get('/cart-list', [CartController::class, 'index'])->name('cart');
    // Route Cart for API
    Route::post('/cart',[CartController::class, 'addToCart'])->name('add-cart');
    Route::put('/cart', [CartController::class, 'updateToCart'])->name('update-cart');
    Route::delete('/cart', [CartController::class, 'deleteCartList'])->name('delete-cart');
    // End Route for Cart

    Route::get('/paid-order/{transaksi:kode_transaksi}', [HomePagesController::class, 'paidorder'])->name('paid.order');
    Route::put('/paid-order/{transaksi:kode_transaksi}', [HomePagesController::class, 'paid'])->name('paid.myorder');
});

Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'auth']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [LoginController::class,'register'])->name('register')->middleware('guest');
Route::post('/register', [LoginController::class,'store']);

Route::middleware(['auth', 'user-access:administrator'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('dashboard-admin');
    Route::get('admin/report', [ReportController::class, 'index']);
    Route::resource('/admin/users', UsersController::class)->except('show');
    Route::resource('/admin/kategori', KategoriController::class)->except('show');
    Route::resource('/admin/produk', ProdukController::class)->except('show');
    Route::resource('/admin/order', OrderController::class)->except('edit');
});
