@extends('admin.layout.index')

@section('title', 'Quản lý Jobs')

@section('content')

<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3551d6;
        --success: #10b981;
        --success-dark: #059669;
        --warning: #da452b;      
        --warning-dark: #791305;  
        --danger: #ef4444;
        --gray: #6b7280;
        --gray-light: #f8f9fa;
    }

    /* CARD & TABLE */
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .card-header {
        margin-top: 10px;
        background-color: var(--primary);
        color: #fff;
        padding: 1rem 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .table-modern thead th {
        background-color: var(--gray-light);
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem 1.5rem;
        border-bottom: 2px solid #e9ecef;
    }

    .table-modern tbody tr {
        border-bottom: 1px solid #f1f3f4;
    }

    .table-modern tbody tr:hover {
        background-color: rgba(67,97,238,0.05);
    }

    .table-modern tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border: none;
        color: #4a5568;
        font-weight: 500;
    }

    /* ALERT */
    .alert-modern {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
    }

    /* NÚT HÀNH ĐỘNG */
    .action-btn {
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .btn-approve {
        background-color: rgba(16,185,129,0.12);
        color: var(--success);
    }
    .btn-approve:hover {
        background-color: var(--success);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(16,185,129,0.25);
    }

    .btn-reject {
        background-color: rgba(180,83,9,0.12);
        color: var(--warning);
    }
    .btn-reject:hover {
        background-color: var(--warning);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(180,83,9,0.25);
    }

    .btn-edit {
        background-color: rgba(67,97,238,0.12);
        color: var(--primary);
    }
    .btn-edit:hover {
        background-color: var(--primary);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(67,97,238,0.25);
    }

    .btn-delete {
        background-color: rgba(107,114,128,0.12);
        color: var(--gray);
    }
    .btn-delete:hover {
        background-color: var(--gray);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(107,114,128,0.25);
    }

    .action-btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }

    /* TITLE */
    .page-title-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
        /* margin-bottom: 2rem; (Đã bị loại bỏ trong UI mới) */
        font-size: 1.75rem;
        font-weight: 700;
    }

    .page-title-modern i {
        color: var(--primary);
        font-size: 2rem;
    }
    
    /* === CUSTOM DIALOG (MODAL) STYLES === */
    .custom-dialog-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
        animation: fadeIn 0.3s ease;
    }

    .custom-dialog {
        background: #fff;
        width: 90%;
        max-width: 800px; /* TĂNG KÍCH THƯỚC MODAL CHO NHIỀU TRƯỜNG HƠN */
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        overflow: hidden;
        animation: slideUp 0.4s ease;
    }

    .custom-dialog-header {
        background-color: var(--primary);
        color: #fff;
        padding: 1.25rem 1.5rem;
        font-size: 1.2rem;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .custom-dialog-close {
        background: none;
        border: none;
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .custom-dialog-body {
        padding: 1.5rem;
    }

    .custom-dialog-body .form-control {
        min-height: 48px;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    .custom-dialog-body textarea.form-control {
        height: auto;
    }

    .custom-dialog-footer {
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .custom-dialog-footer button {
        padding: 0.65rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        min-width: 100px;
    }

    .btn-cancel {
        background-color: #e2e8f0;
        color: #495057;
        border: none;
    }

    .btn-save {
        background-color: var(--primary);
        color: #fff;
        border: none;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    /* === NÚT THÊM MỚI CHUNG === */
    .btn-add-new {
        margin-top: 30px;
        background-color: var(--primary);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.25s ease;
        box-shadow: 0 4px 15px rgba(67,97,238,0.25);
    }

    .btn-add-new:hover {
        background-color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(67,97,238,0.3);
    }

    /* END CUSTOM DIALOG/MODAL STYLES */
</style>

<div class="header-actions d-flex justify-content-between align-items-center">
    <h2 class="page-title-modern"><i class="fas fa-briefcase"></i> Quản lý Jobs</h2>
    
    {{-- NÚT THÊM MỚI JOB - Mở Custom Dialog --}}
    <button type="button" class="btn-add-new" id="openAddJobDialog">
        <i class="fas fa-plus"></i> Thêm Job mới
    </button>
</div>

{{-- Thông báo --}}
@if(session('success'))
    <div class="alert alert-success alert-modern" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-modern" role="alert">
        <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        Danh sách Công việc
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 180px;">Tiêu đề Công việc</th>
                        <th style="width: 25%;">Mô tả</th>
                        <th style="width: 25%;">Yêu cầu Ứng viên</th>
                        <th style="width: 100px;">Trạng thái</th>
                        <th style="width: 100px;">Ngày tạo</th>
                        <th style="width: 160px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($job->title, 40) }}</td>
                            {{-- ĐÃ SỬA: Hiển thị Mô tả Công việc --}}
                            <td>{{ \Illuminate\Support\Str::limit($job->description, 80) }}</td>
                            {{-- ĐÃ BỔ SUNG: Hiển thị Yêu cầu Ứng viên --}}
                            <td>{{ \Illuminate\Support\Str::limit($job->candidate_requirements, 80) }}</td>
                            <td>
                                @if ($job->status == 1)
                                    <span class="badge badge-success">Đã duyệt</span>
                                @elseif ($job->status == 2)
                                    <span class="badge bg-danger text-white">Đã từ chối</span>
                                @else
                                    <span class="badge badge-warning">Chờ duyệt</span>
                                @endif
                            </td>
                            <td>{{ $job->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="action-btn-group">
                                    @if ($job->status == 0)
                                        <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn btn-approve" title="Duyệt">
                                                <i class="fas fa-check"></i> Duyệt
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="action-btn btn-reject" title="Từ chối">
                                                <i class="fas fa-times"></i> Từ chối
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.jobs.edit', $job->id) }}" class="action-btn btn-edit" title="Sửa">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài đăng «{{ $job->title }}» không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="Xóa">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">Không có bài đăng công việc nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Custom Dialog Thêm Job Mới --}}
<div class="custom-dialog-overlay" id="addJobDialogOverlay">
    <div class="custom-dialog">
        <form action="{{ route('admin.jobs.store') }}" method="POST">
            @csrf
            <div class="custom-dialog-header">
                <div><i class="fas fa-plus-circle me-2"></i> Thêm Job mới</div>
                <button type="button" class="custom-dialog-close" id="closeJobDialog">×</button>
            </div>
            <div class="custom-dialog-body">
                
                <div class="row">
                    {{-- Hàng 1: Tiêu đề và ID Công ty --}}
                    <div class="col-md-8 mb-3">
                        <label for="title-input" class="form-label fw-bold">1. Tiêu đề Công việc (*)</label>
                        <input type="text" class="form-control" id="title-input" name="title" placeholder="Ví dụ: Kỹ sư phần mềm Java" value="{{ old('title') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="employer-id-input" class="form-label fw-bold">2. ID Công ty</label>
                        <input type="number" class="form-control" id="employer-id-input" name="employer_id" placeholder="Để trống nếu chưa liên kết" value="{{ old('employer_id') }}">
                    </div>

                    {{-- Hàng 2: Địa điểm, Lương, Kinh nghiệm (3 cột) --}}
                    <div class="col-md-4 mb-3">
                        <label for="location-input" class="form-label fw-bold">3. Địa điểm (*)</label>
                        <input type="text" class="form-control" id="location-input" name="location" placeholder="Ví dụ: Hà Nội, TP. HCM" value="{{ old('location') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="salary-input" class="form-label fw-bold">4. Mức lương (*)</label>
                        <input type="text" class="form-control" id="salary-input" name="salary" placeholder="Thỏa thuận/10-15 triệu" value="{{ old('salary') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="experience-input" class="form-label fw-bold">5. Kinh nghiệm (*)</label>
                        <input type="text" class="form-control" id="experience-input" name="experience" placeholder="Ví dụ: 0 năm / 1-2 năm" value="{{ old('experience') }}" required>
                    </div>

                    {{-- Hàng 3: Mô tả (Ngắn) --}}
                    <div class="col-12 mb-3">
                        <label for="description-input" class="form-label fw-bold">6. Mô tả Công việc (Ngắn) (*)</label>
                        <textarea class="form-control" id="description-input" name="description" rows="3" placeholder="Mô tả ngắn gọn về công việc và yêu cầu chính" required>{{ old('description') }}</textarea>
                    </div>

                    {{-- Hàng 4: Yêu cầu ứng viên và Thu nhập --}}
                    <div class="col-md-8 mb-3">
                        <label for="candidate_requirements-input" class="form-label fw-bold">7. Yêu cầu Ứng viên</label>
                        <textarea class="form-control" id="candidate_requirements-input" name="candidate_requirements" rows="2" placeholder="Yêu cầu về kỹ năng/bằng cấp">{{ old('candidate_requirements') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="income-input" class="form-label fw-bold">8. Thu nhập</label>
                        <input type="text" class="form-control" id="income-input" name="income" placeholder="Thưởng/phụ cấp" value="{{ old('income') }}">
                    </div>

                    {{-- Hàng 5: Phúc lợi và Thời gian làm việc --}}
                    <div class="col-md-8 mb-3">
                        <label for="benefits-input" class="form-label fw-bold">9. Phúc lợi</label>
                        <textarea class="form-control" id="benefits-input" name="benefits" rows="2" placeholder="Ví dụ: Bảo hiểm, Du lịch">{{ old('benefits') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="work_time-input" class="form-label fw-bold">10. Thời gian làm việc</label>
                        <input type="text" class="form-control" id="work_time-input" name="work_time" placeholder="Ví dụ: Hành chính/Linh hoạt" value="{{ old('work_time') }}">
                    </div>
                    
                    {{-- Hàng 6: Hình thức ứng tuyển, Bằng cấp, Hạn nộp --}}
                    <div class="col-md-4 mb-3">
                        <label for="application_method-input" class="form-label fw-bold">11. Hình thức Ứng tuyển</label>
                        <input type="text" class="form-control" id="application_method-input" name="application_method" placeholder="Online/Qua email" value="{{ old('application_method') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="degree_requirements-input" class="form-label fw-bold">12. Yêu cầu Bằng cấp</label>
                        <input type="text" class="form-control" id="degree_requirements-input" name="degree_requirements" placeholder="Đại học/Cao đẳng" value="{{ old('degree_requirements') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="deadline-input" class="form-label fw-bold">13. Hạn nộp</label>
                        <input type="date" class="form-control" id="deadline-input" name="deadline" value="{{ old('deadline') }}">
                    </div>

                </div>
                
                {{-- Hiển thị lỗi Validation nếu có --}}
                @if($errors->any())
                    <div class="text-danger mt-2" style="font-size: 0.9rem;">
                        Vui lòng kiểm tra lại dữ liệu nhập.
                    </div>
                @endif

            </div>
            <div class="custom-dialog-footer">
                <button type="button" class="btn-cancel" id="cancelJobDialog">Hủy</button>
                <button type="submit" class="btn-save">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
    // === Logic JS cho Custom Dialog Thêm Job ===
    const openJobBtn = document.getElementById('openAddJobDialog');
    const jobOverlay = document.getElementById('addJobDialogOverlay');
    const closeJobBtn = document.getElementById('closeJobDialog');
    const cancelJobBtn = document.getElementById('cancelJobDialog');

    // Mở Dialog
    openJobBtn.onclick = () => jobOverlay.style.display = 'flex';
    
    // Đóng Dialog
    const closeJobDialog = () => jobOverlay.style.display = 'none';
    closeJobBtn.onclick = closeJobDialog;
    cancelJobBtn.onclick = closeJobDialog;
    jobOverlay.onclick = (e) => { if(e.target === jobOverlay) closeJobDialog(); };

    // Tự động mở Dialog nếu có lỗi Validation (chỉ chạy khi có lỗi)
    @if($errors->any())
    // Giả định lỗi Validation liên quan đến Form Job
    jobOverlay.style.display = 'flex';
    @endif
</script>

@endsection