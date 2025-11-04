<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\UserController;

// Hiển thị form đăng nhập
Route::get('authen/login', [AuthController::class, 'showLoginForm'])->name('login');

// Xử lý gửi form đăng nhập (POST)
Route::post('authen/login', [AuthController::class, 'login']);

// Đăng xuất tài khoản
Route::get('authen/logout', [AuthController::class, 'logout']);

// Hiển thị form đăng ký
Route::get('authen/register', [AuthController::class, 'showRegisterForm']);

// Xử lý gửi form đăng ký (POST)
Route::post('authen/register', [AuthController::class, 'register']);

// Cách 1: render trực tiếp view (ít khi dùng nếu cần dữ liệu động)
Route::get('user/trangchu', function () {
    return view('user.trangchu');
});

// Cách 2: render qua controller — hợp lý hơn vì có thể lấy dữ liệu từ database
Route::get('/user/trangchu', [JobController::class, 'index'])->name('user.trangchu');

// Trang tìm việc (hiển thị danh sách công việc)
Route::get('/user/timviec', [JobController::class, 'timviec']);

// Trang chi tiết 1 công việc cụ thể theo ID
Route::get('jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// Hiển thị thông tin cá nhân (View tĩnh)
Route::get('user/profile', function () {
    return view('user.profile');
})->name('user.profile');

// Nhóm route yêu cầu đăng nhập mới truy cập được
Route::middleware('auth')->group(function () {

    // Form chỉnh sửa thông tin cá nhân
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');

    // Xử lý lưu thay đổi thông tin cá nhân
    Route::post('/user/profile/update', [UserController::class, 'update'])->name('user.profile.update');
});

// Xử lý khi người dùng nộp đơn cho một job cụ thể
Route::post('/jobs/apply/{id}', [JobApplicationController::class, 'store'])->name('jobs.apply');

// Hiển thị danh sách các công việc mà người dùng đã ứng tuyển
Route::get('/user/my-applications', [UserController::class, 'myApplications'])
    ->middleware('auth') // chỉ cho phép user đã đăng nhập xem
    ->name('user.my_applications');
