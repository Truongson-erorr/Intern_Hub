<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;
use App\Models\Job;

class JobApplicationController extends Controller
{
    // Middleware đảm bảo user đã login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $jobId)
    {
        // Debug kiểm tra user
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập trước khi ứng tuyển.');
        }

        $userId = Auth::id(); // ID người đăng nhập
        $job = Job::find($jobId);

        if (!$job) {
            return redirect()->back()->with('error', 'Công việc không tồn tại.');
        }

        // Validate dữ liệu
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
            'introduction' => 'required|string|max:2000',
        ]);

        // Upload CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Tạo đơn ứng tuyển
        JobApplication::create([
            'job_id' => $jobId,
            'user_id' => $userId,
            'cv_path' => $cvPath,
            'introduction' => $request->introduction,
        ]);

        return redirect()->back()->with('success', 'Ứng tuyển thành công!');
    }
}
