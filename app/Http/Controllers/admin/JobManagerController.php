<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;

class JobManagerController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('id', 'asc')->get(); 
        return view('admin.job_manager', compact('jobs'));
    }

    public function approveJob($id)
    {
        $job = Job::findOrFail($id);
        if ($job->status == 1) {
             return redirect()->back()->with('error', 'Bài đăng đã được duyệt trước đó.');
        }
        $job->status = 1; // 1: Đã duyệt
        $job->save();
        return redirect()->back()->with('success', 'Đã duyệt bài đăng công việc thành công!');
    }

    public function deleteJob($id)
    {
        $job = Job::findOrFail($id);
        $jobTitle = $job->title;
        $job->delete();
        return redirect()->back()->with('success', "Đã xóa bài đăng '$jobTitle' thành công.");
    }

    public function rejectJob($id)
    {
        $job = Job::findOrFail($id);
        if ($job->status == 2) {
             return redirect()->back()->with('error', 'Bài đăng đã bị từ chối trước đó.');
        }
        $job->status = 2; // 2: Đã từ chối
        $job->save();
        return redirect()->back()->with('success', 'Đã từ chối bài đăng công việc.');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        // Đây là nơi bạn trả về View chứa form để chỉnh sửa
        // Bạn cần tạo file view này sau: resources/views/admin/jobs/edit.blade.php
        return view('admin.edit_job_manager', compact('job'));
    }

    public function update(Request $request, $id)
    {
    $job = Job::findOrFail($id);

    // Validate nếu cần
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // Cập nhật các trường đúng theo bảng của bạn
    $job->title = $request->title;
    $job->location = $request->location;
    $job->salary = $request->salary;
    $job->experience = $request->experience;
    $job->description = $request->description;
    $job->candidate_requirements = $request->candidate_requirements;
    $job->income = $request->income;
    $job->benefits = $request->benefits;
    $job->work_location = $request->work_location;
    $job->work_time = $request->work_time;
    $job->application_method = $request->application_method;
    $job->degree_requirements = $request->degree_requirements;

    // deadline (định dạng về date)
    if ($request->deadline) {
        $job->deadline = $request->deadline;
    } else {
        $job->deadline = null;
    }

    $job->save();

    return redirect()->route('admin.job.manager')
        ->with('success', 'Cập nhật công việc thành công!');
    }
}
