<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\JobApplication;
use App\Models\Job;
use App\Models\Category;

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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->resume = $request->resume;
        $user->desired_position = $request->desired_position;
        $user->industry = $request->industry;

        // upload avatar nếu có
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('public/avatars', $filename);
            $user->avatar = 'storage/avatars/'.$filename;
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

        if (!$user->industry) {
            return view('user.recommend_job', [
                'warning' => 'Vui lòng cập nhật ngành nghề chính để hệ thống gợi ý việc làm phù hợp.',
                'recommendedJobs' => collect()
            ]);
        }

        $category = Category::where('name', $user->industry)->first();

        if ($category) {
            $recommendedJobs = Job::where('category_id', $category->id)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        } else {
            $recommendedJobs = collect();
        }

        return view('user.recommend_job', compact('recommendedJobs'));
    }

}
