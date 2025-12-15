@extends('admin.layout.index')

@section('title', 'Chỉnh sửa User - ' . $user->name)

@section('content')
<style>
    :root {
        --primary: #4361ee;
    }

    /* BODY CĂN GIỮA FORM */
    .edit-user-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 3rem 1rem;
    }

    /* CARD HIỆN ĐẠI */
    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 30px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 600px;
        background: #fff;
        padding: 2rem;
    }

    /* TITLE */
    .page-title-modern {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: #2d3748;
    }

    .page-title-modern i {
        color: var(--primary);
        font-size: 2rem;
    }

    /* FORM HIỆN ĐẠI */
    .form-label {
        font-weight: 600;
        color: #4a5568;
        display: block;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        width: 100%;
        transition: all 0.25s ease;
        font-size: 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(67,97,238,0.2);
    }

    /* KHUNG MARGIN CÁC Ô FORM */
    .form-group {
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
    }

    /* BUTTON HIỆN ĐẠI */
    .btn-modern {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .btn-modern-primary {
        background-color: var(--primary);
        color: #fff;
        border: none;
    }

    .btn-modern-primary:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .btn-modern-secondary {
        background-color: #edf2f7;
        color: var(--primary);
        border: none;
    }

    .btn-modern-secondary:hover {
        background-color: #e2e8f0;
        transform: translateY(-1px);
    }

    /* BUTTONS GROUP */
    .form-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        gap: 1rem;
    }

    /* TEXT ERROR */
    .text-danger {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* RESPONSIVE NHẸ */
    @media(max-width: 640px) {
        .form-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="edit-user-wrapper">
    <div class="card-modern">
        <h2 class="page-title-modern"><i class="fas fa-user-edit"></i> Chỉnh sửa User</h2>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Tên User</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Vai trò (Role)</label>
                <select class="form-select" id="role" name="role">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="employer" {{ $user->role == 'employer' ? 'selected' : '' }}>Employer</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu mới (Bỏ trống nếu không đổi)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới">
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Xác nhận Mật khẩu mới</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu mới">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.user.manager') }}" class="btn btn-modern btn-modern-secondary">
                     Quay lại
                </a>
                <button type="submit" class="btn btn-modern btn-modern-primary">
                    Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
