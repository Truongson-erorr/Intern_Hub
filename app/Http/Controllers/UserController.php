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

    public function edit()
    {
        $user = auth()->user();
        $categories = Category::all();

        return view('user.edit', compact('user', 'categories'));
    }
}
