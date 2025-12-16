<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // --- ĐOẠN CODE MỚI: CHIA SẺ BIẾN CHO SIDEBAR ---
        
        // Chỉ chia sẻ biến $pendingCount cho file layout master của employer
        // Dấu * nghĩa là áp dụng cho mọi view, nhưng để tối ưu ta chỉ nên target layout
        View::composer('employer.layout.master', function ($view) {
            $pendingCount = 0;

            // Chỉ đếm khi đã đăng nhập và là Employer
            if (Auth::check() && Auth::user()->role === 'employer' && Auth::user()->employer) {
                $employerId = Auth::user()->employer->id;

                // Đếm số đơn có trạng thái là 'pending' thuộc về employer này
                $pendingCount = JobApplication::whereHas('job', function($query) use ($employerId) {
                    $query->where('employer_id', $employerId);
                })
                ->where('status', 'pending')
                ->count();
            }

            // Truyền biến sang view
            $view->with('pendingCount', $pendingCount);
        });
    }
}
