@extends('employer.layout.index')

@section('title', 'Trang đăng nhập')

@section('content')
    <h2>Đăng nhập</h2>
    <form method="POST" action="{{ url('authen/login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Mật khẩu"><br>
        <button type="submit">Đăng nhập</button>
    </form>
@endsection
