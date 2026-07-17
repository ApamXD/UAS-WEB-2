<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/catalog', [FrontController::class, 'catalog'])->name('front.catalog');
Route::get('/car/{car}', [FrontController::class, 'detail'])->name('front.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\Admin\CarController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('cars', CarController::class);
        Route::post('cars/{car}/toggle-featured', [CarController::class, 'toggleFeatured'])->name('cars.toggleFeatured');
    });
});

require __DIR__.'/auth.php';
