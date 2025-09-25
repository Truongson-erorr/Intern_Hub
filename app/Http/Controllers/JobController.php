<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    // Hiển thị danh sách jobs ở trang user
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
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
}
