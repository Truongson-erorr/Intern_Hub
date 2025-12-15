@extends('admin.layout.index')

@section('title', 'Danh sách CV ứng tuyển')
@section('page-title', 'Danh sách CV ứng tuyển')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3551d6;
        --success: #10b981;
        --warning: #da452b;
        --danger: #ef4444;
        --gray: #6b7280;
        --gray-light: #f8f9fa;
    }

    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .card-header {
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

    .alert-modern {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
    }

    .page-title-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        font-size: 1.75rem;
        font-weight: 700;
    }

    .page-title-modern i {
        color: var(--primary);
        font-size: 2rem;
    }

    a.cv-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
    }

    a.cv-link:hover {
        text-decoration: underline;
    }
</style>

<div class="header-actions mb-4">
    <h2 class="page-title-modern"><i class="fas fa-file-alt"></i> Danh sách CV ứng tuyển</h2>
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
        CV ứng tuyển
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ứng viên</th>
                        <th>Email</th>
                        <th>Công việc</th>
                        <th>CV</th>
                        <th>Giới thiệu</th>
                        <th>Ngày nộp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $index => $app)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $app->user->name ?? 'N/A' }}</td>
                        <td>{{ $app->user->email ?? 'N/A' }}</td>
                        <td>{{ $app->job->title ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="cv-link">
                                Xem CV
                            </a>
                        </td>
                        <td>{{ $app->introduction }}</td>
                        <td>{{ $app->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">Chưa có CV nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
