<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    // 1. Hiển thị trang thông tin tài khoản
    public function index()
    {
        $user = Auth::user();
        return view('employer.account.index', compact('user'));
    }

    // 2. Cập nhật thông tin cá nhân (Tên, Avatar)
    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        // 1. Validate (Gộp cả tên và avatar)
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Cập nhật thông tin chữ trước
        $user->name = $request->name;

        // 3. Xử lý Avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            if ($user->avatar) {
                $oldPath = str_replace('storage/', '', $user->avatar);
                
                // Dùng disk 'public' để kiểm tra và xóa
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $filename = time() . '_' . $file->getClientOriginalName();
        
            $file->storeAs('avatars', $filename, 'public');

            $user->avatar = 'storage/avatars/' . $filename;
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    // 3. Đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed', // confirmed check với new_password_confirmation
        ], [
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.'
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
