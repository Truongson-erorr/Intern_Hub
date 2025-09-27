<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    // Hiển thị form login
    public function showLoginForm()
    {
        return view('authen.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Tìm user theo email
        $user = User::where('email', $email)->first();

        // So sánh trực tiếp với mật khẩu plain text
        if ($user && $user->password === $password) {
            Session::put('user', $user);
            return redirect('user/trangchu')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng'])
                     ->withInput($request->only('email'));
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('authen.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password'); // Lưu plain text
        $user->role = 'user'; // mặc định là user
        $user->save();

        // Tự động đăng nhập sau khi đăng ký
        Session::put('user', $user);

        return redirect('authen/login')->with('success', 'Đăng ký thành công!');
    }

    // Đăng xuất
    public function logout()
    {
        Session::forget('user');
        return redirect('authen/login')->with('success', 'Đăng xuất thành công!');
    }

    //update avater
    public function updateAvatar(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập
        if (!Session::has('user')) {
            return redirect('authen/login')->with('error', 'Vui lòng đăng nhập trước!');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Session::get('user');

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();

            // Lưu file vào storage/app/public/avatars
            $path = $file->storeAs('public/avatars', $filename);

            // Cập nhật trường avatar trong DB
            $userModel = User::find($user->id);
            $userModel->avatar = 'storage/avatars/'.$filename;
            $userModel->save();

            // Cập nhật session
            Session::put('user', $userModel);

            return back()->with('success', 'Cập nhật avatar thành công!');
        }

        return back()->with('error', 'Không có file ảnh nào được chọn.');
    }
    
}
