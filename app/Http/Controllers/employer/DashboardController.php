<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobApplication;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $employerId = Auth::user()->employer->id;

        // 1. Thống kê: Tin đang tuyển (Tính những tin chưa hết hạn)
        $activeJobsCount = Job::where('employer_id', $employerId)
            ->where('deadline', '>=', Carbon::now()) // Chỉ đếm tin còn hạn
            ->count();

        // 2. Thống kê: CV Chờ duyệt (Status = pending)
        $pendingAppsCount = JobApplication::whereHas('job', function($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })->where('status', 'pending')->count();

        // 3. Thống kê: Tổng lượt xem (Tạm thời đếm tổng số Job vì DB chưa có cột 'views')
        // *Gợi ý: Bạn nên thêm cột 'views' vào bảng jobs để chính xác hơn.
        $totalJobs = Job::where('employer_id', $employerId)->count(); 

        // 4. Danh sách 5 Ứng viên mới nhất
        $recentApplications = JobApplication::with(['job', 'user']) // Eager Load để lấy thông tin Job và Tên ứng viên
            ->whereHas('job', function($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->orderBy('created_at', 'desc') // Mới nhất lên đầu
            ->take(5) // Lấy 5 người
            ->get();

        return view('employer.dashboard', compact(
            'activeJobsCount', 
            'pendingAppsCount', 
            'totalJobs', 
            'recentApplications'
        ));
    }
}