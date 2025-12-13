@extends('admin.layout.index')

@section('title', 'Quản lý Công việc - InternHub')
@section('page-title', 'Quản lý Jobs')

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
        margin-bottom: 2rem;
        font-size: 1.75rem;
        font-weight: 700;
    }

    .page-title-modern i {
        color: var(--primary);
        font-size: 2rem;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title-modern"><i class="fas fa-briefcase"></i> Quản lý Jobs</h2>
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
                        <th>ID</th>
                        <th>Tiêu đề Công việc</th>
                        <th>Công ty</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->company ?? 'N/A' }}</td>
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
                                            <button type="submit" class="action-btn btn-approve">
                                                <i class="fas fa-check"></i> Duyệt
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="action-btn btn-reject">
                                                <i class="fas fa-times"></i> Từ chối
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.jobs.edit', $job->id) }}" class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài đăng «{{ $job->title }}» không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">Không có bài đăng công việc nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
