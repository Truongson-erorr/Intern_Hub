@extends('user.layout.app')

@section('title', 'Trang Chủ - Intern.hub')

@section('content')
    {{-- Hero Section --}}
    <section class="relative px-8 pt-20 pb-32 max-w-[1440px] mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="z-10">
                <span
                    class="inline-block px-4 py-1.5 rounded-full bg-secondary-fixed text-on-secondary-fixed text-xs font-bold tracking-widest uppercase mb-6">#1
                    Vietnam Internship Platform</span>
                <h1 class="text-6xl md:text-7xl mb-9 leading-[1.2] text-on-surface">
                    Bắt đầu sự nghiệp <br /><span class="text-primary-container"> cùng Intern.hub</span>
                </h1>
                <p class="text-xl text-on-surface-variant max-w-xl mb-12 leading-[1.7]">
                    Nền tảng kết nối sinh viên với hàng ngàn doanh nghiệp hàng đầu tại Việt Nam. Khởi đầu sự nghiệp của bạn
                    ngay hôm nay.
                </p>

                {{-- Search Bar --}}
                <div class="relative max-w-3xl mx-auto">
                    <form method="GET" action="{{ route('user.timviec') }}"
                        class="flex flex-col md:flex-row items-center gap-3 p-2 rounded-2xl bg-white/80 backdrop-blur-xl 
               shadow-[0px_20px_40px_rgba(46,46,53,0.08),inset_2px_2px_6px_rgba(255,255,255,0.6)]
               focus-within:ring-2 ring-primary/20 transition-all">

                        {{-- Keyword --}}
                        <div class="flex items-center flex-1 px-4 w-full">
                            <span class="material-symbols-outlined text-primary mr-3">search</span>
                            <input name="keyword" value="{{ request('keyword') }}" type="text"
                                placeholder="Vị trí ứng tuyển..."
                                class="w-full bg-transparent border-none focus:ring-0 text-base md:text-lg 
                       font-medium placeholder:text-slate-400" />
                        </div>

                        {{-- Divider --}}
                        <div class="hidden md:block w-px h-8 bg-slate-200"></div>

                        {{-- Location --}}
                        <div class="flex items-center px-4 w-full md:w-auto">
                            <span class="material-symbols-outlined text-primary mr-2">location_on</span>
                            <select name="location"
                                class="bg-transparent border-none focus:ring-0 text-sm md:text-base 
                       font-medium cursor-pointer pr-6 text-slate-700">
                                <option value="">Toàn quốc</option>
                                <option value="Ha Noi" {{ request('location') == 'Ha Noi' ? 'selected' : '' }}>Hà Nội
                                </option>
                                <option value="Ho Chi Minh" {{ request('location') == 'Ho Chi Minh' ? 'selected' : '' }}>TP.
                                    Hồ Chí Minh</option>
                                <option value="Da Nang" {{ request('location') == 'Da Nang' ? 'selected' : '' }}>Đà Nẵng
                                </option>
                            </select>
                        </div>

                        {{-- Button --}}
                        <button type="submit"
                            class="px-6 md:px-8 py-3 rounded-xl font-bold text-white text-sm md:text-base
                   bg-gradient-to-r from-violet-600 to-purple-400
                   shadow-lg shadow-violet-200 hover:scale-105 active:scale-95 transition-all w-full md:w-auto">
                            Tìm kiếm
                        </button>
                    </form>
                </div>
            </div>

            {{-- Abstract Graphic giữ nguyên từ template --}}
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-primary-container/5 rounded-[4rem] rotate-3 -z-10"></div>
                <div
                    class="bg-surface-container-lowest p-8 rounded-[3rem] shadow-2xl relative overflow-hidden border border-white/50">
                    <div class="absolute top-0 right-0 p-8">
                        <div
                            class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center text-white">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="h-64 rounded-2xl bg-surface-container-low overflow-hidden">
                            <img alt="Tech Preview" class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDI2PKUfHkP2yegQ9dK9GOAwH5bA8G9HqhWNHDo24slsDINeRemlM1PWJtLlwJpRBiH9XZBOfcmmICcqgvMLnG8ZauFS3HDwRpNJKo8-dkGYrtZ8ahIeRe1D3zqK7extDs1g1kMAjaz-9b-ooVrNgL8EU1xeHfY3qfPdn9weO8KUPmqG9YSStl36SfzdBpEiuEqZqLp5M8PdPg8LkC3USzAClNhlugbonNzks5KNyZKIq21i_WN75KWOqoL2Udf7q768v-YOrUsf6Q" />
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary-fixed"></div>
                            <div class="flex-grow">
                                <div class="h-3 w-1/3 bg-surface-variant rounded mb-2"></div>
                                <div class="h-3 w-2/3 bg-surface-container-high rounded"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="h-20 bg-primary-container/10 rounded-xl"></div>
                            <div class="h-20 bg-secondary-container/10 rounded-xl"></div>
                            <div class="h-20 bg-tertiary-container/10 rounded-xl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="bg-surface-container-low py-32">
        <div class="max-w-[1440px] mx-auto px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <h2 class="text-4xl md:text-5xl mb-4 text-on-surface">Lĩnh vực hàng đầu</h2>
                    <p class="text-on-surface-variant max-w-lg leading-[1.7]">Khám phá các cơ hội theo chuyên môn của bạn
                    </p>
                </div>
                <a href="{{ route('user.timviec') }}"
                    class="text-primary font-bold flex items-center gap-2 hover:gap-4 transition-all">
                    Xem tất cả
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $categories = [
                        ['icon' => 'code', 'name' => 'Web Dev', 'color' => 'bg-primary-fixed text-primary'],
                        ['icon' => 'smartphone', 'name' => 'Mobile', 'color' => 'bg-secondary-fixed text-secondary'],
                        ['icon' => 'database', 'name' => 'Database', 'color' => 'bg-tertiary-fixed text-tertiary'],
                        [
                            'icon' => 'cloud',
                            'name' => 'DevOps',
                            'color' => 'bg-primary-container/10 text-primary-container',
                        ],
                        [
                            'icon' => 'security',
                            'name' => 'Network',
                            'color' => 'bg-secondary-container/10 text-secondary-container',
                        ],
                        ['icon' => 'psychology', 'name' => 'AI', 'color' => 'bg-error-container text-error'],
                        ['icon' => 'palette', 'name' => 'UI/UX', 'color' => 'bg-inverse-primary/30 text-primary'],
                        [
                            'icon' => 'api',
                            'name' => 'Backend',
                            'color' => 'bg-tertiary-fixed-dim text-on-tertiary-fixed-variant',
                        ],
                    ];
                @endphp

                @foreach ($categories as $cat)
                    <a href="{{ route('user.timviec', ['category' => $cat['name']]) }}" class="block">
                        <div
                            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_4px_24px_-2px_rgba(15,23,42,0.06)] hover:translate-y-[-8px] transition-transform duration-300">
                            <div class="w-14 h-14 {{ $cat['color'] }} flex items-center justify-center rounded-lg mb-6">
                                <span class="material-symbols-outlined text-3xl">{{ $cat['icon'] }}</span>
                            </div>
                            <h3 class="text-2xl mb-4">{{ $cat['name'] }}</h3>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="text-xs font-bold text-outline uppercase px-2 py-1 bg-surface-container-low rounded">Hot</span>
                                <span
                                    class="text-xs font-bold text-outline uppercase px-2 py-1 bg-surface-container-low rounded">Hot</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Job Listings --}}
    <section class="py-32 px-8 max-w-[1440px] mx-auto">
        <div class="text-center mb-20">
            <h2 class="text-5xl mb-6">Việc làm nổi bật</h2>
            <p class="text-on-surface-variant max-w-2xl mx-auto text-lg leading-[1.7]">Những cơ hội nghề nghiệp tốt nhất
                được cập nhật mỗi giờ từ các studio và tập đoàn công nghệ hàng đầu.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($jobs ?? [] as $job)
                <a href="{{ route('jobs.show', $job->id) }}" class="block group h-full">
                    <div
                        class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow group h-full flex flex-col">

                        {{-- Badge Hot/Urgent --}}
                        @if ($job->created_at > now()->subDays(7))
                            <div
                                class="absolute -top-3 -right-3 bg-secondary text-white px-4 py-1 rounded-full text-xs font-bold shadow-md z-10">
                                HOT
                            </div>
                        @elseif($job->urgent ?? false)
                            <div
                                class="absolute -top-3 -right-3 bg-primary text-white px-4 py-1 rounded-full text-xs font-bold shadow-md z-10">
                                URGENT
                            </div>
                        @endif

                        <div class="flex items-start justify-between mb-8">
                            <div class="w-16 h-16 bg-surface-container-low rounded-lg p-3">
                                @if ($job->company_logo)
                                    <img alt="{{ $job->company_name }}" class="w-full h-full object-contain"
                                        src="{{ $job->company_logo }}" />
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-primary/10 text-primary font-black text-xl">
                                        {{ strtoupper(substr($job->title, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <form action="{{ route('user.saved.store', $job->id) }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <span class="material-symbols-outlined text-outline hover:text-primary">
                                        bookmark
                                    </span>
                                </button>
                            </form>
                        </div>
                        {{-- Badge và thời gian --}}
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="bg-primary-fixed text-on-primary-fixed text-[10px] font-bold px-2 py-0.5 rounded tracking-widest uppercase">
                                {{ $job->work_time ?? 'Full-Time' }}
                            </span>
                            <span class="text-on-surface-variant text-sm flex items-center gap-1">
                                <span class="material-symbols-outlined text-base">schedule</span>
                                {{ $job->created_at ? $job->created_at->diffForHumans() : 'Mới đăng' }}
                            </span>
                        </div>
                        <h4 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors">{{ $job->title }}
                        </h4>

                        <p class="text-on-surface-variant text-sm mb-6 line-clamp-2 leading-[1.7]">
                            {{ $job->description ?? 'Mô tả công việc hấp dẫn...' }}</p>

                        <div class="flex flex-wrap gap-3 mb-8">
                            <div
                                class="flex items-center gap-1.5 text-on-surface-variant text-sm bg-surface-container-low px-3 py-1 rounded">
                                <span class="material-symbols-outlined text-base">location_on</span>
                                {{ $job->location }}
                            </div>
                            <div
                                class="flex items-center gap-1.5 text-primary text-sm font-bold bg-primary-fixed px-3 py-1 rounded">
                                <span class="material-symbols-outlined text-base">payments</span>
                                {{ $job->salary }}
                            </div>
                            <div
                                class="flex items-center gap-1.5 text-secondary text-sm font-bold bg-secondary-fixed px-3 py-1 rounded">
                                <span class="material-symbols-outlined text-base">work_history</span>
                                {{ $job->experience }} năm KN
                            </div>
                        </div>

                        {{-- Spacer để đẩy button xuống dưới --}}
                        <div class="flex-1"></div>

                        {{-- Tags (Skills) --}}
                        <div class="flex gap-2 flex-wrap mb-4">
                            @if (isset($job->skills) && is_array($job->skills))
                                @foreach ($job->skills as $skill)
                                    <span
                                        class="px-4 py-1.5 bg-surface-container-low text-xs font-bold rounded-full">{{ $skill }}</span>
                                @endforeach
                            @else
                                <span
                                    class="px-4 py-1.5 bg-surface-container-low text-xs font-bold rounded-full">{{ $job->type ?? 'Internship' }}</span>
                            @endif
                        </div>
                        @php
                            $isDeadlineValid = $job->deadline && \Carbon\Carbon::parse($job->deadline)->isFuture();
                        @endphp

                        <div class="text-sm font-bold mb-2 group-hover:text-primary transition-colors">
                            <span>Hạn Ứng Tuyển:
                                {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') : 'Không có' }}
                            </span>
                        </div>

                        @if ($isDeadlineValid)
                            {{-- Còn hạn --}}
                            <button
                                class="w-full py-3 rounded-lg border border-primary text-primary font-bold hover:bg-primary hover:text-white transition-all">
                                Ứng tuyển ngay
                            </button>
                        @else
                            {{-- Hết hạn --}}
                            <button
                                class="w-full py-3 rounded-lg border border-gray-300 text-gray-400 font-bold cursor-not-allowed"
                                disabled>
                                Đã hết hạn
                            </button>
                        @endif
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">work_off</span>
                    <p class="text-xl font-medium text-on-surface-variant">Chưa có công việc nào.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('user.timviec') }}"
                class="px-12 py-4 rounded-xl bg-surface-container-low text-primary font-bold hover:bg-surface-container-high transition-colors inline-block">
                Xem thêm các việc làm IT khác
            </a>
        </div>
    </section>

    {{-- Newsletter CTA --}}
    <section class="max-w-[1440px] mx-auto px-8 mb-32">
        <div class="electric-gradient rounded-[2.5rem] p-12 md:p-24 text-center text-white relative overflow-hidden">
            <div class="absolute -top-20 -left-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <h2 class="text-4xl md:text-5xl mb-8 relative z-10">Đừng bỏ lỡ công việc mơ ước</h2>
            <p class="text-white/80 text-lg mb-12 max-w-xl mx-auto relative z-10 leading-[1.7]">Nhận thông báo việc làm phù
                hợp nhất với kỹ năng của bạn trực tiếp qua email hàng tuần.</p>
            <div class="flex flex-col md:flex-row gap-4 max-w-2xl mx-auto relative z-10">
                <input class="flex-grow rounded-xl border-none py-4 px-6 text-on-surface text-lg"
                    placeholder="Nhập email của bạn..." type="email" />
                <button
                    class="bg-white text-primary px-10 py-4 rounded-xl font-bold text-lg hover:bg-primary-fixed transition-colors">Đăng
                    ký ngay</button>
            </div>
        </div>
    </section>
@endsection
