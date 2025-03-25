<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\OrderController;

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

// Admin-only routes
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::resource('food_items', FoodItemController::class);
//     Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
// });

// Routes accessible to both Admin and Cashier
Route::middleware('auth')->group(function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::resource('food_items', FoodItemController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';