<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\{
    AdminController,
    ApplicationManagerController,
    CategoryController,
    EmployerManagerController,
    JobManagerController,
    UserManagerController,
};
use App\Http\Controllers\{
    AuthController,
    JobApplicationController,
    JobController,
    UserController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'employer':
                return redirect()->route('employer.dashboard');
            case 'user':
                // Nếu là sinh viên thì có thể cho ở lại trang chủ hoặc vào trang riêng
                return view('user.trangchu');
            default:
                return view('user.trangchu');
        }
    }

    // Nếu chưa đăng nhập thì hiện trang chủ chung
    return view('user.trangchu');
})->name('home');

// Authentication
Route::prefix('authen')->name('authen.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Google OAuth
Route::prefix('auth/google')->name('auth.google.')->group(function () {
    Route::get('/redirect', [AuthController::class, 'redirectToGoogle'])->name('redirect');
    Route::get('/callback', [AuthController::class, 'handleGoogleCallback'])->name('callback');
});

// Jobs (Public)
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/trangchu', [JobController::class, 'index'])->name('trangchu');
    Route::get('/timviec', [JobController::class, 'timviec'])->name('timviec');
});

Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Profile
    Route::prefix('user/profile')->name('user.profile.')->group(function () {
        Route::get('/', fn() => view('user.profile'))->name('index');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/update', [UserController::class, 'update'])->name('update');
    });

    // Job Applications
    Route::post('/jobs/{id}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/user/my-applications', [UserController::class, 'myApplications'])->name('user.my_applications');


    // Saved Jobs
    Route::prefix('user/saved')->name('user.saved.')->group(function () {
        Route::get('/', [JobController::class, 'savedJobs'])->name('index');
        Route::delete('/{id}', [JobController::class, 'unsave'])->name('destroy');
        Route::post('/{id}', [JobController::class, 'saveJob'])->name('store');
        Route::delete('/{id}', [JobController::class, 'unsaveJob'])->name('destroy');
    });

    // Job Recommendations
    Route::get('/user/recommend-jobs', [UserController::class, 'recommendJobs'])
        ->name('user.recommend_job');

    Route::prefix('profile')->name('user.')->group(function () {
        Route::post('/cv-upload', [UserController::class, 'uploadCv'])->name('cv.upload');
        Route::post('/cv-toggle-public', [UserController::class, 'togglePublic'])->name('cv.toggle-public');
    });
    // Message 
    Route::get('/my-messages', [UserController::class, 'messages'])->name('user.messages');
    Route::post('/messages/{id}/accept', [UserController::class, 'acceptInvitation'])->name('user.messages.accept');
});

/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/employer.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::resource('users', UserManagerController::class)->except(['show', 'create']);

    // Job Management (Admin)
    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [JobManagerController::class, 'index'])->name('index');
        Route::post('/', [JobManagerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [JobManagerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [JobManagerController::class, 'update'])->name('update');
        Route::delete('/{id}', [JobManagerController::class, 'deleteJob'])->name('delete');
        Route::post('/{id}/approve', [JobManagerController::class, 'approveJob'])->name('approve');
        Route::patch('/{id}/reject', [JobManagerController::class, 'rejectJob'])->name('reject');
    });

    // Application Management
    Route::get('/applications', [ApplicationManagerController::class, 'index'])->name('applications.index');

    // Category Management
    Route::resource('categories', CategoryController::class)->except(['show', 'create']);

    // Employer Management (Admin)
    Route::resource('employers', EmployerManagerController::class)->except(['show', 'create']);
});
