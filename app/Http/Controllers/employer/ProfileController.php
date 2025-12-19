<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // 1. Hiển thị form sửa thông tin
    public function index()
    {
        // Lấy thông tin employer của user đang đăng nhập
        $employer = Auth::user()->employer;

        // Nếu chưa có (trường hợp lỗi dữ liệu), trả về trang lỗi hoặc tạo mới
        if (!$employer) {
            abort(404, 'Không tìm thấy hồ sơ doanh nghiệp');
        }

        return view('employer.profile.index', compact('employer'));
    }

    // 2. Xử lý cập nhật
    public function update(Request $request)
    {
        $employer = Auth::user()->employer;

        // Validate dữ liệu
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Xử lý dữ liệu để update
        $data = [
            'company_name' => $request->company_name,
            'contact_email' => $request->contact_email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
        ];

        // Xử lý Upload Logo (Nếu người dùng có chọn ảnh mới)
        if ($request->hasFile('logo')) {
            // 1. Xóa ảnh cũ nếu có (để tiết kiệm dung lượng)
            if ($employer->logo && Storage::exists('public/' . $employer->logo)) {
                Storage::delete('public/' . $employer->logo);
            }

            // 2. Lưu ảnh mới vào thư mục storage/app/public/logos
            $path = $request->file('logo')->store('logos', 'public');
            
            // 3. Cập nhật đường dẫn vào mảng data
            $data['logo'] = $path;
        }

        // Cập nhật vào Database
        $employer->update($data);

        return redirect()->back()->with('success', 'Cập nhật thông tin doanh nghiệp thành công!');
    }
}