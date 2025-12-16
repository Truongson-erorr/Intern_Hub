@extends('employer.layout.master')

@section('title', 'Bảng điều khiển')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Dashboard</h2>
        {{-- Link tới route tạo job --}}
        <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary rounded px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i> Đăng tin mới
        </a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card card-modern bg-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-1">Tin đang tuyển</h6>
                        <h2 class="mb-0 fw-bold text-primary">{{ $activeJobsCount }}</h2>
                    </div>
                    <div class="icon-box bg-light rounded-circle p-3 text-primary">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-modern bg-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-1">CV Chờ duyệt</h6>
                        <h2 class="mb-0 fw-bold text-warning">{{ $pendingAppsCount }}</h2>
                    </div>
                    <div class="icon-box bg-light rounded-circle p-3 text-warning">
                        <i class="fas fa-user-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-modern bg-white h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-1">Tổng bài đăng</h6>
                        <h2 class="mb-0 fw-bold text-success">{{ $totalJobs }}</h2>
                    </div>
                    <div class="icon-box bg-light rounded-circle p-3 text-success">
                        <i class="fas fa-file-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-modern">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="fw-bold mb-0">Ứng viên mới nhất</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>Ứng viên</th>
                            <th>Vị trí ứng tuyển</th>
                            <th>Ngày nộp</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentApplications as $app)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($app->user->avatar)
                                            <img src="{{ asset($app->user->avatar) }}"
                                                class="rounded-circle img-thumbnail"
                                                style="width: 30px; height: 30px; object-fit: cover;">
                                        @else
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto fw-bold display-4"
                                                style="width: 30px; height: 30px;">
                                                {{ strtoupper(substr($app->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <strong>{{ $app->user->name ?? 'Người dùng ẩn' }}</strong>
                                    </div>
                                </td>

                                {{-- Tiêu đề Job --}}
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                        {{ $app->job->title ?? 'Tin đã xóa' }}
                                    </span>
                                </td>

                                {{-- Ngày nộp --}}
                                <td>{{ \Carbon\Carbon::parse($app->created_at)->format('d/m/Y') }}</td>

                                {{-- Trạng thái (Xử lý màu sắc) --}}
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-warning text-dark',
                                            'reviewed' => 'bg-info text-white',
                                            'interview' => 'bg-primary text-white',
                                            'hired' => 'bg-success text-white',
                                            'rejected' => 'bg-danger text-white',
                                        ];
                                        $statusLabel = [
                                            'pending' => 'Chờ duyệt',
                                            'reviewed' => 'Đã xem',
                                            'interview' => 'Phỏng vấn',
                                            'hired' => 'Đã tuyển',
                                            'rejected' => 'Từ chối',
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusColors[$app->status] ?? 'bg-secondary' }}">
                                        {{ $statusLabel[$app->status] ?? $app->status }}
                                    </span>
                                </td>

                                {{-- Nút hành động --}}
                                <td>
                                    {{-- Link xem chi tiết CV --}}
                                    <a href="{{ route('employer.candidates.show', $app->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Xem Hồ Sơ
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Chưa có hồ sơ ứng tuyển nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
