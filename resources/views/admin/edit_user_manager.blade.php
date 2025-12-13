@extends('admin.layout.index')

@section('title', 'Chỉnh sửa User - ' . $user->name)
@section('page-title', 'Chỉnh sửa User')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Chỉnh sửa Tài khoản: {{ $user->name }}</h1>

<div class="card shadow border-0 rounded-4">
    <div class="card-body p-5">
        
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT') 

            {{-- Tên --}}
            <div class="mb-4">
                <label for="name" class="form-label font-weight-bold">Tên User</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="form-label font-weight-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Role --}}
            <div class="mb-4">
                <label for="role" class="form-label font-weight-bold">Vai trò (Role)</label>
                <select class="form-select form-control" id="role" name="role">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="employer" {{ $user->role == 'employer' ? 'selected' : '' }}>Employer</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- Mật khẩu mới --}}
            <div class="mb-4">
                <label for="password" class="form-label font-weight-bold">Mật khẩu mới (Bỏ trống nếu không đổi)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới">
            </div>
            
            {{-- Nhập lại mật khẩu (Cần thiết cho validation confirmed) --}}
            <div class="mb-4">
                <label for="password_confirmation" class="form-label font-weight-bold">Xác nhận Mật khẩu mới</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu mới">
                @error('password')
                    <div class="text-danger mt-1">Lỗi mật khẩu: {{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.user.manager') }}" class="btn btn-secondary">
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