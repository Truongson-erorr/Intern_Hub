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

Route::middleware('auth')->group(function () {
    // Lưu công việc vào danh sách yêu thích (Saved Jobs)
    Route::post('/jobs/{id}/save', [JobController::class, 'saveJob'])->name('jobs.save');
    // Bỏ lưu công việc khỏi danh sách yêu thích
    Route::delete('/jobs/{id}/unsave', [JobController::class, 'unsaveJob'])->name('jobs.unsave');
    // Hiển thị danh sách các công việc đã lưu của user
    Route::get('/saved-jobs', [JobController::class, 'savedJobs'])->name('user.saved');
});

Route::middleware('auth')->group(function () {
    // Gợi ý việc làm phù hợp
    Route::get('/user/recommend-jobs', [UserController::class, 'recommendJobs'])->name('user.recommend_job');
});

// Employer dashboard
Route::middleware(['auth'])->group(function() {
    Route::get('/employer/index', function () {
        $user = auth()->user();

        if (!$user || $user->role !== 'employer') {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập');
        }

        return view('employer.index', ['user' => $user]);
    })->name('employer.dashboard');
});

// admin dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $user = auth()->user();

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập');
        }

        return view('admin.dashboard', ['user' => $user]);
    })->name('admin.dashboard');
});

Route::get('authen/logout', [AuthController::class, 'logout'])->name('authen.logout');

Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

