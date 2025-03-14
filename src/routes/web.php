<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;

/*
|----------------------------------------------------------------------|
| Web Routes                                                           |
|----------------------------------------------------------------------|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Auth Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes that require authentication
Route::middleware('auth')->group(function () {

    // Dashboard Routes
    Route::prefix('culture')->middleware('role:culture_agent')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'cultureAgentDashboard'])->name('culture.dashboard');
    });

    Route::prefix('division')->middleware('role:division_head')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'divisionHeadDashboard'])->name('division.dashboard');
    });

    Route::prefix('admin')->middleware('role:admin_hc')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminHCDashboard'])->name('admin.dashboard');
    });

    // Activities Routes
    Route::prefix('culture')->middleware('role:culture_agent')->group(function () {
        Route::get('/activities', [ActivityController::class, 'index'])->name('culture.activities.index');
        Route::get('/activities/create', [ActivityController::class, 'create'])->name('culture.activities.create');
        Route::post('/activities', [ActivityController::class, 'store'])->name('culture.activities.store');
        Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('culture.activities.edit');
        Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('culture.activities.update');
        Route::post('/activities/{activity}/update-status', [ActivityController::class, 'updateStatus'])->name('culture.activities.update-status');
        Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('culture.activities.destroy');
    });

    Route::prefix('division')->middleware('role:division_head')->group(function () {
        Route::get('/activities', [ActivityController::class, 'index'])->name('division.activities.index');
        Route::put('/activities/{activity}/approve-head', [ActivityController::class, 'approveByHead'])->name('division.activities.approve-head');
        Route::put('/activities/{activity}/reject-head', [ActivityController::class, 'rejectByHead'])->name('division.activities.reject-head');
    });

    Route::prefix('admin')->middleware('role:admin_hc')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminHCDashboard'])->name('admin.dashboard');
        Route::get('/activities', [ActivityController::class, 'index'])->name('admin.activities.index');
        Route::put('/activities/{activity}/approve-admin', [ActivityController::class, 'approveByAdmin'])->name('admin.activities.approve-admin');
        Route::put('/activities/{activity}/reject-admin', [ActivityController::class, 'rejectByAdmin'])->name('admin.activities.reject-admin');
    });


    // Reports Routes
    Route::prefix('culture')->middleware('role:culture_agent')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('culture.reports.index');
        Route::get('/reports/create', [ReportController::class, 'create'])->name('culture.reports.create');
        Route::post('/reports', [ReportController::class, 'store'])->name('culture.reports.store');
        Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('culture.reports.edit');
        Route::put('/reports/{report}', [ReportController::class, 'update'])->name('culture.reports.update');
        Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('culture.reports.destroy');
    });

    Route::prefix('division')->middleware('role:division_head')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('division.reports.index');
        Route::get('/reports/{report}', [ReportController::class, 'show'])->name('division.reports.show');
    });

    Route::prefix('admin')->middleware('role:admin_hc')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
        Route::get('/reports/{report}', [ReportController::class, 'show'])->name('admin.reports.show');
    });
});
