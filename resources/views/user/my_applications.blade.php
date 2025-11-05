@extends('employer.layout.index')
@section('title', 'Đơn đã ứng tuyển')

@section('content')
<style>
/* ====================== Application Card ====================== */
.application-card {
    display: flex;
    align-items: flex-start;
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 25px;
    width: 100%;
    max-width: 950px; /* giống max-width bên đã lưu */
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
}
.application-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}
.application-card img {
    width: 120px;
    height: 120px;
    border-radius: 16px;
    object-fit: cover;
    margin-right: 25px;
    background: #f1f1f1;
}

/* ====================== Info Section ====================== */
.application-info h5 {
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}
.application-info p {
    margin-bottom: 6px;
    font-size: 15px;
}
.application-info .intro {
    color: #555;
    margin-top: 10px;
    line-height: 1.6;
}
.application-info .meta {
    font-size: 13px;
    color: #888;
}
.application-info .btn-detail {
    border-radius: 50px;
    padding: 8px 22px;
    font-size: 14px;
    font-weight: 600;
    margin-top: 12px;
    background: transparent;
    color: #0d6efd;
    border: 1.5px solid #0d6efd;
    transition: all 0.3s ease;
}
.application-info .btn-detail:hover {
    background: linear-gradient(135deg, #5cb3ff 0%, #fe008c 100%);
    color: #fff;
    border: none;
    transform: translateY(-1px);
}

/* ====================== Empty State ====================== */
.empty-state {
    text-align: center;
    padding: 100px 0;
    color: #777;
}
.empty-state i {
    font-size: 60px;
    color: #bbb;
    margin-bottom: 20px;
}
</style>

<div class="container py-5 mt-5 d-flex flex-column align-items-center" style="min-height: 90vh;">
    <div class="page-header text-center mb-4">
        <h2>Đơn ứng tuyển của tôi</h2>
        <p>Theo dõi các công việc bạn đã gửi hồ sơ và trạng thái ứng tuyển của mình.</p>
    </div>

    @forelse($applications as $app)
        <div class="application-card">
            <img src="{{ asset('images/job-placeholder.png') }}" 
                 alt="Job Image"
                 onerror="this.style.display='none';">

            <div class="application-info flex-grow-1">
                <h5>{{ $app->job->title ?? 'Công việc đã bị xóa' }}</h5>
                <p class="text-muted mb-1">📍 {{ $app->job->location ?? 'Không xác định' }}</p>

                @if($app->cv_path)
                    <p><strong>CV đã gửi:</strong>
                        <a href="{{ asset('storage/'.$app->cv_path) }}" target="_blank">
                            Xem CV
                        </a>
                    </p>
                @endif

                @if($app->introduction)
                    <p class="intro">
                        <strong>Giới thiệu:</strong>
                        {{ Str::limit($app->introduction, 150, '...') }}
                    </p>
                @endif

                <p class="meta mt-2">
                    ⏰ Nộp ngày: {{ $app->created_at->format('d/m/Y') }}
                </p>

                <a href="{{ url('jobs/'.$app->job_id) }}" 
                   class="btn btn-detail">
                    Xem chi tiết công việc
                </a>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="bi bi-folder2-open"></i>
            <p>Bạn chưa ứng tuyển công việc nào.</p>
        </div>
    @endforelse
</div>
@endsection
