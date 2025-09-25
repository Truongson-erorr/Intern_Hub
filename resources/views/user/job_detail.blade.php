@extends('employer.layout.index')
@section('title', 'Chi tiết công việc')

@section('content')
<style>
.job-detail {
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    margin: 140px 20px; 
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    max-width: 900px;
}

.job-detail h2 {
    font-weight: 700;
    margin-bottom: 15px;
}
.job-detail .badge {
    border-radius: 12px;
    padding: 6px 14px;
    font-size: 14px;
    margin-right: 8px;
}
.badge-salary 
{   background: #efefefff; 
    color: #606060ff; 
    font-weight: normal; 
}
.badge-exp { 
    background: #efefefff; 
    color: #626262ff; 
    font-weight: normal;  
}
.back-btn {
    display: inline-block;
    margin-top: 20px;
    text-decoration: underline;
    color: #007bff;
}
.back-btn:hover { color: #0056b3; }
</style>

<div class="">
    <div class="job-detail">
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
                $req = trim($req); // loại khoảng trắng đầu/cuối
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

        <a href="{{ url('user/trangchu') }}" class="back-btn">← Quay lại danh sách</a>
    </div>
</div>
@endsection
