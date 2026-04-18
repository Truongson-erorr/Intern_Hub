<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('authen.login');
    }

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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // mật khẩu ngẫu nhiên
                    'role' => 'user',
                ]);
            }

            Auth::login($user);

            return redirect()->route('user.trangchu')
                ->with('success', 'Đăng nhập thành công bằng Google!');
        } catch (\Exception $e) {
            return redirect()->route('authen.login')
                ->with('error', 'Đăng nhập Google thất bại.');
        }
    }

    public function showRegisterForm()
    {
        return view('authen.register');
    }

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('authen.login')->with('success', 'Đăng xuất thành công!');
    }

    public function updateAvatar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('authen.login')->with('error', 'Vui lòng đăng nhập trước!');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/avatars', $filename);

            $user->avatar = 'storage/avatars/' . $filename;
            $user->save();

            return back()->with('success', 'Cập nhật avatar thành công!');
        }

        return back()->with('error', 'Không có file ảnh nào được chọn.');
    }

    // This Section Below Use For Employer
    public function showRegisterEmployerForm()
    {
        return view('authen.register_employer');
    }
    public function registerEmployer(Request $request)
    {
        // 1. Validate
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Check trùng bảng users
            'password' => 'required|confirmed|min:6',
            'company_name' => 'required|string|max:255',
            // 'company_email' => 'nullable|email|unique:employers,contact_email', // Nếu muốn check trùng cả bảng employers
        ], [
            'email.unique' => 'Email đăng nhập này đã tồn tại.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        DB::beginTransaction();
        try {
            // 2. Tạo User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'employer',
            ]);

            // 3. Tạo Employer Profile
            Employer::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,

                // --- SỬA LỖI TẠI ĐÂY ---
                // Lấy email đăng nhập làm email liên hệ luôn
                'contact_email' => $request->email,

                'phone' => $request->company_phone ?? null,
                'website' => $request->company_website ?? null,
                'address' => $request->company_address ?? null,
                'is_approved' => 0
            ]);

            DB::commit();

            return redirect()->route('authen.login')
                ->with('success', 'Đăng ký thành công! Vui lòng chờ tài khoản của bạn được kích hoạt.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log lỗi ra để debug nếu cần: \Log::error($e->getMessage());
            return back()->with('error', 'Lỗi hệ thống: ' . $e->getMessage())->withInput();
        }
    }
}
