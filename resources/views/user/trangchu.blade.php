@extends('user.layout.index')
@section('title', 'Trang Chủ')

@section('content')
<style>
.hero-header {
    background: linear-gradient(135deg, #5cb3ffff 0%, #fe008cff 100%);
    padding: 100px 0;
    text-align: center;
    color: #fff;
    overflow: hidden;
}
.hero-header h1 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
}
.hero-header p {
    font-size: 18px;
}
.btn-primary {
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background-color: #ff6f61;
    transform: translateY(-3px);
}

.category-item {
    background: #fff;
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.category-item:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    background: linear-gradient(135deg, #5cb3ff 0%, #fe008c 100%);
    color: #fff;
}
.category-item:hover h5,
.category-item:hover p { color: #fff; }
.category-item i {
    font-size: 50px;
    color: #4facfe;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}
.category-item:hover i { color: #fff; transform: rotate(15deg) scale(1.2); }
.category-item h5 { font-weight: 700; margin-bottom: 10px; transition: color 0.3s ease; }
.category-item p { font-size: 14px; transition: color 0.3s ease; }
@media (max-width: 992px) { .category-item i { font-size: 40px; } }
@media (max-width: 576px) {
    .category-item { padding: 20px 15px; }
    .category-item i { font-size: 35px; }
}

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
    color: #868686ff;
    padding: 8px 20px;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    color: #3d3d3dff;
    transform: scale(1.05);
    
}
</style>

<div class="hero-header">
    <div class="container">
        <h1 class="mb-4">Tìm việc IT mơ ước của bạn ngay hôm nay</h1>
        <p class="mb-5">Kết nối với hàng ngàn công ty công nghệ hàng đầu tại Việt Nam</p>
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
            <form method="GET" action="{{ url('user/timviec') }}" class="d-flex">
                <input type="text" name="keyword" class="form-control rounded-pill me-2 px-4"
                    placeholder="Nhập công việc..."
                    style="width: 600px; height: 60px; font-size: 16px;">
                <button type="submit" 
                        class="btn btn-light rounded-pill px-4 fw-bold"
                        style="background: linear-gradient(135deg, #5cb3ff 0%, #fe008c 100%); color: #fe4848ff;">
                     Tìm kiếm
                </button>
            </form>
            
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Ngành nghề nổi bật</h2>
        <p>Khám phá các lĩnh vực công nghệ đang được tuyển dụng nhiều nhất</p>
    </div>
    <div class="row g-4">
        @php
            $categories = [
                ['icon'=>'fas fa-code','title'=>'Lập trình Web','desc'=>'PHP, Laravel, .NET, Java'],
                ['icon'=>'fas fa-mobile-alt','title'=>'Mobile App','desc'=>'Android, iOS, Flutter'],
                ['icon'=>'fas fa-database','title'=>'Database','desc'=>'SQL Server, MySQL, MongoDB'],
                ['icon'=>'fas fa-cloud','title'=>'DevOps & Cloud','desc'=>'AWS, Azure, Docker'],
                ['icon'=>'fas fa-network-wired','title'=>'Mạng & An ninh','desc'=>'Network, Security, Firewall'],
                ['icon'=>'fas fa-robot','title'=>'AI & Machine Learning','desc'=>'Python, TensorFlow, AI'],
                ['icon'=>'fas fa-paint-brush','title'=>'UI/UX Design','desc'=>'Figma, Adobe XD, Photoshop'],
                ['icon'=>'fas fa-server','title'=>'Backend & API','desc'=>'Node.js, Django, PHP'],
            ];
        @endphp

        @foreach($categories as $cat)
            <div class="col-md-4 col-lg-3">
                <div class="category-item">
                    <i class="{{ $cat['icon'] }}"></i>
                    <h5>{{ $cat['title'] }}</h5>
                    <p>{{ $cat['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Danh sách việc làm</h2>
    </div>
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

                        <p class="job-desc text-muted" style="font-size: 15px;">
                            {{ Str::limit($job->description, 120, '...') }}
                        </p>
                    </div>
                </a>
            </div>

        @empty
            <p class="text-center">Chưa có công việc nào.</p>
        @endforelse

    </div>
</div>

@endsection
