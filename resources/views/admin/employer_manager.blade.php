@extends('admin.layout.index')

@section('title', 'Quản lý Công ty')
@section('page-title', 'Quản lý Công ty')

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
        background-color: var(--gray-danger);
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
        background-color: rgba(223, 95, 95, 0.12);
        color: var(--warning);
    }
    .btn-delete:hover {
        background-color: var(--warning);
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
    <h2 class="page-title-modern"><i class="fas fa-building"></i> Quản lý Công ty</h2>
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
        Danh sách Công ty
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên công ty</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Website</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employers as $employer)
                    <tr>
                        <td>{{ $employer->id }}</td>
                        <td>{{ $employer->name }}</td>
                        <td>{{ $employer->email }}</td>
                        <td>{{ $employer->phone }}</td>
                        <td>{{ Str::limit($employer->address, 40) }}</td>
                        <td>{{ $employer->website }}</td>
                        <td>{{ $employer->created_at ? $employer->created_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <div class="action-btn-group">
                                <a href="{{ route('admin.employers.edit', $employer->id) }}" class="action-btn btn-edit">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <form action="{{ route('admin.employers.delete', $employer->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa công ty {{ $employer->name }} không?');">
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
                            <td colspan="8" class="text-center py-6 text-gray-500">Không tìm thấy công ty nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
