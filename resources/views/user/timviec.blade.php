@extends('user.layout.app')

@section('title', 'Kết quả tìm việc - TechCurator')

@section('content')
    {{-- Hero Header với Search Form --}}
    <header class="relative pt-32 pb-24 md:pt-48 md:pb-32 bg-surface-container-low overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#003ec7 0.5px, transparent 0.5px); background-size: 24px 24px;"></div>
        <div class="max-w-7xl mx-auto px-8 relative z-10 text-center">
            <h1 class="font-calistoga text-4xl md:text-6xl text-on-surface mb-6 leading-tight max-w-4xl mx-auto">
                Tìm việc IT mơ ước của bạn ngay hôm nay
            </h1>
            <p class="text-on-surface-variant text-lg md:text-xl font-body max-w-2xl mx-auto mb-12 leading-relaxed">
                Kết nối với hàng ngàn công ty công nghệ hàng đầu tại Việt Nam
            </p>

            {{-- Search Form --}}
            <div class="max-w-3xl mx-auto bg-surface-container-lowest p-2 rounded-full editorial-shadow flex flex-col md:flex-row gap-2">
                <form method="GET" action="{{ route('user.timviec') }}" class="contents">
                    <div class="flex-grow flex items-center px-6 py-2">
                        <span class="material-symbols-outlined text-outline mr-3">search</span>
                        <input name="keyword" value="{{ request('keyword') }}"
                               class="w-full bg-transparent border-none focus:ring-0 text-on-surface text-lg"
                               placeholder="Nhập công việc..." type="text"/>
                    </div>
                    <div class="hidden md:block w-px h-8 self-center bg-outline-variant/30"></div>
                    <div class="flex items-center px-6 py-2 md:w-48">
                        <span class="material-symbols-outlined text-outline mr-3">location_on</span>
                        <select name="location" class="bg-transparent border-none focus:ring-0 text-on-surface w-full appearance-none cursor-pointer">
                            <option value="">Toàn quốc</option>
                            <option value="Ha Noi" {{ request('location') == 'Ha Noi' ? 'selected' : '' }}>Hà Nội</option>
                            <option value="Ho Chi Minh" {{ request('location') == 'Ho Chi Minh' ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
                            <option value="Da Nang" {{ request('location') == 'Da Nang' ? 'selected' : '' }}>Đà Nẵng</option>
                        </select>
                    </div>
                    <button type="submit" class="electric-gradient text-white px-10 py-4 rounded-full font-bold text-lg hover:shadow-lg transition-shadow">
                        Tìm kiếm
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- Search Results Section --}}
    <main class="max-w-7xl mx-auto px-8 py-16">
        {{-- Results Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <h2 class="text-on-surface-variant font-label text-xs tracking-widest uppercase mb-2">Kết quả tìm kiếm cho</h2>
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="font-calistoga text-3xl text-on-surface">"{{ $keyword ?? 'Tất cả' }}"</span>
                    <span class="bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full text-sm font-bold">{{ $jobs->count() }} công việc</span>
                </div>
            </div>
            <div class="flex items-center gap-4 text-sm text-on-surface-variant">
                <span>Sắp xếp theo:</span>
                <button class="flex items-center font-semibold text-primary">
                    Mới nhất
                    <span class="material-symbols-outlined text-sm ml-1">keyboard_arrow_down</span>
                </button>
            </div>
        </div>

        {{-- Job List Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($jobs as $job)
                <a href="{{ url('jobs/'.$job->id) }}" class="block group">
                    <div class="bg-surface-container-lowest p-8 rounded-xl editorial-shadow hover:translate-y-[-4px] transition-transform cursor-pointer h-full flex flex-col">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-14 h-14 bg-surface-container rounded-lg flex items-center justify-center overflow-hidden">
                                @if($job->employer->company_logo ?? false)
                                    <img class="w-10 h-10 object-contain" src="{{ $job->employer->company_logo }}" alt="{{ $job->employer->company_name ?? 'Company' }}"/>
                                @else
                                    <span class="text-primary font-bold text-lg">{{ strtoupper(substr($job->employer->company_name ?? 'C', 0, 2)) }}</span>
                                @endif
                            </div>
                            <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">bookmark</span>
                        </div>

                        <h3 class="font-calistoga text-xl text-on-surface mb-2 group-hover:text-primary transition-colors">{{ $job->title }}</h3>
                        <div class="flex items-center text-on-surface-variant text-sm mb-6">
                            <span class="material-symbols-outlined text-sm mr-1">location_on</span>
                            {{ $job->location }}
                        </div>

                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="bg-surface-container-low text-primary font-medium text-xs px-3 py-1.5 rounded-full">{{ $job->salary }}</span>
                            <span class="bg-surface-container-low text-on-surface-variant font-medium text-xs px-3 py-1.5 rounded-full">{{ $job->experience }} năm kinh nghiệm</span>
                        </div>

                        {{-- Spacer để đẩy footer xuống --}}
                        <div class="flex-grow"></div>

                        <div class="pt-6 border-t border-outline-variant/10 flex justify-between items-center">
                            <span class="text-xs text-outline font-medium uppercase tracking-wider">
                                Đăng {{ $job->created_at ? $job->created_at->diffForHumans() : 'mới' }}
                            </span>
                            <span class="text-primary font-bold text-sm flex items-center group/btn">
                                Chi tiết
                                <span class="material-symbols-outlined text-sm ml-1 group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-16">
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">search_off</span>
                    <p class="text-xl font-medium text-on-surface-variant">Không tìm thấy công việc nào phù hợp.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination (nếu dùng paginate) --}}
        @if(method_exists($jobs, 'links'))
            <div class="mt-16 flex justify-center">
                {{ $jobs->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        @endif
    </main>
@endsection