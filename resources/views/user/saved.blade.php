@extends('user.layout.app') {{-- hoặc 'user.layout.index' tùy cấu trúc của bạn --}}

@section('title', 'Công việc đã lưu')

@push('styles')
    <style>
        .brand-font {
            font-family: 'Calistoga', cursive;
        }

        .electric-gradient {
            background: linear-gradient(135deg, #0052FF 0%, #4D7CFF 100%);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* Hover pulse effect */
        .electric-pulse {
            transition: all 0.2s ease;
        }

        .electric-pulse:hover {
            box-shadow: 0 0 15px rgba(0, 82, 255, 0.5);
        }

        /* Line clamp utility (nếu Tailwind chưa có) */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush

@section('content')
    <main class="pt-32 pb-20 px-8 max-w-7xl mx-auto min-h-screen">
        {{-- Page Header --}}
        <header class="mb-16">
            <h1 class="text-5xl md:text-6xl text-on-surface mb-4 tracking-tight">Công việc đã lưu</h1>
            <p class="text-on-surface-variant text-lg max-w-2xl leading-relaxed">
                Danh sách các công việc bạn đã lưu để tham khảo hoặc ứng tuyển sau. Quản lý sự nghiệp của bạn một cách thông
                minh.
            </p>
        </header>

        @if ($savedJobs->isEmpty())
            {{-- Empty State --}}
            <section class="flex flex-col items-center justify-center py-32 text-center">
                <div class="w-24 h-24 bg-surface-container-low rounded-full flex items-center justify-center mb-8">
                    <span class="material-symbols-outlined text-5xl text-outline">bookmark</span>
                </div>
                <h3 class="text-2xl font-semibold mb-2">Bạn chưa lưu công việc nào.</h3>
                <p class="text-on-surface-variant mb-10 max-w-sm">Hãy khám phá hàng ngàn cơ hội việc làm IT hấp dẫn đang chờ
                    đón bạn tại TechCurator.</p>
                <a href="{{ route('user.timviec') }}"
                    class="electric-gradient text-white px-10 py-4 rounded-lg font-bold text-lg electric-pulse transition-all">
                    Tìm việc ngay
                </a>
            </section>
        @else
            {{-- Bento Grid Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Left: Job Cards --}}
                <div class="lg:col-span-8 space-y-10">
                    @foreach ($savedJobs as $saved)
                        @php $job = $saved->job; @endphp
                        <article
                            class="group relative bg-surface-container-lowest rounded-xl p-8 shadow-[0_4px_24px_-2px_rgba(15,23,42,0.06)] transition-all duration-300 hover:shadow-[0_8px_32px_-4px_rgba(0,82,255,0.12)] border border-transparent hover:border-primary/10">
                            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                                <div class="flex-1">
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

                                    {{-- Tiêu đề --}}
                                    <h2 class="text-2xl font-semibold mb-2 group-hover:text-primary transition-colors">
                                        <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                                    </h2>

                                    {{-- Mô tả ngắn --}}
                                    <p class="text-on-surface-variant mb-6 line-clamp-2 text-base italic">
                                        {{ Str::limit(strip_tags($job->description ?? ''), 150, '...') }}
                                    </p>

                                    {{-- Thông tin chi tiết grid --}}
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-6 text-sm">
                                        <div class="flex items-center gap-2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-primary">location_on</span>
                                            <span>{{ $job->work_location ?? ($job->location ?? 'Chưa cập nhật') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-primary">payments</span>
                                            <span
                                                class="font-medium text-on-surface">{{ $job->salary ?? ($job->income ?? 'Thỏa thuận') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-primary">work_history</span>
                                            <span>{{ $job->experience ? $job->experience . '+ năm KN' : 'Không yêu cầu' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-primary">calendar_today</span>
                                            <span>Hạn:
                                                {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') : 'Không có' }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex flex-col items-end gap-4 w-full md:w-auto">
                                    <form action="{{ route('user.saved.destroy', $job->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center gap-2 text-error hover:bg-error/5 px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                                            <span class="material-symbols-outlined text-xl">bookmark_remove</span>
                                            Bỏ lưu
                                        </button>
                                    </form>
                                    <a href="{{ route('jobs.show', $job->id) }}"
                                        class="w-full md:w-auto electric-gradient text-white px-8 py-3 rounded-lg font-semibold electric-pulse transition-all text-center">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Right Sidebar: Thống kê --}}
                <aside class="lg:col-span-4 space-y-8">
                    <div class="bg-surface-container-low rounded-xl p-8 sticky top-28">
                        <h3 class="text-xl font-semibold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">analytics</span>
                            Thống kê của bạn
                        </h3>
                        <div class="space-y-6">
                            <div class="p-4 bg-surface-container-lowest rounded-lg">
                                <div class="text-on-surface-variant text-sm mb-1">Công việc đã lưu</div>
                                <div class="text-3xl font-bold text-primary">{{ $savedJobs->count() }}</div>
                            </div>
                            <div class="p-4 bg-surface-container-lowest rounded-lg">
                                <div class="text-on-surface-variant text-sm mb-1">Đã ứng tuyển</div>
                                <div class="text-3xl font-bold text-tertiary">{{ $appliedCount ?? 0 }}</div>
                            </div>
                            <div class="p-4 bg-surface-container-lowest rounded-lg">
                                <div class="text-on-surface-variant text-sm mb-1">Hết hạn sắp tới</div>
                                <div class="text-3xl font-bold text-error">{{ $expiringSoonCount ?? 0 }}</div>
                            </div>
                        </div>

                        {{-- Khám phá thêm --}}
                        <div class="mt-10 p-6 electric-gradient rounded-xl text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <h4 class="text-lg font-bold mb-2">Khám phá thêm?</h4>
                                <p class="text-sm opacity-90 mb-4">Dựa trên các việc đã lưu, chúng tôi có gợi ý mới cho bạn.
                                </p>
                                <a href="{{ route('user.timviec') }}"
                                    class="bg-white text-primary px-4 py-2 rounded font-bold text-sm inline-block">Xem gợi
                                    ý</a>
                            </div>
                            <div
                                class="absolute -right-4 -bottom-4 opacity-10 transform group-hover:scale-110 transition-transform duration-500">
                                <span class="material-symbols-outlined text-[120px]">auto_awesome</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        @endif
    </main>
@endsection
