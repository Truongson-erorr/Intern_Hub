@extends('user.layout.app')

@section('title', 'Trang đăng ký')

@section('content')
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        {{-- Card width 400px đồng bộ với Login --}}
        <div class="w-full max-w-[400px] animate-in fade-in slide-in-from-bottom-5 duration-700">

            {{-- Register Card --}}
            <div class="bg-surface-container-lowest ghost-border ambient-shadow rounded-xl overflow-hidden p-8">
                <header class="mb-8">
                    <h1 class="font-headline text-2xl text-primary-container leading-tight mb-1.5">Đăng ký</h1>
                    <p class="text-on-surface-variant text-sm leading-relaxed opacity-80">Trở thành một phần của cộng đồng công nghệ.</p>
                </header>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="flex items-start gap-3 p-3.5 mb-6 bg-error-container text-on-error-container rounded-lg text-[13px] leading-snug">
                        <span class="material-symbols-outlined text-[18px]">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Register Form --}}
                <form method="POST" action="{{ url('authen/register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div class="space-y-1.5">
                        <label class="block text-[0.75rem] font-bold tracking-wider text-on-surface-variant/80 uppercase"
                            for="name">Họ và tên</label>
                        <div class="relative">
                            <input
                                class="w-full px-0 py-2.5 bg-transparent border-t-0 border-x-0 border-b border-outline-variant focus:ring-0 focus:border-primary-container transition-all placeholder:text-outline/40 text-[14px]"
                                id="name" name="name" type="text" placeholder="Nguyễn Văn A"
                                value="{{ old('name') }}" required />
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1.5">
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
                        <label class="block text-[0.75rem] font-bold tracking-wider text-on-surface-variant/80 uppercase"
                            for="password">Mật khẩu</label>
                        <div class="relative">
                            <input
                                class="w-full px-0 py-2.5 bg-transparent border-t-0 border-x-0 border-b border-outline-variant focus:ring-0 focus:border-primary-container transition-all placeholder:text-outline/40 text-[14px]"
                                id="password" name="password" type="password" placeholder="••••••••" required />
                        </div>
                    </div>

                    {{-- Password Confirmation --}}
                    <div class="space-y-1.5">
                        <label class="block text-[0.75rem] font-bold tracking-wider text-on-surface-variant/80 uppercase"
                            for="password_confirmation">Xác nhận mật khẩu</label>
                        <div class="relative">
                            <input
                                class="w-full px-0 py-2.5 bg-transparent border-t-0 border-x-0 border-b border-outline-variant focus:ring-0 focus:border-primary-container transition-all placeholder:text-outline/40 text-[14px]"
                                id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required />
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full electric-gradient text-white font-bold py-3.5 rounded-lg shadow-md hover:brightness-110 active:scale-[0.98] transition-all duration-300 text-sm uppercase tracking-wide">
                            Tạo tài khoản
                        </button>
                    </div>
                </form>

                {{-- Divider --}}
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
                    <span class="text-[13px] font-bold text-on-surface opacity-90">Đăng ký bằng Google</span>
                </a>

                {{-- Footer Link --}}
                <div class="mt-8 pt-5 border-t border-surface-container-high text-center">
                    <p class="text-[0.75rem] font-medium text-on-surface-variant">
                        Bạn đã có tài khoản? 
                        <a class="font-bold text-primary-container hover:underline uppercase ml-1"
                            href="{{ url('authen/login') }}">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection