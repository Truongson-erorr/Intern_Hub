@extends('user.layout.app') {{-- Hoặc 'user.layout.index' tùy cấu trúc --}}

@section('title', 'Đơn ứng tuyển của tôi')

@push('styles')
    <style>
        /* Các style đặc thù cho trang Applications */
        .brand-font,
        .font-calistoga {
            font-family: 'Calistoga', cursive;
        }

        .electric-gradient {
            background: linear-gradient(135deg, #0052FF 0%, #4D7CFF 100%);
        }

        .editorial-shadow {
            box-shadow: 0 4px 24px -2px rgba(15, 23, 42, 0.06);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <main class="flex-grow max-w-[1440px] mx-auto w-full px-8 py-16">
        {{-- Header Section --}}
        <div class="mb-16">
            <h1 class="font-calistoga text-[3.5rem] leading-[1.3] text-on-surface mb-4">Đơn ứng tuyển của tôi</h1>
            <p class="text-on-surface-variant text-lg max-w-2xl font-body">
                Theo dõi và quản lý các cơ hội nghề nghiệp mà bạn đã gửi hồ sơ. Chúng tôi sẽ cập nhật trạng thái ngay khi có
                phản hồi từ nhà tuyển dụng.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            {{-- Left Side: Stats & Filters --}}
            <aside class="lg:col-span-3 space-y-8">
                @php
                    $totalApplications = $applications->count();
                    // Có thể tính toán trạng thái từ cột 'status' nếu có, hiện tại để demo
                    $pendingCount = $applications->where('status', 'pending')->count();
                    $reviewingCount = $applications->where('status', 'reviewing')->count();
                    $rejectedCount = $applications->where('status', 'rejected')->count();
                @endphp
                <div class="bg-white p-6 rounded-xl editorial-shadow">
                    <h3 class="font-headline font-bold text-sm uppercase tracking-widest text-outline mb-6">Trạng thái</h3>
                    <ul class="space-y-4">
                        <li class="flex justify-between items-center text-primary font-medium">
                            <span>Tất cả đơn</span>
                            <span
                                class="bg-primary-fixed text-on-primary-fixed px-2 py-0.5 rounded text-xs">{{ $totalApplications }}</span>
                        </li>
                        <li
                            class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
                            <span>Đang xem xét</span>
                            <span
                                class="bg-surface-container text-on-surface-variant px-2 py-0.5 rounded text-xs">{{ $reviewingCount }}</span>
                        </li>
                        <li
                            class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
                            <span>Đã kết nối</span>
                            <span class="bg-surface-container text-on-surface-variant px-2 py-0.5 rounded text-xs">0</span>
                        </li>
                        <li
                            class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
                            <span>Từ chối</span>
                            <span
                                class="bg-surface-container text-on-surface-variant px-2 py-0.5 rounded text-xs">{{ $rejectedCount }}</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-primary p-8 rounded-xl text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="font-calistoga text-xl mb-2">Tối ưu hồ sơ?</h4>
                        <p class="text-sm opacity-80 mb-6 font-body">Nhận tư vấn từ các chuyên gia tuyển dụng hàng đầu để
                            tăng 80% tỷ lệ phản hồi.</p>
                        <a href="#"
                            class="bg-white text-primary px-4 py-2 rounded font-bold text-xs uppercase tracking-wider">Xem
                            ngay</a>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-10">
                        <span class="material-symbols-outlined text-[120px]">rocket_launch</span>
                    </div>
                </div>
            </aside>

            {{-- Main Content: Application Cards --}}
            <div class="lg:col-span-9 space-y-8">
                @forelse($applications as $application)
                    @php
                        $job = $application->job;
                        $status = $application->status ?? 'pending'; // pending, reviewing, rejected, accepted
                        $statusMap = [
                            'pending' => [
                                'label' => 'Đã gửi',
                                'class' => 'bg-surface-container-highest text-on-surface-variant',
                            ],
                            'reviewing' => ['label' => 'Đang xem xét', 'class' => 'bg-secondary-container text-white'],
                            'rejected' => [
                                'label' => 'Từ chối',
                                'class' => 'bg-error-container text-on-error-container',
                            ],
                            'accepted' => [
                                'label' => 'Đã kết nối',
                                'class' => 'bg-primary-container text-on-primary-container',
                            ],
                        ];
                        $statusInfo = $statusMap[$status] ?? $statusMap['pending'];
                    @endphp

                    <article
                        class="bg-white p-8 rounded-xl editorial-shadow transition-transform hover:-translate-y-1 duration-300">
                        <div class="flex flex-col md:flex-row justify-between gap-6">
                            <div class="flex-grow">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="{{ $statusInfo['class'] }} text-[0.6875rem] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                        {{ $statusInfo['label'] }}
                                    </span>
                                    <span class="text-outline text-xs font-body">Nộp ngày:
                                        {{ $application->created_at->format('d/m/Y') }}</span>
                                </div>

                                <h2 class="font-calistoga text-2xl text-on-surface mb-2">
                                    {{ $job->title ?? 'Công việc đã bị xóa' }}
                                </h2>
                                <div class="flex items-center gap-4 text-on-surface-variant text-sm mb-6 font-body">
                                    <div class="flex items-center">
                                        <span class="material-symbols-outlined text-sm mr-1">location_on</span>
                                        {{ $job->work_location ?? ($job->location ?? 'Không xác định') }}
                                    </div>
                                    <div class="flex items-center">
                                        <span class="material-symbols-outlined text-sm mr-1">apartment</span>
                                        {{ $job->company_name ?? 'Công ty' }}
                                    </div>
                                </div>

                                @if ($application->introduction)
                                    <div class="bg-surface-container-low p-4 rounded-lg mb-6 border-l-4 border-primary">
                                        <p class="text-sm text-on-surface italic font-body leading-relaxed">
                                            "{{ Str::limit($application->introduction, 200) }}"
                                        </p>
                                    </div>
                                @endif

                                <div class="flex items-center gap-6">
                                    @if ($application->cv_path)
                                        <button onclick="openCVModal('{{ asset('storage/' . $application->cv_path) }}')"
                                            class="text-primary font-medium flex items-center hover:underline text-sm">

                                            <span class="material-symbols-outlined mr-2">description</span>
                                            Xem CV đã gửi
                                        </button>
                                    @endif
                                    {{-- Có thể thêm nút Gửi tin nhắn --}}
                                    <a class="text-outline hover:text-on-surface font-medium flex items-center text-sm transition-colors"
                                        href="#">
                                        <span class="material-symbols-outlined mr-2">mail</span>
                                        Gửi tin nhắn
                                    </a>
                                </div>
                            </div>

                            <div
                                class="md:w-48 flex flex-col justify-between items-end border-l-0 md:border-l border-outline-variant/20 md:pl-8">
                                @if ($job && $job->company_logo)
                                    <img alt="Logo" class="w-16 h-16 rounded-xl object-cover mb-4"
                                        src="{{ $job->company_logo }}">
                                @else
                                    <div
                                        class="w-16 h-16 rounded-xl bg-surface-container-low mb-4 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-3xl text-outline">business</span>
                                    </div>
                                @endif
                                <a href="{{ route('jobs.show', $job->id ?? 0) }}"
                                    class="w-full electric-gradient text-white py-3 rounded-md font-bold text-xs uppercase tracking-widest shadow-lg shadow-primary-container/20 hover:shadow-primary-container/40 transition-all text-center">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    {{-- Empty State --}}
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-32 h-32 bg-surface-container-low rounded-full flex items-center justify-center mb-8">
                            <span class="material-symbols-outlined text-outline text-5xl">history_edu</span>
                        </div>
                        <h3 class="font-calistoga text-2xl mb-4">Bạn chưa ứng tuyển vị trí nào</h3>
                        <p class="text-on-surface-variant max-w-sm mx-auto mb-12 font-body">
                            Bắt đầu hành trình nghề nghiệp của bạn bằng cách khám phá hàng ngàn công việc IT hấp dẫn trên hệ
                            thống.
                        </p>
                        <a href="{{ route('user.timviec') }}"
                            class="electric-gradient text-white px-8 py-4 rounded-md font-bold text-sm uppercase tracking-widest">
                            Khám phá công việc ngay
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
    <script>
        function openCVModal(url) {
            document.getElementById('cvModal').classList.remove('hidden');
            document.getElementById('cvFrame').src = url;
        }

        function closeCVModal() {
            document.getElementById('cvModal').classList.add('hidden');
            document.getElementById('cvFrame').src = '';
        }
    </script>
    {{-- Modal CV --}}
    <div id="cvModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">

        <div class="bg-white w-[60%] max-w-2xl h-[65vh] rounded-xl overflow-hidden relative shadow-2xl">

            {{-- Close --}}
            <button onclick="closeCVModal()"
                class="absolute top-2 right-2 z-10 bg-white/90 rounded-full px-2 py-1 hover:bg-white text-sm">
                ✕
            </button>

            {{-- PDF --}}
            <iframe id="cvFrame" class="w-full h-full"></iframe>
        </div>
    </div>
@endsection
