@extends('admin.layout.index')

@section('title', 'Sửa Công ty: ' . $employer->name)
@section('page-title', 'Sửa Thông tin Công ty')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3551d6;
        --gray-light: #f8f9fa;
        --text-muted: #6c757d;
    }

    /* BODY CĂN GIỮA FORM */
    .edit-employer-wrapper {
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

    .form-control {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        width: 100%;
        transition: all 0.25s ease;
        font-size: 1rem;
    }

    .form-control:focus {
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

<div class="edit-employer-wrapper">
    <div class="card-modern">
        <h2 class="page-title-modern"><i class="fas fa-building"></i> Chỉnh sửa Công ty</h2>

        <form method="POST" action="{{ route('admin.employers.update', $employer->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Tên Công ty</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employer->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employer->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employer->phone) }}">
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Địa chỉ</label>
                <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $employer->address) }}</textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="website" class="form-label">Website</label>
                <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $employer->website) }}" placeholder="https://">
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.employer.manager') }}" class="btn btn-modern btn-modern-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-modern btn-modern-primary">
                    <i class="fas fa-save"></i> Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
