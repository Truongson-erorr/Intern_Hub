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
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-secondary-container/10 blur-[120px]"></div>
        <div class="absolute inset-0 bg-dot-pattern opacity-30"></div>
    </div>

    <main class="pb-24 px-6">
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
                            <div class="w-32 h-32 md:w-40 md:h-40 rounded-3xl border-4 border-white shadow-xl overflow-hidden bg-white">
                                <img alt="Avatar" class="w-full h-full object-cover"
                                     src="{{ $user->avatar ? asset($user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0052FF&color=fff&size=150' }}">
                            </div>
                            <div class="absolute -bottom-1 -right-1 bg-white p-1 rounded-xl shadow-lg">
                                <div class="flex items-center px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold tracking-widest uppercase border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                    Hoạt động
                                </div>
                            </div>
                        </div>
                        <div class="pb-2">
                            <h1 class="font-calistoga text-4xl md:text-5xl text-slate-900 mb-2">{{ $user->name }}</h1>
                            <p class="text-slate-500 font-medium text-lg">{{ $user->industry ?? 'Chưa cập nhật ngành nghề' }}</p>
                        </div>
                    </div>
                    <div class="flex justify-center md:justify-end pb-2">
                        <a href="{{ route('user.profile.edit') }}" class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-semibold shadow-sm hover:shadow-md hover:bg-slate-50 transition-all active:scale-95">
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
                                <h2 class="font-calistoga text-2xl text-slate-900">Thông Tin Liên Hệ</h2>
                                <div class="w-12 h-1 electric-gradient rounded-full mt-2"></div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-8">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">Địa chỉ Email</p>
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-primary">mail</span>
                                        <p class="text-slate-800 font-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">Số điện thoại</p>
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-primary">call</span>
                                        <p class="text-slate-800 font-medium">{{ $user->phone ?? 'Chưa cập nhật' }}</p>
                                    </div>
                                </div>
                                <div class="md:col-span-2 space-y-1">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">Địa chỉ hiện tại</p>
                                    <div class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-primary mt-0.5">location_on</span>
                                        <p class="text-slate-800 font-medium leading-relaxed">{{ $user->address ?? 'Chưa cập nhật địa chỉ' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tài liệu & Hồ sơ --}}
                        <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-slate-100">
                            <div class="mb-10">
                                <h2 class="font-calistoga text-2xl text-slate-900">Hồ Sơ Ứng Tuyển</h2>
                                <div class="w-12 h-1 electric-gradient rounded-full mt-2"></div>
                            </div>
                            <div class="flex flex-col md:flex-row items-center gap-6 p-6 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="w-14 h-14 rounded-xl bg-primary-fixed/30 flex items-center justify-center text-primary-container">
                                    <span class="material-symbols-outlined text-3xl">description</span>
                                </div>
                                <div class="flex-1 text-center md:text-left">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 mb-1">Resume / CV</p>
                                    <h4 class="text-slate-800 font-semibold text-lg">
                                        {{ $user->resume ? basename($user->resume) : 'Chưa tải lên CV' }}
                                    </h4>
                                </div>
                                @if($user->resume)
                                <a href="{{ asset($user->resume) }}" target="_blank" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-primary font-bold shadow-sm hover:shadow-md transition-all">
                                    Xem chi tiết
                                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                                </a>
                                @else
                                <span class="text-slate-400 text-sm italic">Chưa có file</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Cột phụ --}}
                    <div class="space-y-8">

                        {{-- Thống kê --}}
                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
                            <h4 class="font-calistoga text-lg text-slate-900 mb-6">Thống kê hồ sơ</h4>
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </div>
                                        <span class="text-slate-500 font-medium text-sm">Lượt xem</span>
                                    </div>
                                    <span class="font-bold text-slate-800">{{ $profileViews ?? 0 }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[18px]">work</span>
                                        </div>
                                        <span class="text-slate-500 font-medium text-sm">Đã ứng tuyển</span>
                                    </div>
                                    <span class="font-bold text-slate-800">{{ $appliedCount ?? 0 }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[18px]">assignment_turned_in</span>
                                        </div>
                                        <span class="text-slate-500 font-medium text-sm">Phỏng vấn</span>
                                    </div>
                                    <span class="font-bold text-slate-800">{{ $interviewCount ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mobile Bottom Navigation (tùy chọn, có thể ẩn nếu layout đã có) --}}
                {{-- 
                <nav class="md:hidden fixed bottom-0 left-0 w-full flex justify-around items-center pb-safe pt-2 px-4 bg-white/90 backdrop-blur-md shadow-[0_-8px_30px_rgb(0,0,0,0.04)] z-50 border-t border-slate-100">
                    <a class="flex flex-col items-center justify-center text-slate-400 px-4 py-1.5 transition-all" href="{{ url('/') }}">
                        <span class="material-symbols-outlined">home</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest mt-1">Home</span>
                    </a>
                    <a class="flex flex-col items-center justify-center text-slate-400 px-4 py-1.5 transition-all" href="{{ route('user.timviec') }}">
                        <span class="material-symbols-outlined">work</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest mt-1">Jobs</span>
                    </a>
                    <a class="flex flex-col items-center justify-center text-slate-400 px-4 py-1.5 transition-all" href="#">
                        <span class="material-symbols-outlined">assignment_turned_in</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest mt-1">Applied</span>
                    </a>
                    <a class="flex flex-col items-center justify-center text-primary px-4 py-1.5 transition-all" href="{{ route('user.profile.show') }}">
                        <span class="material-symbols-outlined filled">person</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest mt-1 border-b-2 border-primary">Profile</span>
                    </a>
                </nav>
                --}}
            @else
                {{-- Chưa đăng nhập --}}
                <div class="bg-white rounded-[2rem] p-12 text-center shadow-sm border border-slate-100 max-w-md mx-auto">
                    <div class="w-20 h-20 rounded-full bg-primary-fixed/30 flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-4xl text-primary">person_off</span>
                    </div>
                    <h4 class="text-2xl font-calistoga text-slate-900 mb-3">👋 Chào bạn</h4>
                    <p class="text-slate-500 mb-8">Vui lòng đăng nhập để xem thông tin cá nhân.</p>
                    <a href="{{ route('login') }}" class="electric-gradient text-white font-bold py-4 px-8 rounded-2xl inline-block shadow-lg hover:brightness-110 transition-all">
                        Đăng nhập ngay
                    </a>
                </div>
            @endauth
        </div>
    </main>
</div>
@endsection