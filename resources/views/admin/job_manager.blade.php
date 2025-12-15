@extends('admin.layout.index')

@section('title', 'Quản lý Jobs')

@section('content')
{{-- Bổ sung CSS tùy chỉnh cho các nút (đã giữ nguyên) --}}
<style>
    /* CSS TÙY CHỈNH CHO NÚT HÀNH ĐỘNG */
    .btn-custom-edit {
        background-color: #e0f7fa; /* Xanh nhạt */
        color: #00838f; /* Xanh đậm */
        border: 1px solid #b2ebf2;
        transition: all 0.2s;
    }
    .btn-custom-edit:hover {
        background-color: #b2ebf2;
    }
    .btn-custom-delete {
        background-color: #ffebee; /* Đỏ nhạt */
        color: #c62828; /* Đỏ đậm */
        border: 1px solid #ffcdd2;
        transition: all 0.2s;
    }
    .btn-custom-delete:hover {
        background-color: #ffcdd2;
    }
    /* Giới hạn chiều rộng cột cho dữ liệu dài và căn giữa hành động */
    .table td {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .action-col {
        max-width: 180px; 
        white-space: nowrap;
        text-align: center;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="fas fa-briefcase"></i> Quản lý Jobs</h2>
</div>

{{-- Hiển thị thông báo --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- FORM TẠO JOB MỚI (CREATE - INLINE) --}}
<div class="card shadow border-0 rounded-4 mb-4">
    <div class="card-header bg-dark text-white rounded-top-4">Tạo Bài đăng Công việc Mới</div>
    <div class="card-body">
        <form action="{{ route('admin.jobs.store') }}" method="POST">
            @csrf
            <div class="row">
                
                {{-- 1. Tiêu đề Job --}}
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">1. Tiêu đề Job</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                
                {{-- 2. ID Công ty --}}
                <div class="col-md-6 mb-3">
                    <label for="employer_id" class="form-label">2. ID Công ty (Foreign Key)</label>
                    <input type="number" class="form-control" id="employer_id" name="employer_id" value="{{ old('employer_id') }}" placeholder="ID Công ty (Phải có sẵn)" required>
                </div>

                {{-- 3. Địa điểm --}}
                <div class="col-md-4 mb-3">
                    <label for="location" class="form-label">3. Địa điểm</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                </div>
                
                {{-- 4. Lương --}}
                <div class="col-md-4 mb-3">
                    <label for="salary" class="form-label">4. Lương</label>
                    <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" placeholder="VD: Thỏa thuận" required>
                </div>
                
                {{-- 5. Kinh nghiệm --}}
                <div class="col-md-4 mb-3">
                    <label for="experience" class="form-label">5. Kinh nghiệm</label>
                    <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience') }}" placeholder="VD: 1 năm / Không yêu cầu" required>
                </div>
                
                {{-- 6. Mô tả ngắn & Nút Thêm --}}
                <div class="col-md-10 mb-3">
                     <label for="description" class="form-label">6. Mô tả ngắn</label>
                    <textarea class="form-control" id="description" name="description" rows="2" required>{{ old('description') }}</textarea>
                </div>
                <div class="col-md-2 d-flex align-items-end mb-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> Thêm Job
                    </button>
                </div>

                {{-- KHÔNG CÓ TRƯỜNG ẨN (hidden) NÀO VÌ TẤT CẢ ĐÃ HIỂN THỊ HOẶC ĐƯỢC GÁN MẶC ĐỊNH TRONG CONTROLLER --}}

            </div>
        </form>
    </div>
</div>

{{-- BẢNG HIỂN THỊ CÔNG VIỆC (READ) (Giữ nguyên) --}}
<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <table class="table table-hover align-middle table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Công ty</th>
                    <th>Địa điểm</th>
                    <th>Lương</th>
                    <th>Kinh nghiệm</th>
                    <th>Trạng thái</th>
                    <th>Mô tả (Ngắn)</th>
                    <th>Hạn nộp</th>
                    <th class="text-center action-col">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ Str::limit($job->title, 30) }}</td>
                    
                    {{-- XỬ LÝ DỮ LIỆU N/A --}}
                    <td>
                        {{ $job->company ?? $job->location ?? 'N/A' }} 
                    </td>
                    
                    <td>{{ $job->location ?? 'Không rõ' }}</td>
                    <td>{{ $job->salary ?? 'Thỏa thuận' }}</td>
                    <td>{{ $job->experience ?? '0 năm' }}</td>
                    
                    <td>
                        {{-- Hiển thị trạng thái (1=Duyệt, 2=Từ chối, 0=Chờ) --}}
                        @if ($job->status == 1)
                            <span class="badge bg-success">Đã duyệt</span>
                        @elseif ($job->status == 2)
                            <span class="badge bg-danger">Đã từ chối</span>
                        @else
                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                        @endif
                    </td>
                    
                    {{-- Hiển thị mô tả ngắn gọn --}}
                    <td>{{ Str::limit($job->description, 30) }}</td>
                    <td>{{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') : 'N/A' }}</td>

                    <td class="action-col d-flex justify-content-center gap-2">
                        
                        {{-- NÚT HÀNH ĐỘNG (DUYỆT VÀ TỪ CHỐI CHỈ HIỆN KHI CHỜ DUYỆT) --}}
                        @if ($job->status == 0)
                            <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" style="display:inline;" title="Duyệt bài đăng">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" style="display:inline;" title="Từ chối bài đăng">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-secondary btn-sm" style="background-color: #6c757d; border-color: #6c757d;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @endif
                        
                        {{-- NÚT SỬA (Edit) - CSS tùy chỉnh --}}
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-sm btn-custom-edit" title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>

                        {{-- NÚT XÓA (Delete) - CSS tùy chỉnh --}}
                        <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa công việc này không?');" title="Xóa công việc">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-custom-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Không tìm thấy công việc nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- THÊM PHÂN TRANG (Nếu Controller dùng paginate) --}}
        @if (method_exists($jobs, 'links'))
        <div class="d-flex justify-content-center mt-3">
            {{ $jobs->links() }} 
        </div>
        @endif
    </div>
</div>

@endsection