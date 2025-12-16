<?php

use App\Http\Controllers\Admin\ApplicationManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagerController;
use App\Http\Controllers\Admin\JobManagerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployerManagerController;

require __DIR__.'/employer.php';
// Hiển thị form đăng nhập
Route::get('authen/login', [AuthController::class, 'showLoginForm'])->name('login');

// Xử lý gửi form đăng nhập (POST)
Route::post('authen/login', [AuthController::class, 'login']);

// Đăng xuất tài khoản
Route::get('authen/logout', [AuthController::class, 'logout'])->name('authen.logout');

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

// Tìm việc & chi tiết job
Route::get('/user/timviec', [JobController::class, 'timviec']);
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// Profile 
Route::get('/user/profile', function () {
    return view('user.profile');
})->name('user.profile');

// USER cần đăng nhập
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::post('/user/profile/update', [UserController::class, 'update'])->name('user.profile.update');

    // Ứng tuyển
    Route::post('/jobs/apply/{id}', [JobApplicationController::class, 'store'])->name('jobs.apply');

    // Việc đã ứng tuyển
    Route::get('/user/my-applications', [UserController::class, 'myApplications'])
        ->name('user.my_applications');

    // Saved jobs
    Route::post('/jobs/{id}/save', [JobController::class, 'saveJob'])->name('jobs.save');
    Route::delete('/jobs/{id}/unsave', [JobController::class, 'unsaveJob'])->name('jobs.unsave');
    Route::get('/saved-jobs', [JobController::class, 'savedJobs'])->name('user.saved');

    // Gợi ý việc làm
    Route::get('/user/recommend-jobs', [UserController::class, 'recommendJobs'])
        ->name('user.recommend_job');
});

// //EMPLOYER
// Route::middleware('auth')->group(function () {
//     Route::get('/employer/index', function () {
//         $user = auth()->user();

//         if (!$user || $user->role !== 'employer') {
//             return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập');
//         }

//         return view('employer.index', ['user' => $user]);
//     })->name('employer.dashboard');
// });

//ADMIN
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User
    Route::get('/users', [UserManagerController::class, 'index'])->name('user.manager');
    Route::get('/users/{id}/edit', [UserManagerController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}/update', [UserManagerController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserManagerController::class, 'delete'])->name('users.delete');

    // Job
    Route::get('/jobs', [JobManagerController::class, 'index'])->name('job.manager');
    Route::post('/jobs', [JobManagerController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobManagerController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}/update', [JobManagerController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobManagerController::class, 'deleteJob'])->name('jobs.delete');
    Route::post('/jobs/{id}/approve', [JobManagerController::class, 'approveJob'])->name('jobs.approve');
    Route::patch('/jobs/{id}/reject', [JobManagerController::class, 'rejectJob'])->name('jobs.reject');

    // Application manager 
    Route::get('/application_job_manager', [ApplicationManagerController::class, 'index'])
        ->name('application_job');

    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.manager');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    // Employer
    Route::get('/employers', [EmployerManagerController::class, 'index'])->name('employer.manager');
    Route::post('/employers', [EmployerManagerController::class, 'store'])->name('employers.store');
    Route::get('/employers/{id}/edit', [EmployerManagerController::class, 'edit'])->name('employers.edit');
    Route::put('/employers/{id}/update', [EmployerManagerController::class, 'update'])->name('employers.update');
    Route::delete('/employers/{id}', [EmployerManagerController::class, 'delete'])->name('employers.delete');

});

