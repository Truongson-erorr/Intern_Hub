<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('employer.layout.index');
});

// Routes đăng nhập, đăng xuất
Route::get('authen/login', [AuthController::class, 'showLoginForm']);
Route::post('authen/login', [AuthController::class, 'login']);
Route::get('authen/logout', [AuthController::class, 'logout']);

// Routes đăng ký
Route::get('authen/register', [AuthController::class, 'showRegisterForm']);
Route::post('authen/register', [AuthController::class, 'register']);

// Trang chủ user
Route::get('user/trangchu', function () {
    return view('user.trangchu');
});
