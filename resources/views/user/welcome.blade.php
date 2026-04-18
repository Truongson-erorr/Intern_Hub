@extends('user.layout.app')

@section('title', $job->title . ' - Intern.hub')

@section('content')
    <main class="max-w-7xl mx-auto px-6 pt-32 grid grid-cols-1 lg:grid-cols-12 gap-10">

        {{-- Hero Search Section (Recessed) --}}
        <section class="lg:col-span-12 mb-8">
            <div class="clay-recessed bg-surface-container-low rounded-xl p-4 flex flex-col md:flex-row gap-4 items-center">
                <form method="GET" action="{{ route('user.timviec') }}" class="contents">
                    <div class="flex-1 flex items-center gap-3 px-4 py-2">
                        <span class="material-symbols-outlined text-primary">search</span>
                        <input name="keyword"
                            class="bg-transparent border-none focus:ring-0 w-full font-medium text-on-surface"
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
                        class="clay-btn-primary text-white font-bold py-3 px-10 rounded-full hover-lift press-scale">
                        Tìm kiếm
                    </button>
                </form>
            </div>
        </section>

        {{-- Main Content Area --}}
        <div class="lg:col-span-8 space-y-10">

            {{-- Job Detail Main Card --}}
            <article class="clay-card bg-surface/60 backdrop-blur-xl rounded-xl p-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[100px]"></div>

                <header class="mb-10">
                    <div class="flex justify-between items-start mb-6">
                        {{-- Company Logo --}}
                        <div
                            class="w-20 h-20 rounded-lg clay-card overflow-hidden bg-surface-container flex items-center justify-center">
                            @if ($job->employer->company_logo ?? false)
                                <img class="w-full h-full object-cover" src="{{ $job->employer->company_logo }}"
                                    alt="{{ $job->employer->company_name ?? 'Company' }}" />
                            @else
                                <span
                                    class="text-3xl font-black text-primary">{{ strtoupper(substr($job->employer->company_name ?? 'C', 0, 2)) }}</span>
                            @endif
                        </div>

                        <div class="flex gap-3">
                            {{-- Bookmark Button --}}
                            <form action="{{ route('user.saved.store', $job->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="p-3 clay-card bg-surface-container-lowest text-primary rounded-full hover-lift press-scale">
                                    <span class="material-symbols-outlined">bookmark</span>
                                </button>
                            </form>

                            {{-- Share Button --}}
                            <button
                                class="p-3 clay-card bg-surface-container-lowest text-primary rounded-full hover-lift press-scale">
                                <span class="material-symbols-outlined">share</span>
                            </button>
                        </div>
                    </div>

                    <h1 class="text-5xl font-black font-headline text-on-surface tracking-tight mb-4">{{ $job->title }}
                    </h1>

                    <div class="flex flex-wrap gap-3 mt-6">
                        <span
                            class="clay-card bg-surface-container-low px-5 py-2 rounded-full text-primary font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">payments</span> {{ $job->salary }}
                        </span>
                        <span
                            class="clay-card bg-surface-container-low px-5 py-2 rounded-full text-secondary font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">schedule</span>
                            {{ $job->work_time ?? 'Full-time' }}
                        </span>
                        <span
                            class="clay-card bg-surface-container-low px-5 py-2 rounded-full text-on-surface-variant font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">location_on</span> {{ $job->location }}
                        </span>
                        <span
                            class="clay-card bg-surface-container-low px-5 py-2 rounded-full text-on-surface-variant font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">hourglass_top</span> Hạn:
                            {{ $job->deadline }}
                        </span>
                    </div>
                </header>

                <div class="space-y-12">
                    {{-- Job Description --}}
                    <section>
                        <h3 class="text-2xl font-black font-headline text-on-surface mb-4">Mô tả công việc</h3>
                        <p class="text-lg leading-relaxed text-on-surface-variant font-body whitespace-pre-line">
                            {{ $job->description }}
                        </p>
                    </section>

                    {{-- Requirements --}}
                    @if ($job->candidate_requirements)
                        <section>
                            <h3 class="text-2xl font-black font-headline text-on-surface mb-6">Yêu cầu ứng viên</h3>
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
                                            <span class="material-symbols-outlined text-primary mt-1">check_circle</span>
                                            <span class="text-lg text-on-surface-variant">{{ $req }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Benefits & Degree --}}
                    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if ($job->benefits)
                            <div class="clay-card bg-primary/5 p-6 rounded-lg">
                                <h4 class="font-bold text-primary mb-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined">volunteer_activism</span> Quyền lợi
                                </h4>
                                <ul class="text-sm text-on-surface-variant space-y-1">
                                    @foreach (explode("\n", $job->benefits) as $benefit)
                                        @php
                                            $benefit = trim($benefit);
                                            if (substr($benefit, 0, 1) === '-') {
                                                $benefit = ltrim($benefit, '- ');
                                            }
                                        @endphp
                                        @if ($benefit)
                                            <li>• {{ $benefit }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($job->degree_requirements)
                            <div class="clay-card bg-secondary/5 p-6 rounded-lg">
                                <h4 class="font-bold text-secondary mb-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined">school</span> Yêu cầu bằng cấp
                                </h4>
                                <p class="text-sm text-on-surface-variant">{{ $job->degree_requirements }}</p>
                            </div>
                        @endif
                    </section>

                    {{-- Additional Info --}}
                    <section class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
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
                <footer class="mt-16 pt-10 border-t border-outline-variant/10 flex flex-col sm:flex-row gap-6">
                    <button
                        class="clay-btn-primary flex-1 py-5 text-white font-black text-xl rounded-xl hover-lift press-scale"
                        data-bs-toggle="modal" data-bs-target="#applyModal">
                        Ứng tuyển ngay
                    </button>
                    <form action="{{ route('user.saved.store', $job->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="clay-card bg-surface-container-low w-full py-5 text-primary font-black text-xl rounded-xl hover-lift press-scale">
                            💾 Lưu công việc
                        </button>
                    </form>
                </footer>
            </article>

            {{-- Application Modal --}}
            <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content clay-card bg-surface rounded-xl p-0 border-0">
                        <div class="modal-header border-0 px-8 pt-8 pb-4">
                            <h5 class="modal-title text-2xl font-black font-headline text-on-surface"
                                id="applyModalLabel">
                                Ứng tuyển: {{ $job->title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body px-8 pb-4 space-y-6">
                                <div class="space-y-2">
                                    <label class="font-bold text-sm text-on-surface-variant ml-4">Tải CV của bạn
                                        (PDF)</label>
                                    <div class="clay-recessed bg-surface-container-low rounded-full px-6 py-4">
                                        <input type="file" name="cv" accept="application/pdf" required
                                            class="bg-transparent border-none focus:ring-0 w-full text-on-surface" />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="font-bold text-sm text-on-surface-variant ml-4">Giới thiệu về bạn</label>
                                    <div class="clay-recessed bg-surface-container-low rounded-xl px-6 py-4">
                                        <textarea name="introduction" rows="4" required
                                            class="bg-transparent border-none focus:ring-0 w-full text-on-surface"
                                            placeholder="Hãy viết vài dòng giới thiệu về bản thân..."></textarea>
                                    </div>
                                </div>

                                <div class="clay-card bg-yellow-50 p-4 rounded-lg text-sm">
                                    <strong class="text-yellow-800">Lưu ý:</strong><br>
                                    <span class="text-yellow-700">InternHub khuyên tất cả các bạn hãy luôn cẩn trọng trong
                                        quá trình tìm việc và chủ động nghiên cứu về thông tin công ty trước khi ứng
                                        tuyển.</span>
                                </div>
                            </div>

                            <div class="modal-footer border-0 px-8 pb-8 pt-4 flex gap-3">
                                <button type="button"
                                    class="clay-card bg-surface-container-low px-6 py-3 text-on-surface-variant font-bold rounded-full hover-lift"
                                    data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit"
                                    class="clay-btn-primary px-8 py-3 text-white font-black rounded-full hover-lift press-scale">
                                    Gửi đơn ứng tuyển
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Area --}}
        <aside class="lg:col-span-4 space-y-8">

            {{-- Company Info Card --}}
            <section class="clay-card bg-surface-container-low rounded-xl p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-white rounded-lg clay-card overflow-hidden flex items-center justify-center">
                        @if ($job->employer->company_logo ?? false)
                            <img class="w-full h-full object-cover" src="{{ $job->employer->company_logo }}"
                                alt="{{ $job->employer->company_name ?? 'Company' }}" />
                        @else
                            <span
                                class="font-black text-primary text-xl">{{ strtoupper(substr($job->employer->company_name ?? 'C', 0, 2)) }}</span>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-black text-xl">{{ $job->employer->company_name ?? 'Chưa cập nhật' }}</h4>
                        <p class="text-xs text-on-surface-variant">{{ $job->employer->industry ?? 'Công nghệ' }}</p>
                    </div>
                </div>

                <div class="space-y-3 text-sm">
                    @if ($job->employer->website ?? false)
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-lg">language</span>
                            <a href="{{ $job->employer->website }}" target="_blank"
                                class="text-primary hover:underline">{{ $job->employer->website }}</a>
                        </p>
                    @endif

                    @if ($job->employer->contact_email ?? false)
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-lg">mail</span>
                            <span class="text-on-surface-variant">{{ $job->employer->contact_email }}</span>
                        </p>
                    @endif

                    @if ($job->employer->phone ?? false)
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-lg">call</span>
                            <span class="text-on-surface-variant">{{ $job->employer->phone }}</span>
                        </p>
                    @endif
                </div>
            </section>

            {{-- Interview Tips Card --}}
            <section class="clay-card bg-secondary/5 rounded-xl p-6 border-2 border-secondary/10">
                <h4 class="font-black text-secondary mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">tips_and_updates</span> Mẹo phỏng vấn
                </h4>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center text-[10px] font-bold">
                            1</div>
                        <p class="text-sm text-on-surface-variant">Chuẩn bị kỹ hồ sơ và portfolio (nếu có)</p>
                    </div>
                    <div class="flex gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center text-[10px] font-bold">
                            2</div>
                        <p class="text-sm text-on-surface-variant">Nghiên cứu kỹ về công ty và vị trí ứng tuyển</p>
                    </div>
                    <div class="flex gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center text-[10px] font-bold">
                            3</div>
                        <p class="text-sm text-on-surface-variant">Ăn mặc lịch sự và đến đúng giờ</p>
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
                                <div class="clay-card bg-surface rounded-lg p-4 hover-lift cursor-pointer">
                                    <h5 class="font-bold text-on-surface">{{ $related->title }}</h5>
                                    <p class="text-xs text-on-surface-variant">{{ $related->location }}</p>
                                    <div class="flex justify-between items-center mt-3">
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

    {{-- Success Modal --}}
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content clay-card bg-surface rounded-xl p-0 border-0">
                <div class="modal-body text-center p-8">
                    <span class="material-symbols-outlined text-6xl text-primary mb-4">check_circle</span>
                    <h5 id="successMessage" class="text-xl font-black text-on-surface mb-3"></h5>
                    <button type="button"
                        class="clay-btn-primary px-8 py-3 text-white font-bold rounded-full hover-lift press-scale mt-4"
                        data-bs-dismiss="modal">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));

            @if (session('save_success'))
                document.getElementById('successMessage').innerText = "{{ session('save_success') }}";
                successModal.show();
            @elseif (session('apply_success'))
                document.getElementById('successMessage').innerText = "{{ session('apply_success') }}";
                successModal.show();
            @endif
        });
    </script>
@endsection
