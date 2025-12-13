<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerManagerController extends Controller
{
    // PHƯƠNG THỨC INDEX CŨ CỦA BẠN (ĐÃ GIỮ NGUYÊN)
    public function index()
    {
        // Thay get() bằng paginate(10) là tốt hơn cho dữ liệu lớn
        $employers = Employer::orderBy('id', 'desc')->paginate(10);
        return view('admin.employer_manager', compact('employers'));
    }

    /**
     * BỔ SUNG: Hiển thị form chỉnh sửa Công ty (Edit) - Ánh xạ admin.employers.edit
     */
    public function edit($id)
    {
        $employer = Employer::findOrFail($id);
        // Trả về view: resources/views/admin/employers/edit.blade.php
        return view('admin.edit_employer_manager', compact('employer'));
    }

    /**
     * BỔ SUNG: Xử lý lưu thay đổi Công ty (Update) - Ánh xạ admin.employers.update
     */
    public function update(Request $request, $id)
    {
        $employer = Employer::findOrFail($id);

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employers,email,' . $employer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
        ]);

        // Cập nhật dữ liệu
        $employer->name = $request->input('name');
        $employer->email = $request->input('email');
        $employer->phone = $request->input('phone');
        $employer->address = $request->input('address');
        $employer->website = $request->input('website');
        
        $employer->save();

        return redirect()->route('admin.employer.manager')->with('success', 'Đã cập nhật thông tin công ty thành công.');
    }

    /**
     * BỔ SUNG: Xóa Công ty (Delete) - Ánh xạ admin.employers.delete
     */
    public function delete($id)
    {
        $employer = Employer::findOrFail($id);
        
        $employerName = $employer->name;
        $employer->delete();

        return redirect()->route('admin.employer.manager')->with('success', "Đã xóa công ty '$employerName' thành công.");
    }
}