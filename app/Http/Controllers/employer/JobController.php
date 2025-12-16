<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Category;

class JobController extends Controller
{
    // 1. Danh sách tin tuyển dụng
    public function index()
    {
        // Lấy Employer Profile của user hiện tại
        $employerId = Auth::user()->employer->id;

        // Lấy danh sách job, phân trang 10 tin/trang
        $jobs = Job::where('employer_id', $employerId)
                    ->with('category') // Eager load để lấy tên danh mục nhanh hơn
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    // 2. Form thêm mới
    public function create()
    {
        // Lấy danh mục để hiển thị trong thẻ <select>
        $categories = Category::all();
        return view('employer.jobs.create', compact('categories'));
    }

    // 3. Xử lý lưu tin mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'salary' => 'required',
            'location' => 'required', // Địa điểm làm việc
            'deadline' => 'required|date|after:today', // Hạn nộp phải sau ngày hôm nay
            'description' => 'required',
        ], [
            'deadline.after' => 'Hạn nộp hồ sơ phải lớn hơn ngày hiện tại.',
        ]);

        // Merge thêm employer_id vào mảng dữ liệu
        $data = $request->all();
        $data['employer_id'] = Auth::user()->employer->id;

        Job::create($data);

        return redirect()->route('employer.jobs.index')->with('success', 'Đăng tin tuyển dụng thành công!');
    }

    // 4. Form sửa tin
    public function edit($id)
    {
        $employerId = Auth::user()->employer->id;
        
        // Tìm job và check xem có đúng là của Employer này không (Bảo mật)
        $job = Job::where('id', $id)->where('employer_id', $employerId)->firstOrFail();
        $categories = Category::all();

        return view('employer.jobs.edit', compact('job', 'categories'));
    }

    // 5. Xử lý cập nhật tin
    public function update(Request $request, $id)
    {
        $employerId = Auth::user()->employer->id;
        $job = Job::where('id', $id)->where('employer_id', $employerId)->firstOrFail();

        $request->validate([
            'title' => 'required|max:255',
            'deadline' => 'required|date',
        ]);

        $job->update($request->all());

        return redirect()->route('employer.jobs.index')->with('success', 'Cập nhật tin thành công!');
    }

    // 6. Xóa tin
    public function destroy($id)
    {
        $employerId = Auth::user()->employer->id;
        $job = Job::where('id', $id)->where('employer_id', $employerId)->firstOrFail();
        
        $job->delete();

        return redirect()->back()->with('success', 'Đã xóa tin tuyển dụng.');
    }
}