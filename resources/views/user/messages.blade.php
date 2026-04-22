@extends('user.layout.app')

@section('title', 'Tin nhắn từ nhà tuyển dụng')

@push('styles')
    <style>
        /* Style bổ sung cho template mới, đồng bộ với layout */
        .font-calistoga {
            font-family: 'Calistoga', cursive;
        }

        .vietnamese-lead {
            font-family: 'Be Vietnam Pro', 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .electric-gradient {
            background: linear-gradient(135deg, #0052FF 0%, #4D7CFF 100%);
        }

        .editorial-shadow {
            box-shadow: 0 4px 24px -2px rgba(15, 23, 42, 0.06);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@section('content')
    <main class="flex-grow max-w-[1440px] mx-auto w-full px-8 py-16">
        {{-- Header Section --}}
        <header class="mb-10 text-center md:text-left">
            <!-- Title -->
            <h1 class="text-5xl md:text-6xl text-on-surface mb-4 tracking-tight">
                Tin nhắn từ nhà tuyển dụng
            </h1>

            <!-- Subtitle -->
            <p class="text-on-surface-variant text-lg max-w-2xl leading-relaxed">
                Nơi các doanh nghiệp gửi lời mời thực tập và làm việc trực tiếp đến bạn.
            </p>

            <!-- Description -->
            <p class="text-on-surface-variant text-md max-w-2xl leading-relaxed mt-4">
                Khi bạn xác nhận lời mời, nhà tuyển dụng có thể liên hệ qua email để trao đổi chi tiết.
                Hãy kiểm tra thường xuyên để không bỏ lỡ cơ hội phù hợp.
            </p>
        </header>

        {{-- Messages Grid/List --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Left Side: Filters/Stats (Bento Style) --}}
            <aside class="lg:col-span-4 space-y-6">
                <div
                    class="bg-surface-container-lowest p-8 rounded-[2rem] editorial-shadow border border-outline-variant/10">
                    <h3 class="font-headline font-bold text-lg mb-6">Trạng thái hộp thư</h3>
                    <div class="space-y-4">
                        @php
                            $newCount = $messages->where('status', 'pending')->count();
                            $totalCount = $messages->count();
                        @endphp
                        <div class="flex items-center justify-between p-4 bg-primary-fixed rounded-2xl">
                            <span class="font-medium text-on-primary-fixed">Lời mời mới</span>
                            <span
                                class="bg-primary text-on-primary px-3 py-1 rounded-full text-xs font-bold">{{ $newCount }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-2xl">
                            <span class="font-medium text-on-surface-variant">Tổng tin nhắn</span>
                            <span class="text-on-surface-variant font-bold">{{ $totalCount }}</span>
                        </div>
                    </div>
                </div>
                <div
                    class="relative overflow-hidden bg-inverse-surface p-8 rounded-[2rem] text-inverse-on-surface editorial-shadow h-64 flex flex-col justify-end">
                    <img alt="Team collaborating" class="absolute inset-0 w-full h-full object-cover opacity-30"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGxl4Q1vXlj0UJoB4bsTk1fEhYPMRtuo8-GhpZa0HLBsISfW_3HWmyWvoHqI_9qNEcWb7_VL-2NQ4-HhWEMfCaemBjiO7KK6Jd5MtxIXRH25inpfHhRW6p-SRQeUbRg3YnSn9SQFdrhYqrmToG1vHAqJ8zEAAgIr8unyFIkpOUK32NB4TQVLkQbfcDhe-wIvE8Az8nXiqrHaLN0vzFrdwV2AVxrbHrrrofz6MYgathbkA-mU3kMF4dZaUh433lYuwrnc9sT2fQbyA" />
                    <div class="relative z-10">
                        <p class="text-primary-fixed-dim font-bold uppercase tracking-widest text-[10px] mb-2">Mẹo nghề
                            nghiệp</p>
                        <h4 class="font-headline font-bold text-xl leading-tight">Hoàn thiện hồ sơ để nhận thêm lời mời.
                        </h4>
                    </div>
                </div>
            </aside>

            {{-- Main Content: Message Cards --}}
            <section class="lg:col-span-8 space-y-8">
                @forelse($messages as $msg)
                    @php
                        $sender = $msg->sender;
                        $employer = $sender->employer ?? null;
                        $companyName = $employer->company_name ?? 'Nhà tuyển dụng';
                        $companyLogo = $employer->company_logo ?? null;
                    @endphp
                    <div
                        class="bg-surface-container-lowest p-8 md:p-10 rounded-[2rem] editorial-shadow border border-outline-variant/10 hover:translate-y-[-4px] transition-transform duration-300">
                        <div class="flex flex-col md:flex-row md:items-start gap-6">
                            {{-- Logo --}}
                            <div
                                class="w-16 h-16 rounded-2xl bg-surface-container-high flex items-center justify-center shrink-0">
                                @if ($companyLogo)
                                    <img class="w-10 h-10 object-contain" src="{{ asset('storage/' . $companyLogo) }}"
                                        alt="{{ $companyName }}">
                                @else
                                    <span class="material-symbols-outlined text-primary text-3xl"
                                        style="font-variation-settings: 'FILL' 1;">business_center</span>
                                @endif
                            </div>

                            <div class="flex-1">
                                {{-- Header --}}
                                <div class="flex flex-wrap items-center justify-between gap-4 mb-2">
                                    <h2 class="font-headline font-bold text-2xl text-on-surface">{{ $companyName }}</h2>
                                    <span
                                        class="bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase">LỜI
                                        MỜI</span>
                                </div>
                                <p class="text-on-surface-variant text-sm mb-6">Gửi lúc:
                                    {{ $msg->created_at->format('H:i d/m/Y') }}</p>

                                {{-- Nội dung --}}
                                <div
                                    class="bg-surface-container-low p-6 rounded-2xl mb-8 leading-relaxed text-on-surface-variant">
                                    {{ $msg->message_text }}
                                </div>

                                {{-- Actions --}}
                                <div class="flex flex-wrap items-center justify-between gap-6">
                                    @if ($msg->status === 'pending')
                                        <form action="{{ route('user.messages.accept', $msg->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="electric-gradient text-white px-8 py-4 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                                                Xác nhận lời mời
                                            </button>
                                        </form>
                                    @elseif($msg->status === 'accepted')
                                        <div
                                            class="flex items-center gap-2 text-emerald-600 font-bold bg-emerald-50 px-6 py-3 rounded-xl border border-emerald-100">
                                            <span class="material-symbols-outlined text-sm">check_circle</span>
                                            <span class="text-sm">Đã xác nhận</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div
                        class="bg-surface-container-lowest p-12 rounded-[2rem] text-center border border-dashed border-outline-variant/30">
                        <div
                            class="w-24 h-24 bg-surface-container-low rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="material-symbols-outlined text-outline text-5xl">mail_lock</span>
                        </div>
                        <h3 class="text-2xl font-calistoga text-on-surface mb-2">Chưa có tin nhắn nào</h3>
                        <p class="text-on-surface-variant max-w-sm mx-auto">
                            Chưa có nhà tuyển dụng nào liên hệ với bạn. Hãy cập nhật hồ sơ để tăng khả năng nhận được lời
                            mời!
                        </p>
                        <a href="{{ route('user.profile.edit') }}"
                            class="inline-block mt-8 bg-on-background text-white px-10 py-4 rounded-full font-bold hover:scale-105 transition-transform">
                            Cập nhật hồ sơ ngay
                        </a>
                    </div>
                @endforelse
            </section>
        </div>
    </main>
@endsection
