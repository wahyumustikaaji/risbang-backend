<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->prefix('problem-statement')->name('problem-statement.')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::resource('categories', CategoryController::class)->except(['index']);
    Route::get('/category/{category:slug}', [StatementController::class, 'index'])->name('category.statements.index');
    Route::resource('categories.statements', StatementController::class)->shallow()->except(['index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
