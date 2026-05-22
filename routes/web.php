<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

// Redirect ke halaman login jika akses ke root "/"
Route::get('/', function () {
    return redirect()->route('account.login');
});

Route::get('/login', [LoginController::class, 'index'])->name('account.login');
Route::get('/register', [LoginController::class, 'register'])->name('account.register');
Route::post('/process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('account.logout');


Route::middleware(['auth'])->group(function () {

    // Prefix untuk admin
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


        Route::controller(StoreController::class)->group(function () {
            Route::get('/store', 'index')->name('store.index');
            Route::get('/store/{id}', 'show')->name('store.show'); // Pastikan ada
            Route::post('/store', 'store')->name('store.store');
            Route::put('/store/{id}', 'update')->name('store.update');
            Route::delete('/store/{id}', 'destroy')->name('store.destroy');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/produk', 'index')->name('admin.produk.index');
            Route::get('/produk/{id}', 'show')->name('products.show');
            Route::post('/produk/store', 'store')->name('products.store');
            Route::put('/produk/{id}', 'update')->name('products.update');
            Route::delete('/produk/{id}', 'destroy')->name('products.destroy');
        });

        Route::controller(CheckoutController::class)->group(function () {
            Route::get('/admin/orders', 'history')->name('admin.orders.history');
        });

        Route::get('/admin/reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations.index');
        // Menampilkan daftar reservasi untuk admin
        Route::get('/admin/paket-wisata', [PaketWisataController::class, 'adminIndex'])->name('admin.paketWisata');


    });

    // Prefix untuk customer
    Route::prefix('customer')->middleware('role:customer')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('user.dashboard');
        Route::view('/about', 'user.about')->name('user.about');
        Route::view('/contact', 'user.contact')->name('user.contact');

        Route::controller(ProductController::class)->group(function () {
            Route::get('/produk/{id}', 'show')->name('products.show');
            Route::get('/produk/{id}/detail', 'productDetails')->name('product.details');
            Route::post('/produk/{id}/toggle-like', 'toggleLike')->name('products.toggleLike');
        });

        Route::controller(StoreController::class)->group(function () {
            Route::get('/store', 'listStore')->name('store.list');
            Route::get('/store/{id}', 'show')->name('store.show');
        });

        Route::controller(CheckoutController::class)->group(function () {
            Route::post('/checkout', 'checkout')->name('checkout.process');
            Route::post('/cart/add', 'addToCart')->name('cart.add');
            Route::get('/cart/data', 'getCartData')->name('cart.data');
            Route::post('/cart/remove', 'removeFromCart')->name('cart.remove');

        });

        Route::controller(ContactController::class)->group(function () {
            Route::post('/contacts', 'store')->name('contacts.store');
            Route::delete('/contacts/{id}', 'destroy')->name('contacts.destroy');
        });

        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');

        Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('user.paketWisata');

        Route::post('/reservasi', [PaketWisataController::class, 'store'])->name('reservasi.store');

    });
});
