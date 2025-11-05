@extends('employer.layout.index')
@section('title', 'Kết quả tìm việc')

@section('content')
<style>
/* ================= Hero Header ================= */
.hero-header {
    background: linear-gradient(135deg, #5cb3ff 0%, #fe008c 100%);
    padding: 60px 0 40px;
    height: 350x;
    text-align: center;
    color: #fff;
}
.hero-header h1 { 
    font-weight: 700; 
    font-size: 32px; 
    margin-bottom: 15px; 
    margin-top: 40px;
}
.hero-header p { 
    font-size: 14px; 
    margin-bottom: 25px; 
}

.hero-header .form-control {
    width: 400px; 
    height: 50px;
    font-size: 14px;
}

.hero-header .btn-search {
    background: #fff; 
    color: #fe008c; 
    font-weight: 700;
    border-radius: 50px;
    padding: 10px 25px;
    border: none;
    transition: all 0.3s ease;
}
.hero-header .btn-search:hover {
    background: #f8f8f8;
    transform: scale(1.05);
}

/* ================= Job Cards ================= */
.job-card {
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
.job-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
.job-card h5 { font-weight: 700; color: #333; margin-bottom: 12px; }
.job-card .location { color: #6c757d; font-size: 14px; margin-bottom: 15px; }
.job-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 12px;
    margin-right: 8px;
    font-size: 14px;
}
.job-badge.salary { background-color: #d4edda; color: #155724; }
.job-badge.experience { background-color: #e3f2fd; color: #0d47a1; }
.btn-detail {
    border-radius: 50px;
    border: none;
    color: #868686;
    padding: 8px 20px;
    transition: all 0.3s ease;
    text-decoration: underline;
}
.btn-detail:hover {
    color: #3d3d3d;
    transform: scale(1.05);
}

.section-spacer { height: 60px; }

.search-header {
    background: #f8f9fa;
    padding: 40px 0;
    text-align: center;
}
.search-header h2 { font-weight: 700; }
</style>

<!-- ================= Hero Header ================= -->
<div class="hero-header">
    <div class="container">
        <h1 class="mb-4">Tìm việc IT mơ ước của bạn ngay hôm nay</h1>
        <p class="mb-5">Kết nối với hàng ngàn công ty công nghệ hàng đầu tại Việt Nam</p>
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
            <form method="GET" action="{{ url('user/timviec') }}" class="d-flex">
                <input type="text" name="keyword" class="form-control rounded-pill me-2 px-4"
                    placeholder="Nhập công việc...">
                <button type="submit" class="btn-search fw-bold">Tìm kiếm</button>
            </form>
        </div>
    </div>
</div>

<!-- ================= Search Header ================= -->
<div class="search-header">
    <div class="container">
        <h2>Kết quả tìm kiếm cho: <span class="text-primary">"{{ $keyword }}"</span></h2>
        <p class="mt-2">{{ count($jobs) }} công việc được tìm thấy</p>
    </div>
</div>

<!-- ================= Job List ================= -->
<div class="container py-5">
    <div class="row">
        @forelse($jobs as $job)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ url('jobs/'.$job->id) }}" class="text-decoration-none">
                    <div class="job-card">
                        <h5>{{ $job->title }}</h5>
                        <p class="location">📍 {{ $job->location }}</p>
                        <p>
                            <span class="job-badge salary">Mức lương: {{ $job->salary }}</span>
                            <span class="job-badge experience">Kinh nghiệm: {{ $job->experience }} năm</span>
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-center">Không tìm thấy công việc nào phù hợp.</p>
        @endforelse
    </div>       
</div>

@endsection
