@extends('admin.layout.index')

@section('title', 'Sửa Danh mục: ' . $category->name)
@section('page-title', 'Sửa Danh mục')

@section('content')
<h1 class="text-3xl fw-bold mb-4">Chỉnh sửa Danh mục: {{ $category->name }}</h1>

<div class="card shadow border-0 rounded-4">
    <div class="card-body p-5">
        
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
            @csrf
            @method('PUT') 

            {{-- Tên Danh mục --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-bold">Tên Danh mục</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Mô tả --}}
            <div class="mb-4">
                <label for="description" class="form-label fw-bold">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.category.manager') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary" style="background-color: var(--primary); border-color: var(--primary);">
                    <i class="fas fa-save"></i> Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection