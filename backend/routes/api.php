<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\AdminCultureController;
use App\Http\Controllers\Api\Admin\CultureTranslationController;
use App\Http\Controllers\Api\CultureController;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\StoryController;

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::apiResource('/cultures', AdminCultureController::class);
        Route::apiResource('cultures.translations', CultureTranslationController::class)
            ->parameters(['cultures' => 'culture', 'translations' => 'translation']);
    });
});

// Public API routes
Route::get('/cultures/{slug}', [CultureController::class, 'show']);
Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/characters/{slug}', [CharacterController::class, 'show']);
Route::get('/stories/{slug}', [StoryController::class, 'show']);
