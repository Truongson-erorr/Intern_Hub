@extends('employer.layout.master')

@section('title', 'AI Gợi ý tài năng')

@section('content')
<div class="container-fluid">
    {{-- Header & Điều hướng --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employer.talent_pool.index') }}">Kho hồ sơ</a></li>
                    <li class="breadcrumb-item active">AI Gợi ý</li>
                </ol>
            </nav>
            <h3 class="fw-bold"></i>Trợ lý tuyển dụng AI</h3>
            <p class="text-muted">Dựa trên mô tả công việc và lịch sử tuyển dụng của bạn, InternHub AI đã chọn lọc ra những ứng viên phù hợp nhất.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('employer.talent_pool.index') }}" class="btn btn-outline-secondary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Quay lại bộ lọc
            </a>
        </div>
    </div>

    {{-- PHẦN 1: TOP 3 - AI BEST MATCHES --}}
    <div class="row mb-5">
        <div class="col-12 mb-3">
            <div class="d-flex align-items-center">
                <span class="badge bg-primary px-3 py-2 rounded-pill me-2">TOP 3</span>
                <h5 class="fw-bold mb-0">Ứng viên xuất sắc nhất</h5>
            </div>
        </div>

        @forelse($recommended['top'] as $student)
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-lg position-relative overflow-hidden hover-shadow transition" 
                     style="border-radius: 20px;">
                    {{-- Decorative Gradient --}}
                    <div class="position-absolute top-0 start-0 w-100" style="height: 6px; background: linear-gradient(90deg, #0052FF, #4D7CFF);"></div>
                    
                    <div class="card-body p-4">
                        {{-- Score Badge --}}
                        <div class="position-absolute top-0 end-0 m-3">
                            <div class="text-center p-2 rounded-4 bg-primary text-white shadow-sm" style="min-width: 65px;">
                                <small class="d-block opacity-75" style="font-size: 10px;">MATCH</small>
                                <span class="fw-bold fs-5">{{ $student->matching_score }}%</span>
                            </div>
                        </div>

                        {{-- Profile Info --}}
                        <div class="text-center mt-3 mb-4">
                            <div class="avatar-container position-relative d-inline-block mb-3">
                                <img src="{{ $student->avatar ? asset($student->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) . '&background=0052FF&color=fff' }}" 
                                     class="rounded-circle border border-4 border-white shadow-sm" 
                                     width="100" height="100" style="object-fit: cover;">
                                <div class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle" style="width: 18px; height: 18px;"></div>
                            </div>
                            <h5 class="fw-bold mb-1">{{ $student->name }}</h5>
                            <p class="text-primary small fw-semibold mb-0">{{ $student->desired_position }}</p>
                            <small class="text-muted">{{ $student->industry }}</small>
                        </div>

                        {{-- AI INSIGHT BOX --}}
                        <div class="bg-light p-3 rounded-4 mb-4 border border-primary-subtle position-relative">
                            <div class="position-absolute top-0 start-0 translate-middle-y ms-3">
                                <span class="badge bg-white text-primary border border-primary-subtle rounded-pill px-2 py-1 shadow-sm" style="font-size: 10px;">
                                    <i class="fas fa-robot me-1"></i> AI INSIGHT
                                </span>
                            </div>
                            <p class="mb-0 text-dark small fst-italic mt-1" style="line-height: 1.6;">
                                "{{ $student->ai_insight }}"
                            </p>
                        </div>

                        {{-- Match Reasons --}}
                        <div class="mb-4">
                            @foreach($student->reasons ?? [] as $reason)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-2 small"></i>
                                    <span class="small text-muted">{{ $reason }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary rounded-pill py-2 fw-bold" 
                                data-bs-toggle="modal" data-bs-target="#contactModal" 
                                data-student-id="{{ $student->id }}" data-student-name="{{ $student->name }}">
                                <i class="fas fa-paper-plane me-2"></i> Liên hệ ngay
                            </button>
                            <a href="{{ asset($student->cv_path) }}" target="_blank" class="btn btn-link text-muted btn-sm text-decoration-none">
                                <i class="fas fa-file-pdf me-1"></i> Xem chi tiết hồ sơ (CV)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Bạn cần đăng tin tuyển dụng để AI có dữ liệu phân tích.</p>
            </div>
        @endforelse
    </div>

    {{-- PHẦN 2: DANH SÁCH ỨNG VIÊN TIỀM NĂNG KHÁC --}}
    @if(count($recommended['others']) > 0)
    <div class="row">
        <div class="col-12 mb-4">
            <h5 class="fw-bold"><i class="fas fa-users me-2"></i>Ứng viên tiềm năng khác</h5>
            <hr class="opacity-10">
        </div>
        @foreach($recommended['others'] as $student)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $student->avatar ? asset($student->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) }}" 
                                 class="rounded-circle me-3" width="50" height="50">
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-truncate">{{ $student->name }}</h6>
                                <span class="badge bg-light text-primary border border-primary-subtle" style="font-size: 10px;">Khớp {{ $student->matching_score }}%</span>
                            </div>
                        </div>
                        <p class="small text-muted mb-3 text-truncate">{{ $student->desired_position ?? 'Chưa cập nhật' }}</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-sm btn-primary rounded-pill" 
                                    data-bs-toggle="modal" data-bs-target="#contactModal" 
                                    data-student-id="{{ $student->id }}" data-student-name="{{ $student->name }}">
                                Liên hệ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

{{-- MODAL LIÊN HỆ (Reuse từ Index) --}}
<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h5 class="modal-title fw-bold">Gửi lời mời cho <span id="modalStudentName"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('employer.messages.send') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" name="receiver_id" id="modalStudentId">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Thông điệp của bạn</label>
                        <textarea name="message_text" class="form-control rounded-3" rows="5"
                            placeholder="Chào bạn, mình thấy hồ sơ của bạn rất ấn tượng..." required></textarea>
                        <div class="form-text mt-2"><i class="fas fa-info-circle me-1"></i> Sinh viên sẽ nhận được tin nhắn và có thể xác nhận lời mời của bạn.</div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Gửi tin nhắn <i class="fas fa-paper-plane ms-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-primary-subtle { background-color: #e7f0ff; }
    .border-primary-subtle { border-color: #b3d1ff !important; }
    .hover-shadow:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
    }
    .transition { transition: all 0.3s ease; }
    .flex-center { display: flex; align-items: center; justify-content: center; }
</style>

@push('scripts')
<script>
    const contactModal = document.getElementById('contactModal');
    contactModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        document.getElementById('modalStudentId').value = button.getAttribute('data-student-id');
        document.getElementById('modalStudentName').textContent = button.getAttribute('data-student-name');
    });
</script>
@endpush

@endsection