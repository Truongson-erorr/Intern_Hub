@extends('employer.layout.master')

@section('title', 'Chỉnh sửa tin tuyển dụng')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Chỉnh Sửa Thông Tin Bài Tuyển Dụng<h3>
        <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary rounded px-4">
            <i class="fas fa-arrow-left me-2"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="card card-modern mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Thông tin công việc</h5>
                    </div>
                    <div class="card-body">
                        {{-- Tiêu đề --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề công việc <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required
                                value="{{ old('title', $job->title) }}">
                        </div>

                        <div class="row">
                            {{-- Ngành nghề --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ngành nghề <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Chọn ngành nghề --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $cat->id == $job->category_id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Hạn nộp (Xử lý ngày tháng) --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hạn nộp hồ sơ <span class="text-danger">*</span></label>
                                <input type="date" name="deadline" class="form-control" required
                                    value="{{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}">
                            </div>
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả công việc</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $job->description) }}</textarea>
                        </div>

                        {{-- Yêu cầu --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Yêu cầu ứng viên</label>
                            <textarea name="candidate_requirements" class="form-control" rows="4">{{ old('candidate_requirements', $job->candidate_requirements) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card card-modern">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Quyền lợi & Phúc lợi</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Quyền lợi được hưởng</label>
                            <textarea name="benefits" class="form-control" rows="4">{{ old('benefits', $job->benefits) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thu nhập & Thưởng</label>
                            <textarea name="income" class="form-control" rows="2">{{ old('income', $job->income) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-modern mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Chi tiết tuyển dụng</h5>
                    </div>
                    <div class="card-body">
                        {{-- Mức lương --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mức lương <span class="text-danger">*</span></label>
                            <input type="text" name="salary" class="form-control" required
                                value="{{ old('salary', $job->salary) }}">
                        </div>

                        {{-- Kinh nghiệm --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số năm kinh nghiệm</label>
                            <input type="number" name="experience" class="form-control"
                                value="{{ old('experience', $job->experience) }}">
                        </div>

                        {{-- Bằng cấp --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Yêu cầu bằng cấp</label>
                            <input type="text" name="degree_requirements" class="form-control"
                                value="{{ old('degree_requirements', $job->degree_requirements) }}">
                        </div>

                        {{-- Địa điểm --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa điểm làm việc <span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" required
                                value="{{ old('location', $job->location) }}">
                        </div>

                        {{-- Địa chỉ cụ thể --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ cụ thể</label>
                            <input type="text" name="work_location" class="form-control"
                                value="{{ old('work_location', $job->work_location) }}">
                        </div>

                        {{-- Thời gian làm việc --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thời gian làm việc</label>
                            <input type="text" name="work_time" class="form-control"
                                value="{{ old('work_time', $job->work_time) }}">
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-md shadow-sm fw-bold">
                        Lưu Thay Đổi
                    </button>

                    {{-- Nút hủy --}}
                    <a href="{{ route('employer.jobs.index') }}" class="btn btn-warning btn-md shadow-sm fw-bold">
                        Hủy
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
