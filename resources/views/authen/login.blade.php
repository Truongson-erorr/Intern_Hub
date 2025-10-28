@extends('employer.layout.index')

@section('title', 'Trang đăng nhập')

@section('content')
<div class="container mt-5 pt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center fw-bold text-primary">
        Đăng nhập
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    {{-- Form đăng nhập truyền thống --}}
    <form method="POST" action="{{ url('authen/login') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
            Đăng nhập
        </button>
    </form>

    {{-- Divider --}}
    <div class="text-center my-3 text-muted">— hoặc —</div>

    {{-- Nút đăng nhập Google --}}
    <a href="{{ url('/auth/google/redirect') }}" 
       class="btn btn-light border d-flex align-items-center justify-content-center w-100 py-2"
       style="gap: 8px; border-radius: 10px;">
        <img src="https://developers.google.com/identity/images/g-logo.png" 
             alt="Google Logo" 
             width="20" height="20">
        <span class="fw-semibold">Đăng nhập bằng Google</span>
    </a>

    <p class="mt-4 text-center">
        Chưa có tài khoản?
        <a href="{{ url('authen/register') }}" class="fw-semibold text-primary text-decoration-none">Đăng ký</a>
    </p>
</div>
@endsection
