<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);

    Route::get('/products/noimage', [ProductController::class, 'noImageIndex'])->name('products.noimage.index');
    Route::get('/products/noimage/{id}', [ProductController::class, 'show'])->name('products.noimage.show');
    Route::resource('products', ProductController::class)->only(['index', 'show', 'update']);
    Route::resource('categories', CategoryController::class);
});
