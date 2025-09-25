@extends('employer.layout.index')
@section('title', 'Kết quả tìm việc')

@section('content')
<style>
.search-header {
    background: #f8f9fa;
    padding: 40px 0;
    text-align: center;
}
.search-header h2 { font-weight: 700; }
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
/* spacer để tạo khoảng cách */
.section-spacer {
    height: 60px; /* chỉnh tùy ý */
}
</style>
<!-- ================= Spacer ================= -->
<div class="section-spacer"></div>

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
                <div class="job-card">
                    <h5>{{ $job->title }}</h5>
                    <p class="location">📍 {{ $job->location }}</p>
                    <p>
                        <span class="job-badge salary">Mức lương: {{ $job->salary }}</span>
                        <span class="job-badge experience">Kinh nghiệm: {{ $job->experience }} năm</span>
                    </p>
                    <div class="text-end mt-3">
                        <a href="{{ url('jobs/'.$job->id) }}" class="btn-detail">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Không tìm thấy công việc nào phù hợp.</p>
        @endforelse
    </div>
</div>
@endsection
