@extends('user.layout.app')

@section('title', 'Việc làm phù hợp với bạn')

@push('styles')
    <style>
        /* Các style bổ sung để đồng bộ với template */
        .editorial-shadow {
            box-shadow: 0 4px 24px -2px rgba(15, 23, 42, 0.06);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .electric-gradient {
            background: linear-gradient(135deg, #0052FF 0%, #4D7CFF 100%);
        }
    </style>
@endpush

@section('content')
    <main class="flex-grow pt-32 pb-24 px-8 max-w-[1440px] mx-auto w-full">
        {{-- Hero Section --}}
        <header class="mb-16 max-w-3xl">
            <h1 class="font-calistoga text-[3.5rem] leading-[1.3] text-on-surface mb-4">
                Việc làm phù hợp với bạn
            </h1>
            <p class="font-body text-lg leading-relaxed text-on-surface-variant opacity-80">
                Dựa trên ngành nghề bạn quan tâm, hệ thống sẽ gợi ý các công việc phù hợp để bạn dễ dàng lựa chọn và ứng
                tuyển.
            </p>
        </header>

        @if ($recommendedJobs->isEmpty())
            {{-- Empty State Section --}}
            <section class="mt-8 bg-surface-container-low rounded-3xl p-16 flex flex-col items-center text-center">
                <div class="mb-8 p-6 bg-white rounded-full shadow-lg">
                    <span class="material-symbols-outlined text-7xl text-primary-fixed-dim"
                        style="font-variation-settings: 'FILL' 1;">search_off</span>
                </div>
                <h2 class="font-headline text-3xl mb-4 text-on-surface">Chưa tìm thấy công việc phù hợp</h2>
                <p class="text-on-surface-variant max-w-lg mb-10 leading-relaxed">
                    Đừng lo lắng! Có thể hồ sơ của bạn đang thiếu một vài thông tin quan trọng để hệ thống AI của chúng tôi
                    bắt đầu gợi ý chính xác hơn.
                </p>
                <a href="{{ route('user.profile.edit') }}"
                    class="px-10 py-4 bg-inverse-surface text-inverse-on-surface rounded-md font-bold hover:scale-105 transition-transform flex items-center gap-3">
                    <span class="material-symbols-outlined">edit_note</span>
                    Cập nhật hồ sơ ngay
                </a>
            </section>
        @else
            {{-- Nếu có ít nhất 1 job, hiển thị Featured Job đầu tiên (tùy chọn) --}}
            @php
                $featuredJob = $recommendedJobs->first();
            @endphp
            @if ($featuredJob)
                <section class="mb-16">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <div
                            class="lg:col-span-8 bg-surface-container-lowest p-10 rounded-xl editorial-shadow group cursor-pointer border-l-4 border-primary-container">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                                <div>
                                    <span
                                        class="inline-block px-3 py-1 bg-secondary-fixed text-on-secondary-fixed text-[10px] font-bold tracking-widest uppercase rounded-full mb-4">GỢI
                                        Ý HÀNG ĐẦU</span>
                                    <h2 class="text-2xl font-semibold mb-2 group-hover:text-primary transition-colors">
                                        {{ $featuredJob->title }}</h2>
                                    <div class="flex items-center gap-4 text-on-surface-variant text-sm">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-lg">location_on</span>
                                            {{ $featuredJob->work_location ?? ($featuredJob->location ?? 'Không rõ') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-lg">schedule</span>
                                            {{ $featuredJob->created_at ? $featuredJob->created_at->diffForHumans() : 'Mới đăng' }}
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 md:mt-0 px-4 py-2 bg-primary-container/10 text-primary-container font-bold rounded-lg">
                                    {{ $featuredJob->salary ?? 'Thỏa thuận' }}
                                </div>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed mb-8 max-w-2xl">
                                {{ Str::limit(strip_tags($featuredJob->description ?? ''), 200) }}
                            </p>
                            <a href="{{ route('jobs.show', $featuredJob->id) }}"
                                class="electric-gradient text-white px-8 py-3 rounded-md font-medium hover:opacity-90 transition-all inline-flex items-center gap-2 group-hover:gap-4 duration-300">
                                Xem chi tiết <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                        <div
                            class="lg:col-span-4 bg-inverse-surface text-inverse-on-surface p-8 rounded-xl flex flex-col justify-center items-center text-center">
                            <div
                                class="w-16 h-16 bg-primary-container/20 rounded-full flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-3xl text-primary-fixed">electric_bolt</span>
                            </div>
                            <h3 class="font-headline text-xl mb-4">Tăng tốc tìm việc</h3>
                            <p class="text-sm opacity-70 mb-8 leading-loose">Hoàn thiện hồ sơ cá nhân để nhận được những gợi
                                ý chính xác hơn 40% so với thông thường.</p>
                            <a href="{{ route('user.profile.edit') }}"
                                class="w-full py-3 bg-surface-container-lowest text-inverse-surface font-bold rounded-md hover:bg-primary-fixed transition-colors text-center">
                                Cập nhật ngay
                            </a>
                        </div>
                    </div>
                </section>
            @endif

            {{-- Job Grid (bỏ qua featured job đầu tiên nếu đã hiển thị) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($recommendedJobs as $index => $job)
                    @if ($index === 0 && $featuredJob)
                        @continue
                    @endif {{-- Bỏ qua job đầu tiên nếu đã dùng làm featured --}}
                    <div
                        class="bg-surface-container-lowest p-8 rounded-xl editorial-shadow hover:-translate-y-2 transition-transform duration-300 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-6">
                            <div
                                class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center overflow-hidden">
                                @if ($job->employer->company_logo ?? false)
                                    <img alt="Logo" class="w-full h-full object-cover"
                                        src="{{ $job->employer->company_logo }}">
                                @else
                                    <span
                                        class="text-primary font-bold text-lg">{{ strtoupper(substr($job->employer->company_name ?? 'C', 0, 2)) }}</span>
                                @endif
                            </div>
                            <div
                                class="px-3 py-1 bg-primary-container text-white text-[11px] font-bold rounded-full whitespace-nowrap">
                                {{ $job->salary ?? 'Thỏa thuận' }}
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ $job->title }}</h3>
                        <div class="flex items-center gap-2 text-on-surface-variant text-sm mb-4">
                            <span class="material-symbols-outlined text-base">location_on</span>
                            {{ $job->work_location ?? ($job->location ?? 'Không rõ') }}
                        </div>
                        <p class="text-sm text-on-surface-variant leading-relaxed mb-8 line-clamp-2">
                            {{ Str::limit(strip_tags($job->description ?? ''), 100) }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('jobs.show', $job->id) }}"
                                class="block w-full electric-gradient text-white py-3 rounded-md font-medium text-sm text-center hover:opacity-90 transition-opacity">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
@endsection
