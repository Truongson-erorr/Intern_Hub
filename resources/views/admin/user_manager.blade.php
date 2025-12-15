@extends('admin.layout.index')

@section('title', 'Quản lý User')

@section('content')
<style>
    :root {
        --primary: #4361ee;
    }

    /* CARD HIỆN ĐẠI */
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    /* BẢNG DỮ LIỆU HIỆN ĐẠI */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .table-modern thead th {
        background-color: #f8f9fa;
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
        background-color: rgba(67,97,238,0.05); /* tone primary nhẹ */
    }

    .table-modern tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border: none;
        color: #4a5568;
        font-weight: 500;
    }

    /* NÚT HÀNH ĐỘNG */
    .btn-action-group {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
    }

    .btn-modern-edit {
        text-decoration: none;
        background-color: rgba(67,97,238,0.12);
        color: var(--primary);
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .btn-modern-edit:hover {
        background-color: var(--primary);
        color: #fff;
    }

    .btn-modern-delete {
        background-color: rgba(245,101,101,0.12);
        color: #f56565;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .btn-modern-delete:hover {
        background-color: #f56565;
        color: #fff;
    }

    /* THÔNG BÁO */
    .alert-modern {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
    }

    /* TITLE HIỆN ĐẠI */
    .page-title-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .page-title-modern i {
        color: var(--primary); /* icon đồng màu */
        font-size: 2rem;
    }

    /* PHÂN TRANG */
    .pagination-modern .page-link {
        border: none;
        color: var(--primary);
        font-weight: 500;
        border-radius: 8px;
        margin: 0 3px;
    }

    .pagination-modern .page-item.active .page-link {
        background-color: var(--primary);
        color: #fff;
    }
</style>

<h2 class="page-title-modern fw-bold mb-4"><i class="fas fa-users"></i> Quản lý User</h2>

{{-- Thông báo --}}
@if(session('success'))
    <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow border-0 rounded-4">
    <div class="card-header" style="background-color: var(--primary); color: #fff;">
        <h5 class="mb-0 fw-bold">Danh sách User</h5>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Ngày tạo</th>
                        <th class="text-center pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td class="ps-4">{{ $u->id }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->created_at->format('d/m/Y') }}</td>
                        <td class="pe-4">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-modern-edit" title="Chỉnh sửa">Sửa</a>
                                <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa user {{ $u->name }} không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-modern-delete" title="Xóa user">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Không tìm thấy user nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (method_exists($users, 'links'))
    <div class="card-footer bg-transparent border-top">
        <div class="d-flex justify-content-center">
            <div class="pagination-modern">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
