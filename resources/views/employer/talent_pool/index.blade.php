@extends('employer.layout.master')

@section('title', 'Kho hồ sơ sinh viên')

@section('content')
    <div class="container-fluid">
        {{-- Header Section --}}
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h4 class="fw-bold">Khám phá tài năng trẻ</h4>
                <p class="text-muted mb-0">Tìm kiếm sinh viên phù hợp với tiêu chí của công ty bạn.</p>
            </div>
            {{-- Lối tắt sang trang AI --}}
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('employer.talent_pool.recommended') }}" class="text-decoration-none">
                    <div class="d-inline-flex align-items-center bg-primary-subtle p-2 px-3 rounded-pill border border-primary-subtle hover-shadow transition">
                        <div class="bg-primary text-white rounded-circle flex-center me-2" style="width: 24px; height: 24px;">
                            <i class="fas fa-robot" style="font-size: 12px;"></i>
                        </div>
                        <span class="text-primary fw-bold small">Xem gợi ý từ AI</span>
                        <i class="fas fa-chevron-right ms-2 text-primary small"></i>
                    </div>
                </a>
            </div>
        </div>
        
        {{-- Thanh tìm kiếm & Bộ lọc --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <form action="{{ route('employer.talent_pool.index') }}" method="GET" class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="position" class="form-control border-start-0 ps-0" 
                                   placeholder="Tên sinh viên hoặc vị trí mong muốn..." value="{{ request('position') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="industry" class="form-select">
                            <option value="">Tất cả chuyên ngành</option>
                            <option value="Software Engineering" {{ request('industry') == 'Software Engineering' ? 'selected' : '' }}>Kỹ thuật phần mềm</option>
                            <option value="Information Assurance" {{ request('industry') == 'Information Assurance' ? 'selected' : '' }}>An toàn thông tin</option>
                            <option value="Data Science" {{ request('industry') == 'Data Science' ? 'selected' : '' }}>Khoa học dữ liệu</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i> Lọc hồ sơ
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            @forelse($students as $student)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                        <div class="card-body text-center">
                            <div class="flex justify-center mb-4">
                                <div
                                    class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-white shadow-xl overflow-hidden bg-white mx-auto">
                                    <img src="{{ $student->avatar ? asset($student->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) }}"
                                        class="rounded-circle me-2" width="100" height="100">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-1">{{ $student->name }}</h6>
                            <p class="text-primary small mb-2">{{ $student->desired_position ?? 'Chưa cập nhật vị trí' }}
                            </p>

                            <div class="mb-3">
                                <span class="badge bg-light text-dark border">{{ $student->industry }}</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ asset($student->cv_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-file-pdf me-1"></i> Xem CV
                                </a>

                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#contactModal" data-student-id="{{ $student->id }}"
                                    data-student-name="{{ $student->name }}">
                                    <i class="fas fa-paper-plane me-1"></i> Liên hệ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100" class="opacity-50">
                    <p class="text-muted">Không tìm thấy sinh viên phù hợp.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $students->appends(request()->query())->links() }}
        </div>
    </div>

    <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Gửi lời mời phỏng vấn cho <span id="modalStudentName"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('employer.messages.send') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="receiver_id" id="modalStudentId">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung tin nhắn</label>
                            <textarea name="message_text" class="form-control" rows="5"
                                placeholder="Chào bạn, mình thấy hồ sơ của bạn rất phù hợp..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Gửi ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .transition {
            transition: all 0.3s ease;
        }
    </style>
    @push('scripts')
        <script>
            const contactModal = document.getElementById('contactModal');
            contactModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const studentId = button.getAttribute('data-student-id');
                const studentName = button.getAttribute('data-student-name');

                document.getElementById('modalStudentId').value = studentId;
                document.getElementById('modalStudentName').textContent = studentName;
            });
        </script>
        <script>
            // Kiểm tra và hiển thị thông báo từ Session Flash
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại!',
                    text: "{{ session('error') }}",
                    timer: 4000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif
        </script>
    @endpush
@endsection
