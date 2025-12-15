@extends('admin.layout.index')

@section('title', 'Quản lý Danh mục')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3551d6;
        --gray-light: #f8f9fa;
        --text-muted: #6c757d;
    }

    /* CARD & TABLE */
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
    }

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
        background-color: rgba(67,97,238,0.05);
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

    .btn-modern-edit, .btn-modern-delete {
        text-decoration: none;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-size: 0.875rem;
        transition: all 0.25s ease;
    }

    .btn-modern-edit {
        background-color: rgba(67,97,238,0.12);
        color: var(--primary);
    }

    .btn-modern-edit:hover {
        background-color: var(--primary);
        color: #fff;
    }

    .btn-modern-delete {
        background-color: rgba(245,101,101,0.12);
        color: #f56565;
    }

    .btn-modern-delete:hover {
        background-color: #f56565;
        color: #fff;
    }

    /* NÚT THÊM MỚI */
    .btn-add-new {
        background-color: var(--primary);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.25s ease;
        box-shadow: 0 4px 15px rgba(67,97,238,0.25);
    }

    .btn-add-new:hover {
        background-color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(67,97,238,0.3);
    }

    /* TITLE & HEADER */
    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem; /* tăng khoảng cách xuống bảng */
    }

    .page-title-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title-modern i {
        color: var(--primary);
        font-size: 2rem;
    }

    /* ALERT */
    .alert-modern {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
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

    /* ==================== DIALOG THÊM MỚI ==================== */
    .custom-dialog-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
        animation: fadeIn 0.3s ease;
    }

    .custom-dialog {
        background: #fff;
        width: 90%;
        max-width: 500px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        overflow: hidden;
        animation: slideUp 0.4s ease;
    }

    .custom-dialog-header {
        background-color: var(--primary);
        color: #fff;
        padding: 1.25rem 1.5rem;
        font-size: 1.2rem;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .custom-dialog-close {
        background: none;
        border: none;
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .custom-dialog-close:hover {
        opacity: 1;
    }

    .custom-dialog-body {
        display: flex;
        flex-direction: column;
        gap: 1.5rem; /* Khoảng cách giữa các ô input */
        padding: 1.5rem;
    }

    .custom-dialog-body .form-control {
        height: 48px;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }

    .custom-dialog-body .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(67,97,238,0.15);
        outline: none;
    }

    .custom-dialog-footer {
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .custom-dialog-footer button {
        padding: 0.65rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        min-width: 100px;
    }

    .btn-cancel {
        background-color: #e2e8f0;
        color: #495057;
        border: none;
    }

    .btn-cancel:hover {
        background-color: #cbd5e0;
    }

    .btn-save {
        background-color: var(--primary);
        color: #fff;
        border: none;
    }

    .btn-save:hover {
        background-color: var(--primary-dark);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<div class="header-actions">
    <h2 class="page-title-modern fw-bold"><i class="fas fa-list"></i> Quản lý Danh mục việc làm</h2>
    
    <button type="button" class="btn-add-new" id="openAddDialog">
        <i class="fas fa-plus"></i> Thêm danh mục mới
    </button>
</div>

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

<div class="card">
    <div class="card-header" style="background-color: var(--primary); color: #fff;">
        <h5 class="mb-0 fw-bold">Danh sách Danh mục việc làm</h5>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Ngày tạo</th>
                        <th class="text-center pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td class="ps-4">{{ $cat->id }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->description ?? '-' }}</td>
                        <td>{{ $cat->created_at ? \Carbon\Carbon::parse($cat->created_at)->format('d/m/Y') : 'N/A' }}</td>
                        <td class="pe-4">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-modern-edit">Sửa</a>
                                <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục «{{ $cat->name }}» không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-modern-delete">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Không tìm thấy danh mục nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (method_exists($categories, 'links'))
    <div class="card-footer bg-transparent border-top">
        <div class="d-flex justify-content-center">
            <div class="pagination-modern">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Custom Dialog Thêm Danh mục --}}
<div class="custom-dialog-overlay" id="addDialogOverlay">
    <div class="custom-dialog">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="custom-dialog-header">
                <div><i class="fas fa-plus-circle me-2"></i> Thêm danh mục mới</div>
                <button type="button" class="custom-dialog-close" id="closeDialog">×</button>
            </div>
            <div class="custom-dialog-body">
                <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục" required>
                <input type="text" class="form-control" name="description" placeholder="Mô tả ngắn (tùy chọn)">
            </div>
            <div class="custom-dialog-footer">
                <button type="button" class="btn-cancel" id="cancelDialog">Hủy</button>
                <button type="submit" class="btn-save">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
    const openBtn = document.getElementById('openAddDialog');
    const overlay = document.getElementById('addDialogOverlay');
    const closeBtn = document.getElementById('closeDialog');
    const cancelBtn = document.getElementById('cancelDialog');

    openBtn.onclick = () => overlay.style.display = 'flex';
    closeBtn.onclick = cancelBtn.onclick = () => overlay.style.display = 'none';
    overlay.onclick = (e) => { if(e.target === overlay) overlay.style.display = 'none'; };
</script>

@endsection