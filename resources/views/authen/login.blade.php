@extends('employer.layout.index')

@section('title', 'Trang đăng nhập')

@section('content')
<div class="container mt-5 pt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Đăng nhập</h2>
    <form method="POST" action="{{ url('authen/login') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>
    <p class="mt-3 text-center">
        Chưa có tài khoản? <a href="{{ url('authen/register') }}">Đăng ký</a>
    </p>
</div>
@endsection
