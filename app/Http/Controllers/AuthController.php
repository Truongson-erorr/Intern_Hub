<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

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
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect theo role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                                 ->with('success', 'Xin chào Admin!');
            }

            if ($user->role === 'employer') {
                return redirect()->route('employer.dashboard')
                                 ->with('success', 'Chào mừng Nhà Tuyển Dụng!');
            }

            // Mặc định user
            return redirect()->route('user.trangchu')
                             ->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ])->withInput($request->only('email'));
    }

    /**
     * Redirect tới Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback từ Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Kiểm tra email đã có trong DB chưa
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Tạo mới user nếu chưa có
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(Str::random(16)), // mật khẩu ngẫu nhiên
                    'role' => 'user',
                ]);
            }

            // Đăng nhập user
            Auth::login($user);

            return redirect()->route('user.trangchu')
                             ->with('success', 'Đăng nhập thành công bằng Google!');
        } catch (\Exception $e) {
            return redirect()->route('login')
                             ->with('error', 'Đăng nhập Google thất bại.');
        }
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
            'password' => Hash::make($request->password),
            'role' => 'user', // mặc định role
        ]);

        Auth::login($user); // đăng nhập ngay sau khi đăng ký
        return redirect()->route('user.trangchu')
                         ->with('success', 'Đăng ký thành công!');
    }

    /**
     * Đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }

    /**
     * Cập nhật avatar
     */
    public function updateAvatar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập trước!');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/avatars', $filename);

            $user->avatar = 'storage/avatars/'.$filename;
            $user->save();

            return back()->with('success', 'Cập nhật avatar thành công!');
        }

        return back()->with('error', 'Không có file ảnh nào được chọn.');
    }
}
