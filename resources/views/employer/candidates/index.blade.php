@extends('employer.layout.master')

@section('title', 'Quản lý ứng viên')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Hồ sơ ứng viên</h2>
    </div>

    <div class="card card-modern">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Ứng viên</th>
                        <th>Vị trí ứng tuyển</th>
                        <th>Ngày nộp</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                {{-- Avatar giả định --}}
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 40px; height: 40px;">
                                    {{ strtoupper(substr($app->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $app->user->name }}</h6>
                                    <small class="text-muted">{{ $app->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('employer.jobs.edit', $app->job->id) }}" class="text-decoration-none fw-bold">
                                {{ $app->job->title }}
                            </a>
                        </td>
                        <td>{{ $app->created_at->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $colors = [
                                    'pending' => 'bg-warning text-dark',
                                    'reviewed' => 'bg-info text-white',
                                    'interview' => 'bg-primary text-white',
                                    'hired' => 'bg-success text-white',
                                    'rejected' => 'bg-secondary text-white',
                                ];
                                $labels = [
                                    'pending' => 'Chờ duyệt',
                                    'reviewed' => 'Đã xem',
                                    'interview' => 'Phỏng vấn',
                                    'hired' => 'Đã tuyển',
                                    'rejected' => 'Loại',
                                ];
                            @endphp
                            <span class="badge {{ $colors[$app->status] }}">
                                {{ $labels[$app->status] }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('employer.candidates.show', $app->id) }}" class="btn btn-sm btn-outline-primary shadow-sm">
                                <i class="fas fa-eye me-1"></i> Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Phân trang --}}
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection