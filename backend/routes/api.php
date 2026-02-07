<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CultureController;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\AdminCultureController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/cultures', [AdminCultureController::class, 'index']);
        Route::post('/cultures', [AdminCultureController::class, 'store']);
        Route::get('/cultures/{id}', [AdminCultureController::class, 'show']);
        Route::put('/cultures/{id}', [AdminCultureController::class, 'update']);
        Route::delete('/cultures/{id}', [AdminCultureController::class, 'destroy']);
    });
});

Route::get('/cultures/{slug}', [CultureController::class, 'show']);
Route::get('/characters/{slug}', [CharacterController::class, 'show']);
Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/stories/{slug}', [StoryController::class, 'show']);
