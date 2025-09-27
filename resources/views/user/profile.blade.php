@extends('employer.layout.index')
@section('title', 'Thông tin cá nhân')


<style>
.card {
    background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
}

.avatar-container {
    position: relative;
    display: inline-block;
}
.avatar-container .overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 25%;
    background: rgba(0,0,0,0.4);
    color: #fff;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0 0 50% 50%;
    opacity: 0;
    transition: opacity 0.3s;
}
.avatar-container:hover .overlay { opacity: 1; }

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #4A6CF7, #82B1FF);
    border-radius: 3px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 12px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.info-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.info-label {
    font-weight: 600;
    min-width: 140px;
    color: #4a5568;
}
.info-value {
    color: #2d3748;
    font-weight: 500;
}

.status-indicator {
    font-size: 0.8rem;
    background: linear-gradient(90deg, #48bb78, #68d391);
}

.action-buttons .btn {
    transition: all 0.3s ease;
}
.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>

@section('content')
<div class="container d-flex justify-content-center align-items-start" style="min-height: 80vh; padding-top: 100px;">
    @if(session()->has('user'))
        @php
            $userId = session('user')->id;
            $user = \App\Models\User::find($userId); 
        @endphp

        <div class="card shadow-lg p-4" style="max-width: 700px; border-radius: 20px; width: 100%; border: none;">
            
            {{-- Header với avatar và tên --}}
            <div class="text-center mb-4 position-relative">
                <div class="avatar-container mb-3">
                    <img id="avatarPreview"
                        src="{{ $user->avatar ? $user->avatar : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=4A6CF7&color=fff&size=150' }}" 
                        class="rounded-circle border border-4 border-white shadow" 
                        alt="Avatar" 
                        style="width: 120px; height: 120px;">
                    <div class="overlay">Avatar</div>
                </div>

                <h3 class="mb-1 fw-bold text-dark">{{ $user->name }}</h3>
                <p class="text-muted">Thông tin tài khoản</p>
                
                <div class="status-indicator bg-success rounded-pill d-inline-block px-3 py-1 text-white small">
                    <i class="fas fa-circle me-1 small"></i> Đang hoạt động
                </div>
            </div>


            {{-- Thông tin chi tiết --}}
            <div class="info-section">
                <h5 class="section-title mb-3 fw-semibold text-primary">
                    <i class="fas fa-user-circle me-2"></i>Thông tin cá nhân
                </h5>
                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-id-badge me-2 text-primary"></i>ID:</div>
                        <div class="info-value">{{ $user->id }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-envelope me-2 text-primary"></i>Email:</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-phone me-2 text-primary"></i>Số điện thoại:</div>
                        <div class="info-value">{{ $user->phone ?? 'Chưa cập nhật' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Địa chỉ:</div>
                        <div class="info-value">{{ $user->address ?? 'Chưa cập nhật' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-file-alt me-2 text-primary"></i>Hồ sơ:</div>
                        <div class="info-value">{{ $user->resume ?? 'Chưa cập nhật' }}</div>
                    </div>
                </div>
            </div>

            {{-- Nút hành động --}}
            <div class="action-buttons mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between">
                    <a href="{{ url('authen/logout') }}" class="btn btn-danger rounded-pill py-2 px-4 d-flex align-items-center">
                        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                    </a>
                    <button class="btn btn-primary rounded-pill py-2 px-4 d-flex align-items-center">
                        <i class="fas fa-edit me-2"></i> Chỉnh sửa
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <div class="card shadow p-4" style="border-radius: 20px;">
                <h4 class="mb-3">👋 Chào bạn, Bạn chưa đăng nhập</h4>
                <p class="text-muted mb-4">Vui lòng đăng nhập để xem và chỉnh sửa thông tin cá nhân</p>
                
            </div>
        </div>
    @endif
</div>
<hr>
<script>
// Preview ảnh ngay khi chọn file
document.getElementById('avatarInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);

        // Tự động submit form khi chọn xong
        document.getElementById('avatarForm').submit();
    }
});
</script>
@endsection
