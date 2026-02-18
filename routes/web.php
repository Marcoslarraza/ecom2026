<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ShopController::class, 'products'])->name('shop.products');
Route::get('/product/{product}', [ShopController::class, 'show'])->name('shop.product');
Route::get('/category/{category:slug}', [ShopController::class, 'category'])->name('shop.category');

// Rutas de autenticación de usuario normal
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Productos
    Route::resource('products', ProductController::class);
    
    // Variantes
    Route::resource('variants', VariantController::class);
    Route::patch('variant-options/{option}/price', [VariantController::class, 'updateOptionPrice'])
        ->name('variant-options.update-price');
    
    // Categorías
    Route::resource('categories', CategoryController::class);
});

require __DIR__.'/auth.php';
