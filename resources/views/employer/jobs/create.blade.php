@extends('employer.layout.master')

@section('title', 'Đăng tin mới')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Tạo Mới Bài Tuyển Dụng<h3>
        <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary rounded px-4">
            <i class="fas fa-arrow-left me-2"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('employer.jobs.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-modern mb-4">
                    <div class="card-header bg-white py-3"><h5 class="fw-bold mb-0">Thông tin công việc</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề công việc <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="VD: Senior Laravel Developer" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ngành nghề <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Chọn ngành nghề --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hạn nộp hồ sơ <span class="text-danger">*</span></label>
                                <input type="date" name="deadline" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả công việc</label>
                            <textarea name="description" class="form-control" rows="5" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Yêu cầu ứng viên</label>
                            <textarea name="candidate_requirements" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card card-modern">
                    <div class="card-header bg-white py-3"><h5 class="fw-bold mb-0">Quyền lợi & Phúc lợi</h5></div>
                    <div class="card-body">
                         <div class="mb-3">
                            <label class="form-label fw-bold">Quyền lợi được hưởng</label>
                            <textarea name="benefits" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thu nhập & Thưởng</label>
                            <textarea name="income" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-modern mb-4">
                    <div class="card-header bg-white py-3"><h5 class="fw-bold mb-0">Chi tiết tuyển dụng</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mức lương <span class="text-danger">*</span></label>
                            <input type="text" name="salary" class="form-control" placeholder="VD: 15 - 20 Triệu" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Số năm kinh nghiệm</label>
                            <input type="number" name="experience" class="form-control" value="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Yêu cầu bằng cấp</label>
                            <input type="text" name="degree_requirements" class="form-control" placeholder="VD: Đại học, Cao đẳng">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa điểm làm việc <span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" required placeholder="Hà Nội, TP.HCM...">
                        </div>
                        
                         <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ cụ thể</label>
                            <input type="text" name="work_location" class="form-control" placeholder="Số 10, đường ABC...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Thời gian làm việc</label>
                            <input type="text" name="work_time" class="form-control" placeholder="Full-time, T2-T6">
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg shadow-sm fw-bold">
                        Đăng tuyển tin này
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection