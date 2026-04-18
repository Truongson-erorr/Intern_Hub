@extends('user.layout.app')

@section('title', $job->title . ' - Intern.hub')

@push('styles')
    <style>
        /* Claymorphism & Custom Styles for Job Detail */
        .clay-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(0, 30, 60, 0.08), inset 0 1px 4px rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
        }

        .clay-recessed {
            background: rgba(243, 243, 243, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.02), inset 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .clay-btn-primary {
            background: linear-gradient(135deg, #0052FF 0%, #4D7CFF 100%);
            box-shadow: 0 4px 12px rgba(0, 82, 255, 0.25), inset 0 1px 2px rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.2s cubic-bezier(0.2, 0.9, 0.4, 1);
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -6px rgba(0, 50, 100, 0.15), inset 0 1px 4px rgba(255, 255, 255, 0.5);
        }

        .press-scale:active {
            transform: scale(0.97);
            box-shadow: 0 2px 8px rgba(0, 82, 255, 0.2);
        }

        /* Đảm bảo modal hiển thị đúng */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
        }
    </style>
@endpush

@section('content')
    <main class="max-w-7xl mx-auto px-6 lg:px-8 pt-8 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

        {{-- Hero Search Section (nằm trên cùng) --}}
        <section class="lg:col-span-12 mb-6">
            <div class="clay-recessed bg-surface-container-low rounded-2xl p-4 flex flex-col md:flex-row gap-4 items-center">
                <form method="GET" action="{{ route('user.timviec') }}" class="contents">
                    <div class="flex-1 flex items-center gap-3 px-4 py-2">
                        <span class="material-symbols-outlined text-primary">search</span>
                        <input name="keyword"
                            class="bg-transparent border-none focus:ring-0 w-full font-medium text-on-surface placeholder:text-outline-variant"
                            placeholder="Tìm kiếm công ty hoặc vị trí..." type="text" value="{{ request('keyword') }}" />
                    </div>
                    <div class="w-px h-8 bg-outline-variant/30 hidden md:block"></div>
                    <div class="flex-1 flex items-center gap-3 px-4 py-2">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <select name="location"
                            class="bg-transparent border-none focus:ring-0 w-full font-medium text-on-surface appearance-none cursor-pointer">
                            <option value="">Toàn Việt Nam</option>
                            <option value="Ha Noi" {{ request('location') == 'Ha Noi' ? 'selected' : '' }}>Hà Nội</option>
                            <option value="Ho Chi Minh" {{ request('location') == 'Ho Chi Minh' ? 'selected' : '' }}>TP. Hồ
                                Chí Minh</option>
                            <option value="Da Nang" {{ request('location') == 'Da Nang' ? 'selected' : '' }}>Đà Nẵng
                            </option>
                        </select>
                    </div>
                    <button type="submit"
                        class="clay-btn-primary text-white font-bold py-3 px-10 rounded-xl hover-lift press-scale">
                        Tìm kiếm
                    </button>
                </form>
            </div>
        </section>

        {{-- Main Content (Left Column) --}}
        <div class="lg:col-span-8 space-y-8">

            {{-- Job Detail Main Card --}}
            <article
                class="clay-card relative overflow-hidden rounded-3xl p-6 md:p-8
                bg-gradient-to-br from-white via-surface-container-lowest to-surface-container
                shadow-[0px_25px_60px_rgba(46,46,53,0.12)]
                border border-white/60 backdrop-blur-xl">

                <div class="absolute -top-10 -right-10 w-60 h-60 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-secondary/10 rounded-full blur-2xl"></div>

                <header class="mb-8">
                    <div class="flex justify-between items-start mb-6">
                        {{-- Company Logo --}}
                        <div
                            class="w-16 h-16 md:w-20 md:h-20 rounded-xl clay-card overflow-hidden bg-surface-container flex items-center justify-center shrink-0">
                            @if ($job->employer->company_logo ?? false)
                                <img class="w-full h-full object-cover" src="{{ $job->employer->company_logo }}"
                                    alt="{{ $job->employer->company_name ?? 'Company' }}" />
                            @else
                                <span
                                    class="text-2xl md:text-3xl font-black text-primary">{{ strtoupper(substr($job->employer->company_name ?? 'C', 0, 2)) }}</span>
                            @endif
                        </div>

                        <div class="flex gap-2 md:gap-3">
                            {{-- Bookmark Button --}}
                            <form action="{{ route('user.saved.store', $job->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="p-3 clay-card bg-surface-container-lowest text-primary rounded-xl hover-lift press-scale">
                                    <span class="material-symbols-outlined">bookmark</span>
                                </button>
                            </form>

                            {{-- Share Button --}}
                            <button
                                class="p-3 clay-card bg-surface-container-lowest text-primary rounded-xl hover-lift press-scale"
                                onclick="openShareModal()">
                                <span class="material-symbols-outlined">share</span>
                            </button>
                        </div>
                    </div>

                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-black font-headline text-on-surface tracking-tight mb-4">
                        {{ $job->title }}</h1>

                    <div class="flex flex-wrap gap-2 md:gap-3 mt-6">
                        <span
                            class="clay-card bg-surface-container-low px-4 md:px-5 py-2 rounded-full text-primary font-bold flex items-center gap-2 text-sm md:text-base">
                            <span class="material-symbols-outlined text-[18px]">payments</span> {{ $job->salary }}
                        </span>
                        <span
                            class="clay-card bg-surface-container-low px-4 md:px-5 py-2 rounded-full text-secondary font-bold flex items-center gap-2 text-sm md:text-base">
                            <span class="material-symbols-outlined text-[18px]">schedule</span>
                            {{ $job->work_time ?? 'Full-time' }}
                        </span>
                        <span
                            class="clay-card bg-surface-container-low px-4 md:px-5 py-2 rounded-full text-on-surface-variant font-bold flex items-center gap-2 text-sm md:text-base">
                            <span class="material-symbols-outlined text-[18px]">location_on</span> {{ $job->location }}
                        </span>
                        <span
                            class="clay-card bg-surface-container-low px-4 md:px-5 py-2 rounded-full text-on-surface-variant font-bold flex items-center gap-2 text-sm md:text-base">
                            <span class="material-symbols-outlined text-[18px]">hourglass_top</span> Hạn:
                            {{ $job->deadline }}
                        </span>
                    </div>
                </header>

                <div class="space-y-10">
                    {{-- Job Description --}}
                    <section>
                        <h3
                            class="text-xl md:text-2xl font-black font-headline text-on-surface mb-4 flex items-center gap-3">
                            <span class="w-2 h-8 electric-gradient rounded-full"></span>
                            Mô tả công việc
                        </h3>
                        <div
                            class="text-base md:text-lg leading-relaxed text-on-surface-variant font-body whitespace-pre-line">
                            {{ $job->description }}
                        </div>
                    </section>

                    {{-- Requirements --}}
                    @if ($job->candidate_requirements)
                        <section>
                            <h3
                                class="text-xl md:text-2xl font-black font-headline text-on-surface mb-6 flex items-center gap-3">
                                <span class="w-2 h-8 electric-gradient rounded-full"></span>
                                Yêu cầu ứng viên
                            </h3>
                            <ul class="space-y-4">
                                @foreach (explode("\n", $job->candidate_requirements) as $req)
                                    @php
                                        $req = trim($req);
                                        if (substr($req, 0, 1) === '-') {
                                            $req = ltrim($req, '- ');
                                        }
                                    @endphp
                                    @if ($req)
                                        <li class="flex items-start gap-4">
                                            <span
                                                class="material-symbols-outlined text-primary mt-1 shrink-0">check_circle</span>
                                            <span
                                                class="text-base md:text-lg text-on-surface-variant">{{ $req }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Benefits & Degree --}}
                    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if ($job->benefits)
                            <div class="clay-card bg-primary/5 p-6 rounded-xl">
                                <h4 class="font-bold text-primary mb-3 flex items-center gap-2">
                                    <span class="material-symbols-outlined">volunteer_activism</span> Quyền lợi
                                </h4>
                                <ul class="text-sm text-on-surface-variant space-y-2">
                                    @foreach (explode("\n", $job->benefits) as $benefit)
                                        @php
                                            $benefit = trim($benefit);
                                            if (substr($benefit, 0, 1) === '-') {
                                                $benefit = ltrim($benefit, '- ');
                                            }
                                        @endphp
                                        @if ($benefit)
                                            <li class="flex items-start gap-2">
                                                <span class="text-primary">•</span>
                                                <span>{{ $benefit }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($job->degree_requirements)
                            <div class="clay-card bg-secondary/5 p-6 rounded-xl">
                                <h4 class="font-bold text-secondary mb-3 flex items-center gap-2">
                                    <span class="material-symbols-outlined">school</span> Yêu cầu bằng cấp
                                </h4>
                                <p class="text-sm text-on-surface-variant">{{ $job->degree_requirements }}</p>
                            </div>
                        @endif
                    </section>

                    {{-- Additional Info --}}
                    <section
                        class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm bg-surface-container-low/30 p-6 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">business</span>
                            <span class="text-on-surface-variant"><strong>Địa điểm làm việc:</strong>
                                {{ $job->work_location }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">attach_money</span>
                            <span class="text-on-surface-variant"><strong>Thu nhập:</strong>
                                {{ $job->income ?? $job->salary }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">mail</span>
                            <span class="text-on-surface-variant"><strong>Cách thức ứng tuyển:</strong>
                                {{ $job->application_method }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">badge</span>
                            <span class="text-on-surface-variant"><strong>Kinh nghiệm:</strong> {{ $job->experience }}
                                năm</span>
                        </div>
                    </section>
                </div>

                {{-- Footer Buttons --}}
                <footer class="mt-12 pt-8 border-t border-outline-variant/20 flex flex-col sm:flex-row gap-4">
                    <button
                        class="clay-btn-primary flex-1 py-4 md:py-5 text-white font-black text-lg md:text-xl rounded-xl hover-lift press-scale transition-all duration-300"
                        onclick="openApplyModal()">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">send</span>
                            Ứng tuyển ngay
                        </span>
                    </button>
                    <form action="{{ route('user.saved.store', $job->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="clay-card bg-surface-container-low w-full py-4 md:py-5 text-primary font-black text-lg md:text-xl rounded-xl hover-lift press-scale transition-all duration-300">
                            <span class="flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">bookmark</span>
                                Lưu công việc
                            </span>
                        </button>
                    </form>
                </footer>
            </article>
        </div>

        {{-- Sidebar (Right Column) --}}
        <aside class="lg:col-span-4 space-y-8">

            {{-- Company Info Card --}}
            <section
                class="clay-card relative rounded-2xl p-6 overflow-hidden
           bg-gradient-to-br from-white via-surface-container-lowest to-surface-container
           shadow-[0px_20px_50px_rgba(46,46,53,0.10)]
           border border-white/60 backdrop-blur-xl">

                {{-- Glow background --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/10 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-5">
                        {{-- Logo --}}
                        <div
                            class="w-14 h-14 bg-white rounded-xl shadow-md overflow-hidden flex items-center justify-center shrink-0">
                            @if ($job->employer->company_logo ?? false)
                                <img class="w-full h-full object-cover" src="{{ $job->employer->company_logo }}"
                                    alt="{{ $job->employer->company_name ?? 'Company' }}" />
                            @else
                                <span class="font-black text-primary text-xl">
                                    {{ strtoupper(substr($job->employer->company_name ?? 'C', 0, 2)) }}
                                </span>
                            @endif
                        </div>

                        <div>
                            <h4 class="font-black text-lg text-on-surface">
                                {{ $job->employer->company_name ?? 'Chưa cập nhật' }}
                            </h4>
                            <p class="text-xs text-on-surface-variant">
                                {{ $job->employer->industry ?? 'Công nghệ' }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm">
                        @if ($job->employer->website ?? false)
                            <p class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-base">language</span>
                                <a href="{{ $job->employer->website }}" target="_blank"
                                    class="text-primary hover:underline truncate font-medium">
                                    {{ $job->employer->website }}
                                </a>
                            </p>
                        @endif

                        @if ($job->employer->contact_email ?? false)
                            <p class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-base">mail</span>
                                <span class="text-on-surface-variant truncate">
                                    {{ $job->employer->contact_email }}
                                </span>
                            </p>
                        @endif
                    </div>
                </div>
            </section>

            {{-- Interview Tips Card --}}
            <section class="bg-inverse-surface text-inverse-on-surface rounded-2xl p-6 editorial-shadow">

                <h4 class="text-white opacity-80 mb-5 flex items-center gap-2 text-lg">
                    <span class="material-symbols-outlined">tips_and_updates</span>
                    Mẹo phỏng vấn
                </h4>

                <div class="space-y-4">
                    <div class="flex gap-3 items-start">
                        <div
                            class="w-7 h-7 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-sm">
                            1
                        </div>
                        <p class="text-white opacity-80 text-sm text-on-surface leading-relaxed">
                            Chuẩn bị kỹ hồ sơ và portfolio (nếu có)
                        </p>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div
                            class="w-7 h-7 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-sm">
                            2
                        </div>
                        <p class="text-white opacity-80 text-sm text-on-surface leading-relaxed">
                            Nghiên cứu kỹ về công ty và vị trí ứng tuyển
                        </p>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div
                            class="w-7 h-7 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-sm">
                            3
                        </div>
                        <p class="text-white opacity-80 text-sm text-on-surface leading-relaxed">
                            Ăn mặc lịch sự và đến đúng giờ
                        </p>
                    </div>
                </div>
            </section>

            {{-- Related Jobs --}}
            @if (isset($relatedJobs) && count($relatedJobs) > 0)
                <section>
                    <h4 class="font-black text-on-surface mb-4">Việc làm liên quan</h4>
                    <div class="space-y-4">
                        @foreach ($relatedJobs as $related)
                            <a href="{{ route('jobs.show', $related->id) }}" class="block">
                                <div
                                    class="clay-card bg-surface rounded-xl p-5 hover-lift cursor-pointer transition-all duration-300">
                                    <h5 class="font-bold text-on-surface mb-1">{{ $related->title }}</h5>
                                    <p class="text-xs text-on-surface-variant mb-3">{{ $related->location }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-primary font-bold text-sm">{{ $related->salary }}</span>
                                        <span class="material-symbols-outlined text-slate-300">chevron_right</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

        </aside>
    </main>

    {{-- Apply Modal --}}
    <div id="applyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" aria-hidden="true"
                onclick="closeApplyModal()"></div>

            <div
                class="relative w-full max-w-2xl my-8 overflow-hidden text-left align-middle transition-all transform clay-card bg-surface rounded-3xl">
                {{-- Modal Header --}}
                <div class="flex justify-between items-center px-8 py-6 border-b border-outline-variant/20">
                    <h3 class="text-2xl font-black font-headline text-on-surface" id="modal-title">
                        Ứng tuyển: {{ $job->title }}
                    </h3>
                    <button onclick="closeApplyModal()"
                        class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="px-8 py-6 space-y-6">
                        <div class="space-y-2">
                            <label class="font-bold text-sm text-on-surface-variant ml-2">Tải CV của bạn (PDF)</label>
                            <div class="clay-recessed bg-surface-container-low rounded-2xl px-6 py-5">
                                <input type="file" name="cv" accept="application/pdf" required
                                    class="bg-transparent border-none focus:ring-0 w-full text-on-surface file:mr-4 file:py-2 file:px-5 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary file:text-white hover:file:bg-primary-dim transition-all" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="font-bold text-sm text-on-surface-variant ml-2">Giới thiệu về bạn</label>
                            <div class="clay-recessed bg-surface-container-low rounded-2xl px-6 py-5">
                                <textarea name="introduction" rows="5" required
                                    class="bg-transparent border-none focus:ring-0 w-full text-on-surface resize-none"
                                    placeholder="Hãy viết vài dòng giới thiệu về bản thân, kinh nghiệm và lý do bạn phù hợp với vị trí này..."></textarea>
                            </div>
                        </div>

                        <div class="clay-card bg-yellow-50/80 p-5 rounded-2xl text-sm">
                            <strong class="text-yellow-800 flex items-center gap-2">
                                <span class="material-symbols-outlined text-lg">warning</span>
                                Lưu ý
                            </strong>
                            <p class="text-yellow-700 mt-1">InternHub khuyên tất cả các bạn hãy luôn cẩn trọng trong quá
                                trình tìm việc và chủ động nghiên cứu về thông tin công ty trước khi ứng tuyển.
                                Hãy kiểm tra kỹ website chính thức, đánh giá từ nhân viên cũ, cũng như thông tin pháp lý của
                                doanh nghiệp để đảm bảo tính minh bạch và uy tín. Tránh cung cấp thông tin cá nhân nhạy cảm
                                hoặc chuyển tiền dưới bất kỳ hình thức nào khi chưa xác minh rõ ràng.</p>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex gap-4 px-8 py-6 bg-surface-container-low/30 border-t border-outline-variant/20">
                        <button type="button" onclick="closeApplyModal()"
                            class="clay-card bg-surface-container-low px-6 py-3 text-on-surface-variant font-bold rounded-xl hover-lift">
                            Hủy
                        </button>
                        <button type="submit"
                            class="clay-btn-primary flex-1 py-3 text-white font-black rounded-xl hover-lift press-scale flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">send</span>
                            Gửi đơn ứng tuyển
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Success Modal --}}
    <div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="success-modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" aria-hidden="true"
                onclick="closeSuccessModal()"></div>

            <div
                class="relative w-full max-w-md p-8 overflow-hidden text-center align-middle transition-all transform clay-card bg-surface rounded-3xl">
                <span class="material-symbols-outlined text-7xl text-primary mb-4">check_circle</span>
                <h5 class="text-xl font-black text-on-surface mb-3" id="successMessage"></h5>
                <button type="button" onclick="closeSuccessModal()"
                    class="clay-btn-primary px-8 py-3 text-white font-bold rounded-xl hover-lift press-scale mt-6">
                    Đóng
                </button>
            </div>
        </div>
    </div>
    {{-- Share Modal --}}
    <div id="shareModal"
    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-sm">

        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-[0px_25px_60px_rgba(0,0,0,0.2)] relative">

            {{-- Close --}}
            <button onclick="closeShareModal()" class="absolute top-3 right-3 text-gray-400 hover:text-black">
                ✕
            </button>

            <h3 class="text-xl font-bold mb-4 text-center">Chia sẻ công việc</h3>

            {{-- Link --}}
            <div class="flex items-center gap-2 bg-gray-100 rounded-lg px-3 py-2">
                <input id="shareLink" type="text" readonly value="{{ url()->current() }}"
                    class="flex-1 bg-transparent border-none focus:ring-0 text-sm">

                <button onclick="copyLink()" class="bg-primary text-white px-3 py-1 rounded-md text-sm">
                    Lưu Đường Dẫn
                </button>
            </div>

            <p id="copyMsg" class="text-green-500 text-sm mt-3 hidden text-center">
                Đã copy link!
            </p>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Modal functions
        function openApplyModal() {
            document.getElementById('applyModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeApplyModal() {
            document.getElementById('applyModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function shareJob() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $job->title }}',
                    text: 'Xem công việc này trên Intern.hub',
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(window.location.href);
                alert('Đã sao chép link công việc!');
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeApplyModal();
                closeSuccessModal();
            }
        });

        // Show success modal if session has message
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('save_success'))
                document.getElementById('successMessage').innerText = "{{ session('save_success') }}";
                document.getElementById('successModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            @elseif (session('apply_success'))
                document.getElementById('successMessage').innerText = "{{ session('apply_success') }}";
                document.getElementById('successModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            @endif
        });

        function openShareModal() {
            const modal = document.getElementById('shareModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // quan trọng để center modal
            document.body.style.overflow = 'hidden';
        }

        function closeShareModal() {
            const modal = document.getElementById('shareModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function copyLink() {
            const input = document.getElementById('shareLink');
            input.select();
            input.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(input.value);

            const msg = document.getElementById('copyMsg');
            msg.classList.remove('hidden');

            setTimeout(() => {
                msg.classList.add('hidden');
            }, 2000);
        }
    </script>
@endpush
