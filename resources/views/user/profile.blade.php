@extends('user.layout.app')

@section('title', 'Thông tin cá nhân')

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .bg-dot-pattern {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .electric-gradient {
            background: linear-gradient(135deg, #0052FF 0%, #4D7CFF 100%);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <div class="bg-[#F8FAFC] font-body text-on-surface min-h-screen relative overflow-x-hidden -mt-24 pt-24">
        {{-- Background Decor --}}
        <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 overflow-hidden">
            <div class="absolute top-[-15%] left-[-5%] w-[60%] h-[60%] rounded-full bg-primary-fixed/15 blur-[140px]"></div>
            <div
                class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-secondary-container/10 blur-[120px]">
            </div>
            <div class="absolute inset-0 bg-dot-pattern opacity-30"></div>
        </div>

        <main class="flex-grow max-w-[1440px] mx-auto w-full px-8 py-16">
            <div class="max-w-5xl mx-auto">
                @auth
                    @php
                        $user = Auth::user();
                        $fields = [$user->phone, $user->address, $user->resume, $user->industry];
                        $filled = count(array_filter($fields));
                        $completion = $filled > 0 ? round(($filled / count($fields)) * 100) : 0;
                    @endphp

                    {{-- Header với Avatar và Tên --}}
                    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                        <div class="flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-left">
                            <div class="relative">
                                <div
                                    class="w-32 h-32 md:w-40 md:h-40 rounded-3xl border-4 border-white shadow-xl overflow-hidden bg-white">
                                    <img alt="Avatar" class="w-full h-full object-cover"
                                        src="{{ $user->avatar ? asset($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0052FF&color=fff&size=150' }}">
                                </div>
                                <div class="absolute -bottom-1 -right-1 bg-white p-1 rounded-xl shadow-lg">
                                    <div
                                        class="flex items-center px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold tracking-widest uppercase border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                        Hoạt động
                                    </div>
                                </div>
                            </div>
                            <div class="pb-2">
                                <h1 class="font-calistoga text-4xl md:text-5xl text-slate-900 mb-2">{{ $user->name }}</h1>
                                <p class="text-slate-500 font-medium text-lg">
                                    {{ $user->industry ?? 'Chưa cập nhật ngành nghề' }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center md:justify-end pb-2">
                            <a href="{{ route('user.profile.edit') }}"
                                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-semibold shadow-sm hover:shadow-md hover:bg-slate-50 transition-all active:scale-95">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                Chỉnh sửa hồ sơ
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Cột chính --}}
                        <div class="lg:col-span-2 space-y-8">
                            {{-- Thông tin liên hệ --}}
                            <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-slate-100">

                                <div class="mb-10">
                                    <h2 class="font-calistoga text-2xl text-slate-900">Thông Tin Cá Nhân</h2>
                                    <div class="w-12 h-1 electric-gradient rounded-full mt-2"></div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-8">

                                    {{-- EMAIL --}}
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                                            Địa chỉ Email
                                        </p>
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-primary">mail</span>
                                            <p class="text-slate-800 font-medium">{{ $user->email }}</p>
                                        </div>
                                    </div>

                                    {{-- PHONE --}}
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                                            Số điện thoại
                                        </p>
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-primary">call</span>
                                            <p class="text-slate-800 font-medium">{{ $user->phone ?? 'Chưa cập nhật' }}</p>
                                        </div>
                                    </div>

                                    {{-- EXPERIENCE --}}
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                                            Kinh nghiệm làm việc
                                        </p>
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-primary">work_history</span>
                                            <p class="text-slate-800 font-medium">
                                                {{ $user->experience ?? 'Chưa cập nhật' }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- SALARY --}}
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                                            Mức lương mong muốn
                                        </p>
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-primary">payments</span>
                                            <p class="text-slate-800 font-medium">
                                                {{ $user->expected_salary ?? 'Chưa cập nhật' }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- INDUSTRY --}}
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                                            Lĩnh vực chuyên môn
                                        </p>
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-primary">work</span>
                                            <p class="text-slate-800 font-medium">
                                                {{ $user->industry ?? 'Chưa cập nhật' }}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Tài liệu & Hồ sơ --}}
                            <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-slate-100">
                                <div class="mb-10 flex justify-between items-center">
                                    <div>
                                        <h2 class="font-calistoga text-2xl text-slate-900">Hồ Sơ Ứng Tuyển</h2>
                                        <div class="w-12 h-1 electric-gradient rounded-full mt-2"></div>
                                    </div>

                                    {{-- Nút Switch Bật/Tắt tìm kiếm --}}
                                    @if ($user->cv_path)
                                        <div
                                            class="flex items-center justify-between bg-white px-4 py-3 rounded-xl border border-slate-200 shadow-sm">

                                            <div class="flex flex-col">
                                                <span class="text-sm font-semibold text-slate-700">
                                                    Cho phép tìm kiếm
                                                </span>
                                                <span class="text-xs text-slate-500">
                                                    Nhà tuyển dụng có thể tìm thấy hồ sơ của bạn
                                                </span>
                                            </div>

                                            <!-- Toggle -->
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" id="publicSwitch" class="sr-only peer"
                                                    {{ $user->is_public ? 'checked' : '' }} onclick="handleToggleClick(event)">

                                                <div
                                                    class="w-11 h-6 bg-slate-300 rounded-full peer 
            peer-checked:bg-blue-600 
            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
            after:bg-white after:border after:rounded-full after:h-5 after:w-5
            after:transition-all 
            peer-checked:after:translate-x-full peer-checked:after:border-white">
                                                </div>
                                            </label>

                                        </div>
                                    @endif
                                </div>

                                @if ($user->cv_path)
                                    {{-- Đã có CV: Hiển thị trạng thái file --}}
                                    <div
                                        class="flex flex-col md:flex-row items-center gap-6 p-6 rounded-2xl bg-slate-50 border border-slate-100 mb-6">
                                        <div
                                            class="w-14 h-14 rounded-xl bg-primary-fixed/30 flex items-center justify-center text-primary-container">
                                            <span class="material-symbols-outlined text-3xl">description</span>
                                        </div>
                                        <div class="flex-1 text-center md:text-left">
                                            <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 mb-1">CV
                                                Hiện Tại</p>
                                            <h4 class="text-slate-800 font-semibold text-lg">
                                                {{ basename($user->cv_path) }}
                                            </h4>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ asset($user->cv_path) }}" target="_blank"
                                                class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-primary font-bold shadow-sm hover:shadow-md transition-all">
                                                Xem
                                            </a>
                                            <button onclick="document.getElementById('cv_upload_input').click()"
                                                class="px-5 py-2.5 rounded-xl bg-slate-200 text-slate-700 font-bold hover:bg-slate-300 transition-all">
                                                Thay đổi
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    {{-- Chưa có CV: Hiển thị khu vực Upload --}}
                                    <div onclick="document.getElementById('cv_upload_input').click()"
                                        class="group cursor-pointer border-2 border-dashed border-slate-200 rounded-[2rem] p-10 text-center hover:border-primary/50 hover:bg-primary/5 transition-all mb-6">
                                        <div
                                            class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/10 group-hover:text-primary transition-all">
                                            <span class="material-symbols-outlined text-3xl">cloud_upload</span>
                                        </div>
                                        <h4 class="font-bold text-slate-700">Tải lên CV của bạn</h4>
                                        <p class="text-sm text-slate-400 mt-1">Hỗ trợ định dạng PDF, DOCX (Tối đa 5MB)</p>
                                    </div>
                                @endif

                                {{-- Form ẩn để xử lý upload --}}
                                <form id="cvUploadForm" action="{{ route('user.cv.upload') }}" method="POST"
                                    enctype="multipart/form-data" class="hidden">
                                    @csrf
                                    <input type="file" id="cv_upload_input" name="cv_file" onchange="this.form.submit()"
                                        accept=".pdf,.doc,.docx">
                                </form>
                            </div>

                            {{-- Cột phụ --}}
                            <div class="space-y-8">

                                {{-- Thống kê --}}
                                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
                                    <h4 class="font-calistoga text-lg text-slate-900 mb-6">Thống kê hồ sơ</h4>
                                    <div class="space-y-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">
                                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                                </div>
                                                <span class="text-slate-500 font-medium text-sm">Lượt xem</span>
                                            </div>
                                            <span class="font-bold text-slate-800">{{ $profileViews ?? 0 }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                                    <span class="material-symbols-outlined text-[18px]">work</span>
                                                </div>
                                                <span class="text-slate-500 font-medium text-sm">Đã ứng tuyển</span>
                                            </div>
                                            <span class="font-bold text-slate-800">{{ $appliedCount ?? 0 }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                                    <span
                                                        class="material-symbols-outlined text-[18px]">assignment_turned_in</span>
                                                </div>
                                                <span class="text-slate-500 font-medium text-sm">Phỏng vấn</span>
                                            </div>
                                            <span class="font-bold text-slate-800">{{ $interviewCount ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Chưa đăng nhập --}}
                        <div
                            class="bg-white rounded-[2rem] p-12 text-center shadow-sm border border-slate-100 max-w-md mx-auto">
                            <div
                                class="w-20 h-20 rounded-full bg-primary-fixed/30 flex items-center justify-center mx-auto mb-6">
                                <span class="material-symbols-outlined text-4xl text-primary">person_off</span>
                            </div>
                            <h4 class="text-2xl font-calistoga text-slate-900 mb-3">👋 Chào bạn</h4>
                            <p class="text-slate-500 mb-8">Vui lòng đăng nhập để xem thông tin cá nhân.</p>
                            <a href="{{ route('auth/login') }}"
                                class="electric-gradient text-white font-bold py-4 px-8 rounded-2xl inline-block shadow-lg hover:brightness-110 transition-all">
                                Đăng nhập ngay
                            </a>
                        </div>
                    @endauth
                </div>
        </main>
    </div>
    <div id="confirmModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl p-6 w-full max-w-sm shadow-xl">

            <h3 class="text-lg font-semibold text-slate-800 mb-2">
                Xác nhận thay đổi
            </h3>

            <p id="confirmText" class="text-sm text-slate-500 mb-6">
                Bạn có chắc chắn cho phép nhà tuyển dụng nhìn thấy bạn?
            </p>

            <div class="flex justify-end gap-3">
                <button onclick="closeModal()" class="px-4 py-2 text-sm rounded-lg bg-slate-100 hover:bg-slate-200">
                    Hủy
                </button>

                <button onclick="confirmToggle()"
                    class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function toggleSearchStatus(checkbox) {
                const isPublic = checkbox.checked ? 1 : 0;

                fetch("{{ route('user.cv.toggle-public') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            is_public: isPublic
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        checkbox.disabled = false;

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: isPublic ? 'Đã công khai hồ sơ' : 'Đã ẩn hồ sơ',
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            throw new Error();
                        }
                    })
                    .catch(() => {
                        // rollback UI nếu lỗi
                        checkbox.checked = !checkbox.checked;
                        checkbox.disabled = false;

                        Swal.fire({
                            icon: 'error',
                            title: 'Có lỗi xảy ra',
                            text: 'Vui lòng thử lại'
                        });
                    });
            }
        </script>
    @endpush
    <script>
        let pendingToggle = null;
        let previousState = null;

        function handleToggleClick(e) {
            e.preventDefault();
            e.stopPropagation();

            const checkbox = e.target;
            pendingToggle = checkbox;
            previousState = checkbox.checked;

            const isTurningOn = !previousState;

            // 🔥 update nội dung modal
            document.getElementById('confirmText').innerText =
                isTurningOn ?
                "Bạn có chắc muốn ẩn hồ sơ khỏi nhà tuyển dụng?" :
                "Bạn có chắc muốn cho phép nhà tuyển dụng tìm thấy hồ sơ của bạn?";

            // show modal
            const modal = document.getElementById('confirmModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('confirmModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            // 🔥 reset
            pendingToggle = null;
        }

        function confirmToggle() {
            if (!pendingToggle) return;

            // đổi trạng thái
            pendingToggle.checked = !previousState;

            // disable tạm (tránh spam click)
            pendingToggle.disabled = true;

            // gọi API
            toggleSearchStatus(pendingToggle);

            // 🔥 reset
            pendingToggle = null;

            closeModal();
        }
    </script>

@endsection
