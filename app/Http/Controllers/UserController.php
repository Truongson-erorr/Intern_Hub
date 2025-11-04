<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\JobApplication;

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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->resume = $request->resume;

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
}
