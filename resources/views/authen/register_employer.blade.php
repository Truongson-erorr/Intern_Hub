<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký Nhà tuyển dụng</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white text-center py-4">
                    <h3 class="text-primary fw-bold">Đăng ký Đối tác Tuyển dụng</h3>
                    <p class="text-muted mb-0">Tạo hồ sơ doanh nghiệp và tìm kiếm nhân tài ngay hôm nay</p>
                </div>
                <div class="card-body p-5">
                    
                    <form method="POST" action="{{ url('authen/register-employer') }}">
                        @csrf
                        
                        <h5 class="mb-3 text-secondary border-bottom pb-2">1. Thông tin tài khoản</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ và tên người liên hệ <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required placeholder="VD: Nguyễn Văn A">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email đăng nhập <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required placeholder="email@company.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <h5 class="mb-3 mt-4 text-secondary border-bottom pb-2">2. Thông tin doanh nghiệp</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Tên công ty <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" class="form-control" required placeholder="VD: Công ty công nghệ ABC">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại liên hệ</label>
                                <input type="text" name="company_phone" class="form-control" placeholder="0901234567">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Website</label>
                                <input type="text" name="company_website" class="form-control" placeholder="https://abc.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ trụ sở</label>
                            <input type="text" name="company_address" class="form-control" placeholder="Số 10, Đường X, Quận Y...">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Đăng ký ngay</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>Đã có tài khoản? <a href="{{ url('authen/login') }}">Đăng nhập</a></small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>