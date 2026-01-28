<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\Api\ProblemStatementApiController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return redirect()->route('login');
});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'verified'])->prefix('problem-statement')->name('problem-statement.')->group(function () {
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::resource('categories', CategoryController::class)->except(['index']);
        Route::get('/category/{category:slug}', [StatementController::class, 'index'])->name('category.statements.index');
        Route::resource('categories.statements', StatementController::class)->shallow()->except(['index']);
        
        // Recommendation routes for statements
        Route::post('/statements/{statement}/recommendations/generate', [StatementController::class, 'generateRecommendations'])
            ->name('statements.recommendations.generate');
        Route::delete('/statements/{statement}/recommendations/{researchId}', [StatementController::class, 'deleteRecommendation'])
            ->name('statements.recommendations.delete');
        Route::post('/statements/{statement}/recommendations/reset', [StatementController::class, 'resetRecommendations'])
            ->name('statements.recommendations.reset');
    });

    Route::middleware(['auth', 'verified'])->prefix('recommendation')->name('recommendation.')->group(function () {
        Route::get('/category', [RecommendationController::class, 'index'])->name('category.index');
        Route::get('/{category:slug}', [RecommendationController::class, 'show'])->name('show');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/api/problem-statement', [ProblemStatementApiController::class, 'index']);
});

require __DIR__ . '/auth.php';
