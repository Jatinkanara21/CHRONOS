<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminOrderController;

// Public & User Auth
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/watches', [HomeController::class, 'watches'])->name('watches.index');
Route::get('/watch/{id}', [HomeController::class, 'show'])->name('watches.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Auth (Separate login for admin specific URL if needed, or use shared login)
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login'); // Optional if you want distinct admin login
Route::post('/admin/login', [AdminController::class, 'login']);

// Admin Protected
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Watches
    Route::resource('watches', WatchController::class, ['as' => 'admin']);
    
    // Categories (This single line creates all 7 CRUD routes)
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);
});

Route::middleware(['auth'])->group(function () {
    // Cart Routes
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    // Order Routes
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order', [App\Http\Controllers\OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// Admin Order Management (Put inside existing Admin Middleware Group)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // ... existing watches/categories routes ...
    Route::get('/orders', [App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ... your existing routes ...

    // ADD THIS LINE:
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ... other routes ...
    
    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');
});