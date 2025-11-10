@extends('employer.layout.index')

@section('content')

<style>
/* ====================== Global Layout ====================== */
body {
    background-color: #f8f9fb;
}

/* ====================== Page Header ====================== */
.page-header {
    text-align: center;
    margin-bottom: 40px;
}
.page-header h3 {
    font-weight: 800;
    color: #060606ff;
    margin-bottom: 10px;
}
.page-header p {
    color: #777;
    font-size: 15px;
}

/* ====================== Job Card ====================== */
.job-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 25px;
    width: 100%;
    max-width: 950px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}
.job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}
.job-card .job-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.job-card .job-header a {
    text-decoration: none;
    color: #333;
    font-weight: 700;
    font-size: 1.1rem;
}
.job-card .job-header form button {
    font-size: 0.875rem;
}

/* ====================== Info Section ====================== */
.job-info p {
    margin-bottom: 6px;
    font-size: 15px;
}
.job-info .btn-detail {
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
.job-info .btn-detail:hover {
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

<div class="container py-5 mt-5 d-flex flex-column align-items-center">
    <div class="page-header">
        <h3>Công việc đã lưu</h3>
        <p>Danh sách các công việc bạn đã lưu để tham khảo hoặc ứng tuyển sau.</p>
    </div>
    
    @if($savedJobs->isEmpty())
        <div class="empty-state">
            <i class="bi bi-bookmark"></i>
            <p>Bạn chưa lưu công việc nào.</p>
            <a href="{{ url('user/timviec') }}" class="btn btn-primary mt-3">Tìm việc ngay</a>
        </div>
    @else
        @foreach($savedJobs as $saved)
            @php
                $job = $saved->job;
            @endphp
            <div class="job-card">
                <div class="job-header">
                    <a href="{{ route('jobs.show', $job->id) }}">
                        {{ $job->title }}
                    </a>
                    <form action="{{ route('jobs.unsave', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-bookmark-x"></i> Bỏ lưu
                        </button>
                    </form>
                </div>

                <div class="job-info">
                    <p class="text-muted"><strong>Địa điểm:</strong> {{ $job->work_location ?? $job->location ?? 'Chưa cập nhật' }}</p>
                    <p class="text-muted"><strong>Mức lương:</strong> {{ $job->salary ?? $job->income ?? 'Thoả thuận' }}</p>
                    <p class="text-muted"><strong>Kinh nghiệm:</strong> {{ $job->experience ? $job->experience . ' năm' : 'Không yêu cầu' }}</p>
                    <p class="text-muted"><strong>Thời gian làm việc:</strong> {{ $job->work_time ?? 'Toàn thời gian' }}</p>
                    <p class="text-muted"><strong>Hạn nộp hồ sơ:</strong> 
                        {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') : 'Không có' }}
                    </p>

                    @if(!empty($job->description))
                        <p class="text-secondary mt-3">{{ Str::limit(strip_tags($job->description), 150, '...') }}</p>
                    @endif

                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-detail mt-2">Xem chi tiết công việc</a>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection
