<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Nhà tuyển dụng</title>
    
    {{-- 1. Sử dụng Font Inter từ Google Fonts cho nét hiện đại --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- 2. Bootstrap gốc của bạn --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    {{-- 3. Custom CSS cho trang này (Đặt file này trong public/css/) --}}
    <link href="{{ asset('css/employer-register.css') }}" rel="stylesheet">

</head>
<body class="employer-register-page">

<div class="container py-5"> {{-- Đổi mt-5 mb-5 thành py-5 để thoáng hơn --}}
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9"> {{-- Điều chỉnh cột một chút để vừa vặn hơn trên màn hình lớn --}}
            <div class="card shadow-sm border-0 modern-card">
                {{-- Thêm dải màu trang trí trên đầu --}}
                <div class="card-accent-strip"></div>
                
                <div class="card-header bg-white text-center pt-5 pb-3 border-0">
                    <h3 class="brand-color fw-bold mb-2">ĐĂNG KÝ ĐỐI TÁC DOANH NGHIỆP</h3>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Tạo hồ sơ doanh nghiệp và tìm kiếm nhân tài ngay hôm nay</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <form method="POST" action="{{ route('employer.register.submit') }}">
                        @csrf
                        
                        {{-- Section 1 --}}
                        <div class="mb-4">
                            <h5 class="section-title mb-3">1. Thông tin tài khoản</h5>
                            <div class="row g-3"> {{-- Sử dụng g-3 để khoảng cách giữa các cột đều hơn --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Họ và tên người liên hệ <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-lg-modern" required placeholder="VD: Nguyễn Văn A">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Email đăng nhập <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control form-control-lg-modern" required placeholder="email@company.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Mật khẩu <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control form-control-lg-modern" required placeholder="••••••••">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg-modern" required placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                         {{-- Section 2 --}}
                        <div class="mb-4 mt-5">
                            <h5 class="section-title mb-3">2. Thông tin doanh nghiệp</h5>
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium">Tên công ty <span class="text-danger">*</span></label>
                                <input type="text" name="company_name" class="form-control form-control-lg-modern" required placeholder="VD: Công ty công nghệ ABC">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Số điện thoại liên hệ</label>
                                    <input type="text" name="company_phone" class="form-control form-control-lg-modern" placeholder="0901234567">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Website doanh nghiệp</label>
                                    <input type="text" name="company_website" class="form-control form-control-lg-modern" placeholder="https://abc.com">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium">Địa chỉ trụ sở</label>
                                <input type="text" name="company_address" class="form-control form-control-lg-modern" placeholder="Số 10, Đường X, Quận Y...">
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" class="btn btn-brand btn-lg py-3 fw-semibold">Hoàn tất đăng ký</button>
                        </div>
                    </form>

                    <div class="text-center mt-4 text-muted">
                        <small>Đã có tài khoản? <a href="{{ url('authen/login') }}" class="brand-link fw-medium text-decoration-none">Đăng nhập ngay</a></small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>