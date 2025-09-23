@extends('employer.layout.index')
@section('title', 'Trang Chủ')

@section('content')
<style>
/* Hero Section */
.hero-header {
    background: linear-gradient(135deg, #5cb3ffff 0%, #fe008cff 100%);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}
.hero-header h1 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    color: #fff;
}
.hero-header p {
    font-size: 18px;
    color: #f1f1f1;
}
.btn-primary {
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background-color: #ff6f61;
    transform: translateY(-3px);
}

/* Job Categories */
.category-item {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    transition: 0.3s;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.category-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}
.category-item i {
    font-size: 40px;
    color: #4facfe;
    margin-bottom: 15px;
}

/* Featured Jobs */
.job-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    transition: 0.3s;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.job-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}
.job-card h5 {
    font-weight: 600;
    margin-bottom: 10px;
}
.job-card span {
    font-size: 14px;
    color: #888;
}
</style>

<!-- Hero Header -->
<div class="hero-header text-center">
    <div class="container">
        <h1 class="mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
            Tìm việc IT mơ ước của bạn ngay hôm nay
        </h1>
        <p class="mb-4 wow animate__fadeInUp" data-wow-delay="0.4s">
            Kết nối với hàng ngàn công ty công nghệ hàng đầu tại Việt Nam
        </p>
        <a href="#" class="btn btn-primary btn-lg rounded-pill px-5 py-3 wow animate__fadeInUp" data-wow-delay="0.6s">
            Bắt đầu tìm việc
        </a>
    </div>
</div>

<!-- Job Categories -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Ngành nghề nổi bật</h2>
        <p>Khám phá các lĩnh vực công nghệ đang được tuyển dụng nhiều nhất</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4 col-lg-3">
            <div class="category-item">
                <i class="fas fa-code"></i>
                <h5>Lập trình Web</h5>
                <p>PHP, Laravel, .NET, Java</p>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="category-item">
                <i class="fas fa-mobile-alt"></i>
                <h5>Mobile App</h5>
                <p>Android, iOS, Flutter</p>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="category-item">
                <i class="fas fa-database"></i>
                <h5>Database</h5>
                <p>SQL Server, MySQL, MongoDB</p>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="category-item">
                <i class="fas fa-cloud"></i>
                <h5>DevOps & Cloud</h5>
                <p>AWS, Azure, Docker</p>
            </div>
        </div>
    </div>
</div>

<!-- Featured Jobs -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Việc làm nổi bật</h2>
        <p>Top các công việc IT được ứng tuyển nhiều nhất</p>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="job-card">
                <h5>Frontend Developer (ReactJS)</h5>
                <span>Công ty ABC Tech - Hà Nội</span>
                <p class="mt-2">Mức lương: 15 - 25 triệu</p>
                <a href="#" class="btn btn-primary btn-sm rounded-pill">Xem chi tiết</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="job-card">
                <h5>Backend Developer (Laravel)</h5>
                <span>Công ty XYZ Solutions - TP.HCM</span>
                <p class="mt-2">Mức lương: 18 - 30 triệu</p>
                <a href="#" class="btn btn-primary btn-sm rounded-pill">Xem chi tiết</a>
            </div>
        </div>
    </div>
</div>
@endsection
