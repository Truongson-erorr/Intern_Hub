@extends('employer.layout.master')

@section('title', 'Thông tin tài khoản')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Tài Khoản Của Bạn<h3>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-modern text-center p-4">
                <div class="mb-3 mx-auto position-relative">
                    @if ($user->avatar)
                        <img src="{{ asset($user->avatar) }}" class="rounded-circle img-thumbnail"
                            style="width:150px;height:150px;object-fit:cover;">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto fw-bold display-1"
                            style="width: 150px; height: 150px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h4 class="fw-bold">{{ $user->name }}</h4>
                <p class="text-muted mb-1">{{ $user->email }}</p>
                <small class="badge bg-success mt-1">
                    <i class="fas fa-check-circle me-1"></i>Tài Khoản Dành Cho Quản Trị Doanh Nghiệp
                </small>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-modern">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <ul class="nav nav-tabs card-header-tabs" id="accountTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active fw-bold" id="info-tab" data-bs-toggle="tab"
                                data-bs-target="#info" type="button" role="tab">
                                Thông tin cá nhân
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold" id="password-tab" data-bs-toggle="tab"
                                data-bs-target="#password" type="button" role="tab">
                                Đổi mật khẩu
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <div class="tab-content" id="accountTabsContent">

                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <form action="{{ route('employer.account.updateInfo') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Họ và tên</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email đăng nhập</label>
                                    <input type="text" class="form-control bg-light" value="{{ $user->email }}"
                                        readonly>
                                    <small class="text-muted">Không thể thay đổi email.</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Ảnh đại diện cá nhân</label>
                                    <input type="file" name="avatar" class="form-control" accept="image/*">
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded px-4">
                                        Lưu thay đổi
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="password" role="tabpanel">
                            <form action="{{ route('employer.account.changePassword') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Mật khẩu hiện tại</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="new_password_confirmation" class="form-control" required>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-warning text-dark rounded px-4 fw-bold">
                                        Đổi mật khẩu
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
