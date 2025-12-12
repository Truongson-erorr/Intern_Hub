<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Cần để băm mật khẩu

class UserManagerController extends Controller
{
    // PHƯƠNG THỨC CŨ CỦA BẠN (GIỮ NGUYÊN)
    public function index()
    {
        // Thay all() bằng paginate() là tốt hơn cho dữ liệu lớn, nhưng tôi giữ nguyên code cũ của bạn
        $users = User::all();
        return view('admin.user_manager', compact('users'));
    }

    /**
     * BỔ SUNG: Hiển thị form chỉnh sửa User (Edit) - Ánh xạ admin.users.edit
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // Trả về view: resources/views/admin/users/edit.blade.php
        return view('admin.edit_user_manager', compact('user'));
    }

    /**
     * BỔ SUNG: Xử lý lưu thay đổi User (Update) - Ánh xạ admin.users.update
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 1. Validation (Bắt buộc phải có để đảm bảo dữ liệu hợp lệ)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // confirmed yêu cầu trường password_confirmation
            'role' => 'required|in:user,employer,admin',
        ]);

        // 2. Cập nhật dữ liệu
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        
        // Cập nhật password nếu có nhập
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.user.manager')->with('success', 'Đã cập nhật thông tin user thành công.');
    }

    /**
     * BỔ SUNG: Xóa User (Delete) - Ánh xạ admin.users.delete
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        
        // Tránh xóa chính Admin đang đăng nhập (Nên có)
        if ($user->id === auth()->id()) {
             return redirect()->back()->with('error', 'Bạn không thể xóa tài khoản của chính mình.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.user.manager')->with('success', "Đã xóa user '$userName' thành công.");
    }
}