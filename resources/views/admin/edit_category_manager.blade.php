@extends('admin.layout.index')

@section('title', 'Sửa Danh mục: ' . $category->name)
@section('page-title', 'Sửa Danh mục')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3551d6;
        --gray-light: #f8f9fa;
        --text-muted: #6c757d;
    }

    body {
        background-color: #f8f9fa;
    }

    /* Trung tâm màn hình */
    .edit-category-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 3rem 1rem;
    }

    .edit-category-card {
        width: 100%;
        max-width: 600px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .edit-category-card-header {
        background-color: var(--primary);
        color: #fff;
        padding: 1.5rem 2rem;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .edit-category-card-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem; /* Khoảng cách giữa các phần */
    }

    .edit-category-card-body label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .edit-category-card-body .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        font-size: 1rem;
        transition: all 0.2s;
    }

    .edit-category-card-body .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(67,97,238,0.15);
        outline: none;
    }

    .edit-category-card-body .text-danger {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .edit-category-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }

    .edit-category-footer .btn {
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.25s ease;
    }

    .btn-secondary {
        background-color: #e2e8f0;
        color: #495057;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #cbd5e0;
    }

    .btn-primary {
        background-color: var(--primary);
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
    }

</style>

<div class="edit-category-wrapper">
    <div class="edit-category-card">
        <div class="edit-category-card-header">
            <i class="fas fa-edit me-2"></i> Chỉnh sửa Danh mục: {{ $category->name }}
        </div>
        <div class="edit-category-card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('PUT') 

                {{-- Tên Danh mục --}}
                <div>
                    <label for="name">Tên Danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Mô tả --}}
                <div>
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Footer --}}
                <div class="edit-category-footer">
                    <a href="{{ route('admin.category.manager') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu Thay Đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
