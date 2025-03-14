<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'me']);


Route::middleware('auth:sanctum')->group(function () {

    // Activities API
    Route::prefix('activities')->group(function () {
        Route::get('/', [ActivityController::class, 'index']);
        Route::post('/', [ActivityController::class, 'store'])->middleware('role:culture_agent');
        Route::get('/{activity}', [ActivityController::class, 'show']);
        Route::put('/{activity}', [ActivityController::class, 'update'])->middleware('role:culture_agent');
        Route::delete('/{activity}', [ActivityController::class, 'destroy'])->middleware('role:culture_agent');

    });

    // Reports API
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index']);
        Route::post('/{activity}', [ReportController::class, 'store'])->middleware('role:culture_agent');
        Route::get('/{report}', [ReportController::class, 'show']);
    });

    // Users API
    Route::get('/users', [UserController::class, 'index'])->middleware('role:admin_hc');
});
