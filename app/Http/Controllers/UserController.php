<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\JobApplication;
use App\Models\Job;

class UserController extends Controller
{
    /**
     * Hiển thị form chỉnh sửa thông tin cá nhân
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    /**
     * Cập nhật thông tin người dùng
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'resume' => 'nullable|string|max:255',
            'desired_position' => 'nullable|string|max:100',
            'industry' => 'nullable|string|max:100',
            'experience' => 'nullable|string',
            'expected_salary' => 'nullable|string|max:100',
            'skills' => 'nullable|string',
            'education' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->resume = $request->resume;
        $user->desired_position = $request->desired_position;
        $user->industry = $request->industry;
        $user->experience = $request->experience;
        $user->expected_salary = $request->expected_salary;
        $user->skills = $request->skills;
        $user->education = $request->education;

        // upload avatar nếu có
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/avatars', $filename);
            $user->avatar = 'storage/avatars/' . $filename;
        }
        $user->save();
        return redirect()->route('user.profile.edit')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function myApplications()
    {
        $applications = JobApplication::where('user_id', auth()->id())
            ->with('job')
            ->latest()
            ->get();

        return view('user.my_applications', compact('applications'));
    }

    public function recommendJobs()
    {
        $user = auth()->user();

        if (
            !$user->industry &&
            !$user->experience &&
            !$user->expected_salary
        ) {
            return view('user.recommend_job', [
                'recommendedJobs' => collect()
            ]);
        }

        $jobs = Job::query()
            ->where('title', 'like', "%{$user->industry}%")
            ->orWhere('description', 'like', "%{$user->industry}%")
            ->take(20)
            ->get();

        $suggestedIds = \App\Services\GeminiService::suggestJobs(
            $user->industry ?? '',
            $user->experience ?? '',
            $user->expected_salary ?? '',
            $jobs
        );

        $recommendedJobs = collect();

        if (!empty($suggestedIds)) {
            $recommendedJobs = Job::whereIn('id', $suggestedIds)->get();
        }

        return view('user.recommend_job', compact('recommendedJobs'));
    }


    public function uploadCv(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|mimes:pdf,doc,docx|max:5120', // Tối đa 5MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('cv_file')) {
            // Xóa file cũ nếu tồn tại
            if ($user->cv_path && file_exists(public_path($user->cv_path))) {
                @unlink(public_path($user->cv_path));
            }

            $file = $request->file('cv_file');
            $filename = time() . '_cv_' . $user->id . '.' . $file->getClientOriginalExtension();

            // Lưu vào thư mục public/uploads/cvs
            $file->move(public_path('uploads/cvs'), $filename);

            $user->cv_path = 'uploads/cvs/' . $filename;
            $user->save();

            return back()->with('success', 'Tải lên CV thành công!');
        }

        return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    }

    // Hàm để toggle trạng thái tìm kiếm (is_public)
    public function togglePublic(Request $request)
    {
        $user = Auth::user();
        $user->is_public = $request->is_public ? 1 : 0;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function messages()
    {
        $user = Auth::user();

        // Lấy danh sách tin nhắn gửi đến sinh viên này
        $messages = \App\Models\Message::where('receiver_id', $user->id)
            ->with('sender.employer') // Lấy kèm thông tin công ty từ quan hệ sender -> employer
            ->latest()
            ->get();

        // Đánh dấu tất cả là đã đọc khi sinh viên mở hộp thư
        \App\Models\Message::where('receiver_id', $user->id)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        return view('user.messages', compact('messages'));
    }
    public function acceptInvitation($id)
    {
        $message = \App\Models\Message::where('id', $id)
            ->where('receiver_id', auth()->id())
            ->firstOrFail();

        $message->update(['status' => 'accepted']);

        return back()->with('success', 'Bạn đã xác nhận lời mời! Nhà tuyển dụng sẽ sớm liên hệ với bạn.');
    }
}
