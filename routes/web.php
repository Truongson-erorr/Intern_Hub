<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;

// Routes đăng nhập, đăng xuất
Route::get('authen/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('authen/login', [AuthController::class, 'login']);
Route::get('authen/logout', [AuthController::class, 'logout']);

// Routes đăng ký
Route::get('authen/register', [AuthController::class, 'showRegisterForm']);
Route::post('authen/register', [AuthController::class, 'register']);

// Trang chủ user
Route::get('user/trangchu', function () {
    return view('user.trangchu');
});

// Trang chủ employer (danh sách jobs)
Route::get('/user/trangchu', [JobController::class, 'index'])->name('user.trangchu');
Route::get('/user/timviec', [JobController::class, 'timviec']);
Route::get('jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// Trang cá nhân user
Route::get('user/profile', function () {
    return view('user.profile');
})->name('user.profile');

// xử lý apply theo id từng job
Route::post('/jobs/apply/{id}', [JobApplicationController::class, 'store'])->name('jobs.apply');