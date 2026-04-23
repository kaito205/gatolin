<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

// Halaman Utama - Load dari Database
Route::get('/', function () {
    $products = \App\Models\Product::inRandomOrder()->take(4)->get();
    $categories = \App\Models\Category::all();
    return view('welcome', compact('products', 'categories'));
});

// Routes untuk Produk dan Keranjang
Route::get('/produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk');
Route::get('/produk/{id}', [App\Http\Controllers\ProdukController::class, 'show'])->name('produk.show');

// Routes untuk Keranjang
Route::get('/keranjang', [App\Http\Controllers\CartController::class, 'index'])->name('keranjang');
Route::get('/add-to-cart/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('add.to.cart');
Route::get('/buy-now/{id}', [App\Http\Controllers\CartController::class, 'buyNow'])->name('buy.now');
Route::patch('/update-cart', [App\Http\Controllers\CartController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [App\Http\Controllers\CartController::class, 'remove'])->name('remove.from.cart');
Route::post('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('/pesanan', [App\Http\Controllers\OrderController::class, 'index'])->name('pesanan.index')->middleware('auth');
Route::post('/pesanan/{id}/cancel', [App\Http\Controllers\OrderController::class, 'cancel'])->name('pesanan.cancel')->middleware('auth');
Route::delete('/pesanan/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('pesanan.destroy')->middleware('auth');

// Routes untuk User Authentication
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');



// Routes untuk Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/orders/{id}/status', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{id}', [App\Http\Controllers\AdminController::class, 'deleteOrder'])->name('admin.orders.delete');
    Route::get('/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/products/create', [App\Http\Controllers\AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [App\Http\Controllers\AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/products/{id}/update', [App\Http\Controllers\AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('admin.products.delete');
});
