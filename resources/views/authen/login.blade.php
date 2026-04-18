@extends('user.layout.app')

@section('title', 'Trang đăng nhập')

@section('content')
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        {{-- Card width tối ưu cho login là 400px --}}
        <div class="w-full max-w-[400px] animate-in fade-in slide-in-from-bottom-5 duration-700">

            {{-- Login Card: Padding điều chỉnh về p-8 cân đối --}}
            <div class="bg-surface-container-lowest ghost-border ambient-shadow rounded-xl overflow-hidden p-8">
                <header class="mb-8">
                    <h1 class="font-headline text-2xl text-primary-container leading-tight mb-1.5">Đăng nhập</h1>
                    <p class="text-on-surface-variant text-sm leading-relaxed opacity-80">Chào mừng bạn quy trở lại với InternHub.</p>
                </header>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="flex items-start gap-3 p-3.5 mb-6 bg-error-container text-on-error-container rounded-lg text-[13px] leading-snug">
                        <span class="material-symbols-outlined text-[18px]">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="flex items-start gap-3 p-3.5 mb-6 bg-secondary-fixed text-on-secondary-fixed rounded-lg text-[13px] leading-snug">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ url('authen/login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        {{-- Label tăng lên 12px (0.75rem) để tăng độ nhận diện --}}
                        <label class="block text-[0.75rem] font-bold tracking-wider text-on-surface-variant/80 uppercase"
                            for="email">Email</label>
                        <div class="relative">
                            <input
                                class="w-full px-0 py-2.5 bg-transparent border-t-0 border-x-0 border-b border-outline-variant focus:ring-0 focus:border-primary-container transition-all placeholder:text-outline/40 text-[14px]"
                                id="email" name="email" type="email" placeholder="name@company.com"
                                value="{{ old('email') }}" required />
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center">
                            <label class="block text-[0.75rem] font-bold tracking-wider text-on-surface-variant/80 uppercase"
                                for="password">Mật khẩu</label>
                            <a class="text-[0.7rem] font-bold text-primary-container hover:underline tracking-tight uppercase"
                                href="{{ url('password/reset') }}">Quên mật khẩu?</a>
                        </div>
                        <div class="relative">
                            <input
                                class="w-full px-0 py-2.5 bg-transparent border-t-0 border-x-0 border-b border-outline-variant focus:ring-0 focus:border-primary-container transition-all placeholder:text-outline/40 text-[14px]"
                                id="password" name="password" type="password" placeholder="••••••••" required />
                        </div>
                    </div>

                    {{-- Submit: py-3.5 để button không quá dày --}}
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full electric-gradient text-white font-bold py-3.5 rounded-lg shadow-md hover:brightness-110 active:scale-[0.98] transition-all duration-300 text-sm uppercase tracking-wide">
                            Đăng nhập
                        </button>
                    </div>
                </form>

                {{-- Divider: Giảm margin để card gọn hơn --}}
                <div class="relative my-6 flex items-center">
                    <div class="flex-grow h-[1px] bg-surface-container-high"></div>
                    <span class="px-4 text-[11px] text-outline/50 font-bold uppercase tracking-widest">hoặc</span>
                    <div class="flex-grow h-[1px] bg-surface-container-high"></div>
                </div>

                {{-- Google Login --}}
                <a href="{{ url('/auth/google/redirect') }}"
                    class="w-full flex items-center justify-center gap-3 px-6 py-3 bg-surface-container-lowest ghost-border rounded-lg hover:bg-surface-container-low transition-colors active:scale-[0.98] duration-200">
                    <img alt="Google" class="w-4 h-4"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIMj-dm6zwJztLzV-lkWGKMPrnqTRumkcxa0idHZGO-V0d-Sdh4L9fZoihLLkuOU6hrR8A6iNUvF6yLFy27IeMVUyFRQ17l2Mb8j9gRrMNLbOir3bKWszFUs16fNFO8BlU8cW5591CFm4E-dqOgxmxd516BjWmV5rfJaurPcYMxQNlz_OoEIOQD6UJUbCanTucpGIu7uYsdHwxOBSwv9dswv0zgIPNAPy31Wa8ouxAL291dzdIy1OHwmKCQV7fR-3PN01CVCVoMXU" />
                    <span class="text-[13px] font-bold text-on-surface opacity-90">Tiếp tục với Google</span>
                </a>

                {{-- Footer Links: Tối ưu khoảng cách --}}
                <div class="mt-8 pt-5 border-t border-surface-container-high flex flex-col items-center gap-3">
                    <div class="flex items-center gap-3 text-[0.7rem] font-bold tracking-tight">
                        <a class="text-primary-container hover:opacity-80 transition-opacity uppercase"
                            href="{{ url('authen/register') }}">Đăng ký Sinh viên</a>
                        <span class="text-outline-variant/30">|</span>
                        <a class="text-primary-container hover:opacity-80 transition-opacity uppercase"
                            href="{{ route('employer.register') }}">Đăng ký Nhà tuyển dụng</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection