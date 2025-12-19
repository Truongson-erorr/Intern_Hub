<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;

class CandidateController extends Controller
{
    // 1. Danh sách tất cả ứng viên nộp vào công ty
    public function index()
    {
        $employerId = Auth::user()->employer->id;

        // Logic: Lấy các Application MÀ Job của nó thuộc về Employer này
        $applications = JobApplication::with(['user', 'job']) // Eager Load user và job để query nhanh hơn
            ->whereHas('job', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('employer.candidates.index', compact('applications'));
    }

    // 2. Xem chi tiết hồ sơ & CV
    public function show($id)
    {
        $employerId = Auth::user()->employer->id;

        // Tìm đơn ứng tuyển, kèm check bảo mật (phải thuộc employer này)
        $application = JobApplication::with(['user', 'job'])
            ->whereHas('job', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->findOrFail($id);

        // Tự động chuyển trạng thái từ 'pending' -> 'reviewed' khi NTD xem hồ sơ lần đầu
        if ($application->status == 'pending') {
            $application->status = 'reviewed';
            $application->save();
        }

        return view('employer.candidates.show', compact('application'));
    }

    // 3. Cập nhật trạng thái (Mời phỏng vấn / Từ chối / Nhận)
    public function updateStatus(Request $request, $id)
    {
        $employerId = Auth::user()->employer->id;

        $application = JobApplication::whereHas('job', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })
            ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,reviewed,interview,rejected,hired'
        ]);

        $application->status = $request->status;
        $application->save();

        // Gợi ý mở rộng: Tại đây có thể gửi Email thông báo cho sinh viên (dùng Laravel Mail)

        return redirect()->back()->with('success', 'Đã cập nhật trạng thái hồ sơ.');
    }

    // 4. Tải CV về máy
    public function downloadCv($id)
    {
        $employerId = Auth::user()->employer->id;
        $application = JobApplication::whereHas('job', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })->findOrFail($id);

        $filePath = storage_path('app/public/' . $application->cv_path);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return back()->with('error', 'File CV không tồn tại');
    }

    public function viewCv($id)
    {
        $employerId = Auth::user()->employer->id;

        // 1. Tìm Application và check quyền sở hữu (Bảo mật)
        $application = JobApplication::whereHas('job', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })->findOrFail($id);

        // 2. Xác định đường dẫn file
        // Lưu ý: Tùy lúc upload bạn dùng disk nào. 
        // Nếu upload code là: $file->store('cvs', 'public') -> Thì file nằm ở storage/app/public/cvs/...
        $filePath = storage_path('app/public/' . $application->cv_path);

        // Kiểm tra file có tồn tại không
        if (!file_exists($filePath)) {
            abort(404, 'File CV không tồn tại trên hệ thống.');
        }

        // 3. Trả về file để trình duyệt hiển thị (Stream) thay vì download
        return response()->file($filePath);
    }
}
