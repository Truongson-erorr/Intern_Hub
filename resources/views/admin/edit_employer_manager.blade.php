@extends('admin.layout.index')

@section('title', 'Sửa Công ty: ' . $employer->name)
@section('page-title', 'Sửa Thông tin Công ty')

@section('content')
<h1 class="text-3xl fw-bold mb-4">Chỉnh sửa Công ty: {{ $employer->name }}</h1>

<div class="card shadow border-0 rounded-4">
    <div class="card-body p-5">
        
        <form method="POST" action="{{ route('admin.employers.update', $employer->id) }}">
            @csrf
            @method('PUT') 

            {{-- Tên Công ty --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-bold">Tên Công ty</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employer->name) }}" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employer->email) }}" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Điện thoại --}}
            <div class="mb-4">
                <label for="phone" class="form-label fw-bold">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employer->phone) }}">
            </div>
            
            {{-- Địa chỉ --}}
            <div class="mb-4">
                <label for="address" class="form-label fw-bold">Địa chỉ</label>
                <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $employer->address) }}</textarea>
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Website --}}
            <div class="mb-4">
                <label for="website" class="form-label fw-bold">Website</label>
                <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $employer->website) }}" placeholder="https://">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.employer.manager') }}" class="btn btn-secondary">
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