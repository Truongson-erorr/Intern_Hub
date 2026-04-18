<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Employer\AccountController;
use App\Http\Controllers\Employer\CandidateController;
use App\Http\Controllers\Employer\DashboardController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
*/

// Public Employer Routes (Không cần đăng nhập)
Route::prefix('employer')->name('employer.')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterEmployerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'registerEmployer'])->name('register.submit');
});

// Protected Employer Routes (Yêu cầu đăng nhập + role employer)
Route::prefix('employer')
    ->name('employer.')
    ->middleware(['auth', 'employer'])
    ->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Job Management (Sử dụng resource route cho CRUD chuẩn)
        Route::resource('jobs', JobController::class)->except(['show']);
        
        // Profile Management
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
        });
        
        // Candidate Management
        Route::prefix('candidates')->name('candidates.')->group(function () {
            Route::get('/', [CandidateController::class, 'index'])->name('index');
            Route::get('/{id}', [CandidateController::class, 'show'])->name('show');
            Route::post('/{id}/status', [CandidateController::class, 'updateStatus'])->name('updateStatus');
            Route::get('/{id}/download', [CandidateController::class, 'downloadCv'])->name('download');
            Route::get('/{id}/view-cv', [CandidateController::class, 'viewCv'])->name('view-cv');
        });
        
        // Account Management
        Route::prefix('account')->name('account.')->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('index');
            Route::post('/update-info', [AccountController::class, 'updateInfo'])->name('updateInfo');
            Route::post('/change-password', [AccountController::class, 'changePassword'])->name('changePassword');
        });
    });