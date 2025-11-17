@extends('user.layout.index')

<style>
.recommend-jobs-container {
    padding-top: 100px; 
    padding-bottom: 50px;
}

.card-job {
    background: #f9f9ff;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
}

.card-job:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.card-title {
    color: #1a1a1a;
}

.card-location {
    color: #6c757d;
}

.salary-badge {
    width: 110;
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    background-color: #d0e6ff; /* nền xanh nhạt */
    color: #0d3c91; /* chữ xanh đậm */
    font-weight: 600;
    font-size: 0.95rem;
}

.job-description {
    color: #333;
    margin-top: 5px;
    margin-bottom: 10px;
}

.description-text {
    text-align: center;
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 30px;
}

.btn-detail {
    transition: all 0.3s ease;
}
.btn-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>

@section('content')
<div class="container recommend-jobs-container">
    <h3 class="mb-2 fw-bold" style="text-align: center; color: black;">
        Việc làm phù hợp với bạn
    </h3>
    <p class="description-text">
        Dựa trên ngành nghề bạn quan tâm, hệ thống sẽ gợi ý các công việc phù hợp để bạn dễ dàng lựa chọn và ứng tuyển.
    </p>
    <hr>
    @if ($recommendedJobs->isEmpty())
        <div class="alert alert-info">
            Không tìm thấy công việc phù hợp nào. Hãy thử cập nhật <a href="{{ route('user.profile.edit') }}">hồ sơ cá nhân</a> của bạn nhé!
        </div>
    @else
        <div class="row">
            @foreach ($recommendedJobs as $job)
                <div class="col-md-6 mb-4">
                    <div class="card card-job rounded-3 h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold">{{ $job->title }}</h5>
                            <p class="card-location small mb-2">
                                <i class="bi bi-geo-alt"></i> {{ $job->location ?? 'Không rõ địa điểm' }}
                            </p>
                            @if($job->salary)
                                <span class="salary-badge">{{ $job->salary }}</span>
                            @else
                                <span class="salary-badge">Thoả thuận</span>
                            @endif
                            <p class="job-description">{{ Str::limit($job->description, 120) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary btn-detail btn-sm mt-2">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
