@extends('user.layout.index')
@section('title', 'Chỉnh sửa thông tin cá nhân')

@section('content')
<div class="container d-flex justify-content-center align-items-start" style="min-height: 80vh; padding-top: 100px;">
    <div class="card shadow p-4 rounded-4" style="width: 700px; max-width: 95%;">
        <h4 class="text-primary mb-4 text-center">
            <i class="fas fa-user-edit me-2"></i>Chỉnh sửa thông tin cá nhân
        </h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-4">
                <img src="{{ $user->avatar ? asset($user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                     class="rounded-circle border border-3 mb-2" 
                     alt="Avatar" 
                     style="width: 120px; height: 120px;">
                <div>
                    <label class="btn btn-outline-primary mt-2">
                        <i class="fas fa-camera"></i> Chọn ảnh
                        <input type="file" name="avatar" accept="image/*" hidden>
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Họ và tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Hồ sơ</label>
                <textarea name="resume" class="form-control" rows="3">{{ old('resume', $user->resume) }}</textarea>
            </div>
        
            <div class="mb-3">
                <label class="form-label fw-semibold">Ngành nghề chính</label>
                <input type="text" name="industry" class="form-control"
                    value="{{ old('industry', $user->industry) }}"
                    placeholder="VD: Công nghệ thông tin, Kỹ thuật phần mềm">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ url('user/trangchu') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
