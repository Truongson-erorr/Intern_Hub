    @extends('employer.layout.index')

    @section('title', 'Trang đăng ký')

    @section('content')
    <div class="container mt-5 pt-5" style="max-width: 500px;">
        <h2 class="mb-4 text-center">Đăng ký</h2>
        
        <form method="POST" action="{{ url('authen/register') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Họ và tên" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
        </form>

        <p class="mt-3 text-center">
            Bạn đã có tài khoản? <a href="{{ url('authen/login') }}">Đăng nhập</a>
        </p>
    </div>
    @endsection
