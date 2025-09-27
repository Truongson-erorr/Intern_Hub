@extends('employer.layout.index')
@section('title', 'Chi tiết công việc')

@section('content')

{{-- Hero Header giống trang chủ --}}
<div class="hero-header mb-5">
    <div class="container text-center">
        <h1 class="mb-4">Tìm việc IT mơ ước của bạn ngay hôm nay</h1>
        <p class="mb-5">Kết nối với hàng ngàn công ty công nghệ hàng đầu tại Việt Nam</p>
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
            <form method="GET" action="{{ url('user/timviec') }}" class="d-flex">
                <input type="text" name="keyword" class="form-control rounded-pill me-2 px-4"
                    placeholder="Nhập công việc..."
                    style="width: 600px; height: 60px; font-size: 16px;">
                <button type="submit" 
                        class="btn btn-light rounded-pill px-4 fw-bold"
                        style="background: linear-gradient(135deg, #5cb3ff 0%, #fe008c 100%); color: #fff;">
                     Tìm kiếm
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Job Detail Container --}}
<div class="job-container d-flex flex-wrap justify-content-center gap-4" style="margin: 20px;">
    
    {{-- Chi tiết công việc --}}
    <div class="job-detail flex-grow-1" style="max-width: 950px;">
        <h2>{{ $job->title }}</h2>
        <p class="text-muted">📍 {{ $job->location }}</p>
        <p>
            <span class="badge badge-salary">Lương: {{ $job->salary }}</span>
            <span class="badge badge-exp">Kinh nghiệm: {{ $job->experience }} năm</span>
        </p>
        <hr>

        <h5>Mô tả công việc</h5>
        <p>{{ $job->description }}</p>

        <h5>Yêu cầu ứng viên</h5>
        <ul>
        @foreach(explode("\n", $job->candidate_requirements) as $req)
            @php
                $req = trim($req);
                if (substr($req, 0, 1) === '-') {
                    $req = ltrim($req, '- ');
                }
            @endphp
            @if($req)
                <li>{{ $req }}</li>
            @endif
        @endforeach
        </ul>

        <h5>Thu nhập</h5>
        <p>{{ $job->income }}</p>

        <h5>Quyền lợi</h5>
        <ul>
        @foreach(explode("\n", $job->benefits) as $benefit)
            @php
                $benefit = trim($benefit);
                if (substr($benefit, 0, 1) === '-') {
                    $benefit = ltrim($benefit, '- ');
                }
            @endphp
            @if($benefit)
                <li>{{ $benefit }}</li>
            @endif
        @endforeach
        </ul>

        <h5>Địa điểm làm việc</h5>
        <p>{{ $job->work_location }}</p>

        <h5>Thời gian làm việc</h5>
        <p>{{ $job->work_time }}</p>

        <h5>Cách thức ứng tuyển</h5>
        <p>{{ $job->application_method }}</p>

        <h5>Hạn nộp hồ sơ</h5>
        <p>{{ $job->deadline }}</p>

        <h5>Yêu cầu bằng cấp</h5>
        <p>{{ $job->degree_requirements }}</p>
        <hr>

        <div class="job-actions text-center mb-4">
            <a href="#" class="apply-btn">Ứng tuyển ngay</a>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="job-sidebar" style="max-width: 400px;">
        <div class="sidebar-box">
            <h4>Thông tin công ty</h4>
            <hr>
            <p><strong>Công ty:</strong> {{ $job->company_name ?? 'Chưa cập nhật' }}</p>
            <p><strong>Website:</strong> <a href="#">company.com</a></p>
            <p><strong>Liên hệ:</strong> hr@company.com</p>
        </div>

        <div class="sidebar-box">
            <h4>Mẹo phỏng vấn</h4>
            <hr>
            <ul>
                <li>Chuẩn bị kỹ hồ sơ</li>
                <li>Nghiên cứu công ty</li>
                <li>Ăn mặc lịch sự</li>
                <li>Đúng giờ</li>
            </ul>
        </div>

        <div class="sidebar-box">
            <h4>Việc làm liên quan</h4>
            <hr>
            <div class="related-job mb-3">
                <h5><a href="#">Frontend Developer</a></h5>
                <p class="salary">15 - 20 triệu</p>
                <p class="location">📍 Hà Nội</p>
                <p class="desc">Phát triển giao diện web, làm việc với ReactJS...</p>
            </div>
            <div class="related-job mb-3">
                <h5><a href="#">Backend Developer</a></h5>
                <p class="salary">18 - 25 triệu</p>
                <p class="location">📍 TP. Hồ Chí Minh</p>
                <p class="desc">Xây dựng API, quản lý cơ sở dữ liệu MySQL...</p>
            </div>
            <div class="related-job mb-3">
                <h5><a href="#">Tester QA</a></h5>
                <p class="salary">12 - 16 triệu</p>
                <p class="location">📍 Đà Nẵng</p>
                <p class="desc">Kiểm thử phần mềm, viết test case, báo lỗi...</p>
            </div>
        </div>
    </div>

</div>

{{-- CSS --}}
<style>
.hero-header {
    background: linear-gradient(135deg, #5cb3ffff 0%, #fe008cff 100%);
    padding: 80px 0;
    color: #fff;
    border-radius: 20px;
    margin-bottom: 40px;
}
.hero-header h1 {
    font-weight: 700;
}
.hero-header p {
    font-size: 18px;
}

.job-container {
    gap: 30px;
}

.job-detail {
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.job-detail:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

.job-detail h2 {
    font-weight: 1000;
    margin-bottom: 15px;
    color: #333;
}

.job-detail .badge {
    border-radius: 12px;
    padding: 6px 14px;
    font-size: 14px;
    margin-right: 8px;
    transition: all 0.2s ease;
}
.job-detail .badge:hover {
    transform: scale(1.05);
}
.badge-salary { background: #f0f9ff; color: #007bff; font-weight: 500; }
.badge-exp { background: #fff8e6; color: #ff9800; font-weight: 500; }

.apply-btn {
    display: inline-block;
    padding: 12px 20px;
    border-radius: 10px;
    background: linear-gradient(135deg, #ff36deff, #0042c5ff);
    color: #fff;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0, 86, 179, 0.3);
}

.job-sidebar {
    flex: 1;
    max-width: 400px;
}
.sidebar-box {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}
.sidebar-box:hover {
    transform: translateY(-5px);
}
.sidebar-box h4 {
    font-size: 18px;
    margin-bottom: 12px;
    color: #444;
}
.sidebar-box ul {
    padding-left: 18px;
    margin: 0;
}
.sidebar-box li {
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
}

.related-job h5 a {
    text-decoration: none;
    color: #007bff;
}
.related-job h5 a:hover {
    text-decoration: underline;
}

@media (max-width: 992px) {
    .job-container {
        flex-direction: column;
        align-items: center;
    }
    .job-sidebar {
        max-width: 100%;
    }
    .job-detail {
        max-width: 100%;
    }
    .hero-header input {
        width: 100% !important;
    }
}
</style>

@endsection
