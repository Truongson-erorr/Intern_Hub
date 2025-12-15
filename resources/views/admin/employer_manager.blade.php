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
        margin-top: 10px;
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
        background-color: var(--gray-light); /* Đã sửa lỗi tham chiếu biến CSS không tồn tại */
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
    
    /* === CUSTOM DIALOG (MODAL) STYLES === */
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
        max-width: 600px;
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

    .custom-dialog-body {
        padding: 1.5rem;
    }
    
    .custom-dialog-body .form-control {
        min-height: 48px;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        padding: 0.75rem 1rem;
        font-size: 1rem;
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

    .btn-save {
        background-color: var(--primary);
        color: #fff;
        border: none;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    /* === NÚT THÊM MỚI CHUNG === */
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
</style>

<div class="header-actions d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title-modern"><i class="fas fa-building"></i> Quản lý Công ty</h2>
    
    {{-- NÚT THÊM CÔNG TY MỚI - Mở Custom Dialog --}}
    <button type="button" class="btn-add-new" id="openAddEmployerDialog">
        <i class="fas fa-plus"></i> Thêm Công ty mới
    </button>
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
                        <th class="ps-4">ID</th>
                        <th>Tên công ty</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Website</th>
                        <th>Ngày tạo</th>
                        <th class="text-center pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employers as $employer)
                    <tr>
                        <td class="ps-4">{{ $employer->id }}</td>
                        <td>{{ $employer->name }}</td>
                        <td>{{ $employer->email }}</td>
                        <td>{{ $employer->phone ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($employer->address ?? '-', 40) }}</td>
                        <td>{{ $employer->website ?? '-' }}</td>
                        <td>{{ $employer->created_at ? $employer->created_at->format('d/m/Y') : '-' }}</td>
                        <td class="pe-4">
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


{{-- Custom Dialog Thêm Công ty Mới --}}
<div class="custom-dialog-overlay" id="addEmployerDialogOverlay">
    <div class="custom-dialog">
        {{-- ĐÃ SỬA: Trỏ đến route admin.employers.store --}}
        <form action="{{ route('admin.employers.store') }}" method="POST">
            @csrf
            <div class="custom-dialog-header">
                <div><i class="fas fa-plus-circle me-2"></i> Thêm Công ty mới</div>
                <button type="button" class="custom-dialog-close" id="closeEmployerDialog">×</button>
            </div>
            <div class="custom-dialog-body">
                
                <div class="row">
                    {{-- Hàng 1: Tên Công ty --}}
                    <div class="col-12 mb-3">
                        <label for="name-input" class="form-label fw-bold">1. Tên Công ty (*)</label>
                        <input type="text" class="form-control" id="name-input" name="name" placeholder="Ví dụ: Công ty TNHH ABC" value="{{ old('name') }}" required>
                    </div>
                    
                    {{-- Hàng 2: Email và Điện thoại --}}
                    <div class="col-md-6 mb-3">
                        <label for="email-input" class="form-label fw-bold">2. Email (*)</label>
                        <input type="email" class="form-control" id="email-input" name="email" placeholder="Ví dụ: hr@company.com" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone-input" class="form-label fw-bold">3. Điện thoại</label>
                        <input type="text" class="form-control" id="phone-input" name="phone" placeholder="Số điện thoại liên hệ" value="{{ old('phone') }}">
                    </div>

                    {{-- Hàng 3: Địa chỉ --}}
                    <div class="col-12 mb-3">
                        <label for="address-input" class="form-label fw-bold">4. Địa chỉ</label>
                        <textarea class="form-control" id="address-input" name="address" rows="2" placeholder="Địa chỉ trụ sở chính">{{ old('address') }}</textarea>
                    </div>
                    
                    {{-- Hàng 4: Website --}}
                    <div class="col-12 mb-3">
                        <label for="website-input" class="form-label fw-bold">5. Website</label>
                        <input type="url" class="form-control" id="website-input" name="website" placeholder="Ví dụ: https://www.company.com" value="{{ old('website') }}">
                    </div>
                    
                    {{-- Hiển thị lỗi Validation nếu có --}}
                    @if($errors->any())
                        <div class="text-danger mt-2" style="font-size: 0.9rem;">
                            Vui lòng kiểm tra lại dữ liệu nhập.
                        </div>
                    @endif

                </div>

            </div>
            <div class="custom-dialog-footer">
                <button type="button" class="btn-cancel" id="cancelEmployerDialog">Hủy</button>
                <button type="submit" class="btn-save">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
    // === Logic JS cho Custom Dialog Thêm Công ty ===
    const openEmployerBtn = document.getElementById('openAddEmployerDialog');
    const employerOverlay = document.getElementById('addEmployerDialogOverlay');
    const closeEmployerBtn = document.getElementById('closeEmployerDialog');
    const cancelEmployerBtn = document.getElementById('cancelEmployerDialog');

    // Mở Dialog
    openEmployerBtn.onclick = () => employerOverlay.style.display = 'flex';
    
    // Đóng Dialog
    const closeEmployerDialog = () => employerOverlay.style.display = 'none';
    closeEmployerBtn.onclick = closeEmployerDialog;
    cancelEmployerBtn.onclick = closeEmployerDialog;
    employerOverlay.onclick = (e) => { if(e.target === employerOverlay) closeEmployerDialog(); };

    // Tự động mở Dialog nếu có lỗi Validation (chỉ chạy khi có lỗi)
    @if($errors->any())
    // Giả định lỗi Validation liên quan đến Form Employer
    employerOverlay.style.display = 'flex';
    @endif
</script>

@endsection