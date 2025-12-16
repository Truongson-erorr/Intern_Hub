@extends('employer.layout.master')

@section('title', 'Chi tiết hồ sơ')

@section('content')
    <div class="mb-4">
        <a href="{{ route('employer.candidates.index') }}" class="btn btn-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-2"></i> Quay lại danh sách
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card card-modern text-center p-4 h-100">
                <div class="mb-3 mx-auto">
                    {{-- Nếu user có avatar thì hiện, không thì hiện chữ cái đầu --}}
                    @if ($application->user->avatar)
                        <img src="{{ asset($application->user->avatar) }}" class="rounded-circle img-thumbnail"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto fw-bold display-4"
                            style="width: 120px; height: 120px;">
                            {{ strtoupper(substr($application->user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h4 class="fw-bold">{{ $application->user->name }}</h4>
                <p class="text-muted mb-4">{{ $application->job->title }}</p>

                <hr>

                <div class="text-start mt-4">
                    <p><i class="fas fa-envelope me-2 text-primary"></i> {{ $application->user->email }}</p>
                    <p><i class="fas fa-phone me-2 text-primary"></i> {{ $application->user->phone ?? 'Chưa cập nhật' }}</p>
                    <p><i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        {{ $application->user->address ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-modern h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Thông tin hồ sơ</h5>
                    <span class="text-muted small">Nộp ngày: {{ $application->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="card-body">

                    {{-- Lời giới thiệu --}}
                    <div class="mb-4">
                        <label class="fw-bold text-dark mb-2">Lời giới thiệu / Thư ứng tuyển:</label>
                        <div class="p-3 bg-light rounded border">
                            {{ $application->introduction ?? 'Ứng viên không nhập lời giới thiệu.' }}
                        </div>
                    </div>

                    {{-- File CV --}}
                    <div class="mb-4">
                        <label class="fw-bold text-dark mb-2">CV đính kèm:</label>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-3x text-danger me-3"></i>
                            <div>
                                {{-- Logic: Nếu là file PDF thì cho xem online hoặc tải về --}}
                                <a href="{{ route('employer.candidates.download', $application->id) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download me-1"></i> Tải xuống CV
                                </a>
                                <a href="{{ route('employer.candidates.view-cv', $application->id) }}" target="_blank"
                                    class="btn btn-outline-secondary btn-sm ms-2">
                                    <i class="fas fa-eye me-1"></i> Xem trực tiếp
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- FORM CẬP NHẬT TRẠNG THÁI --}}
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">Xử lý hồ sơ</h5>
                        <form action="{{ route('employer.candidates.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-md-8">
                                    <label class="form-label">Thay đổi trạng thái:</label>
                                    <select name="status" class="form-select form-select-lg">
                                        <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>
                                            Chờ duyệt</option>
                                        <option value="reviewed"
                                            {{ $application->status == 'reviewed' ? 'selected' : '' }}>Đã xem</option>
                                        <option value="interview"
                                            {{ $application->status == 'interview' ? 'selected' : '' }}>Mời phỏng vấn
                                        </option>
                                        <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>
                                            Tuyển dụng (Nhận)</option>
                                        <option value="rejected"
                                            {{ $application->status == 'rejected' ? 'selected' : '' }}>Từ chối</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                                        Cập nhật
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
