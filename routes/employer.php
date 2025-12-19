<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Employer\CandidateController;
use App\Http\Controllers\Employer\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\Employer\DashboardController;

// Gom nhóm tất cả route của Employer vào đây
// Middleware 'auth': Bắt buộc đăng nhập
// Middleware 'employer': Bắt buộc phải là Role Employer (cái ta vừa tạo)

// Route đăng ký Employer (KHÔNG auth)
Route::prefix('employer')->name('employer.')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegisterEmployerForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'registerEmployer'])
        ->name('register.submit');
});

// Route Employer sau khi đăng nhập
Route::prefix('employer')->name('employer.')->middleware(['auth', 'employer'])->group(function () {

    // 1. Dashboard
    // URL: /employer/dashboard
    // Name: employer.dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Route manage job of employer
    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [EmployerJobController::class, 'index'])->name('index');
        Route::get('/create', [EmployerJobController::class, 'create'])->name('create');
        Route::post('/store', [EmployerJobController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EmployerJobController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [EmployerJobController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EmployerJobController::class, 'destroy'])->name('destroy');
    });

    // 3. Route manage profile
    Route::prefix('profile')->name('profile.')->group(function () {
        // Hiển thị form
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        // Xử lý update (POST)
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
    });

    // 4. Route for candidates
    Route::prefix('candidates')->name('candidates.')->group(function () {
        Route::get('/', [CandidateController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [CandidateController::class, 'show'])->name('show');
        Route::post('/update-status/{id}', [CandidateController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/download/{id}', [CandidateController::class, 'downloadCv'])->name('download');
        Route::get('/view-cv/{id}', [CandidateController::class, 'viewCv'])->name('view-cv');
    });
});