<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\SavedJob; // Import model SavedJob
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class JobController extends Controller
{
    // Hiển thị danh sách jobs ở trang user (Trang chủ)
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->limit(10)->get();
        return view('user.trangchu', compact('jobs'));
    }

    // Xử lý tìm kiếm
    public function timviec(Request $request)
    {
        $keyword = $request->input('keyword');

        $jobs = Job::query()
            ->where('title', 'like', "%$keyword%")
            ->orWhere('location', 'like', "%$keyword%")
            ->orWhere('experience', 'like', "%$keyword%")
            ->get();

        return view('user.timviec', compact('jobs', 'keyword'));
    }

    // Hiển thị chi tiết công việc
    public function show($id)
    {
        $job = Job::findOrFail($id); // nếu không có thì 404
        return view('user.job_detail', compact('job'));
    }

    // Lưu công việc
    public function saveJob($jobId)
    {
        $userId = Auth::id();

        // Kiểm tra xem đã lưu chưa
        $existing = SavedJob::where('user_id', $userId)
                            ->where('job_id', $jobId)
                            ->first();

        if ($existing) {
            return back()->with('info', 'Bạn đã lưu công việc này rồi.');
        }

        SavedJob::create([
            'user_id' => $userId,
            'job_id' => $jobId,
        ]);

       return redirect()->back()->with('save_success', 'Lưu công việc thành công!');
    }

    // Bỏ lưu công việc
    public function unsaveJob($jobId)
    {
        SavedJob::where('user_id', Auth::id())
                ->where('job_id', $jobId)
                ->delete();

        return back()->with('success', 'Đã xoá khỏi danh sách lưu.');
    }

    // Hiển thị danh sách công việc đã lưu (đổi tên từ index() để tránh trùng)
    public function savedJobs()
    {
        $savedJobs = SavedJob::where('user_id', Auth::id())
                             ->with('job')
                             ->latest()
                             ->get();

        return view('user.saved', compact('savedJobs'));
    }
}