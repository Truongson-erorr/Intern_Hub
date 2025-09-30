<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập
     */
    public function showLoginForm()
    {
        return view('authen.login');
    }

    /**
     * Xử lý đăng nhập
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // bảo mật session
            return redirect()->intended('user/trangchu')
                             ->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ])->withInput($request->only('email'));
    }

    /**
     * Hiển thị form đăng ký
     */
    public function showRegisterForm()
    {
        return view('authen.register');
    }

    /**
     * Xử lý đăng ký
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // hash mật khẩu
            'role' => 'user', // mặc định role
        ]);

        Auth::login($user); // đăng nhập ngay sau khi đăng ký
        return redirect('user/trangchu')->with('success', 'Đăng ký thành công!');
    }

    /**
     * Đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('authen/login')->with('success', 'Đăng xuất thành công!');
    }

    /**
     * Cập nhật avatar
     */
    public function updateAvatar(Request $request)
    {
        if (!Auth::check()) {
            return redirect('authen/login')->with('error', 'Vui lòng đăng nhập trước!');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('public/avatars', $filename);

            $user->avatar = 'storage/avatars/'.$filename;
            $user->save();

            return back()->with('success', 'Cập nhật avatar thành công!');
        }

        return back()->with('error', 'Không có file ảnh nào được chọn.');
    }
}
