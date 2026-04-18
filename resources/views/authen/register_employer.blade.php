@extends('user.layout.app') {{-- Hoặc 'layouts.app' tùy cấu trúc --}}

@section('title', 'Đăng ký Nhà tuyển dụng')

@push('styles')
    <style>
        /* Các style đặc thù bổ sung cho trang đăng ký */
        .dot-pattern {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .soft-lift {
            box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.05);
        }

        /* Form control custom để khớp với thiết kế */
        input,
        textarea {
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-bottom-color: #0052FF !important;
        }

        .error-message {
            font-size: 0.75rem;
            margin-top: 0.25rem;
            color: #ba1a1a;
        }
    </style>
@endpush

@section('content')
    <main class="min-h-screen relative overflow-hidden">
        {{-- Background Elements --}}
        <div class="absolute top-0 right-0 w-1/3 h-full dot-pattern opacity-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary-container/5 blur-[120px] rounded-full"></div>

        <div class="max-w-4xl mx-auto px-6 py-12 relative">
            {{-- Hero Header --}}
            <div class="mb-12 text-center md:text-left">
                <h1 class="font-headline text-4xl md:text-5xl lg:text-6xl leading-tight mb-4 text-on-surface">
                    ĐĂNG KÝ ĐỐI TÁC<br class="hidden md:block"> DOANH NGHIỆP
                </h1>
                <p class="text-on-surface-variant text-lg max-w-2xl font-body leading-relaxed">
                    Tạo hồ sơ doanh nghiệp và tìm kiếm nhân tài ngay hôm nay. Bắt đầu hành trình xây dựng đội ngũ công nghệ
                    xuất sắc của bạn.
                </p>
            </div>

            {{-- Hiển thị lỗi validation nếu có --}}
            @if ($errors->any())
                <div class="mb-8 p-4 bg-error-container text-on-error-container rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Container --}}
            <form action="{{ route('employer.register.submit') }}" method="POST" class="space-y-8">
                @csrf

                {{-- Section 1: Thông tin tài khoản --}}
                <div class="bg-surface-container-low p-1 rounded-xl">
                    <div class="bg-surface-container-lowest p-6 md:p-8 rounded-lg soft-lift">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="material-symbols-outlined text-primary-container text-4xl">person_add</span>
                            <h2 class="font-headline text-2xl md:text-3xl text-on-surface">Thông tin tài khoản</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            {{-- Họ và tên --}}
                            <div class="space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Họ và tên người liên
                                    hệ <span class="text-error">*</span></label>
                                <input name="name" value="{{ old('name') }}" required
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg @error('name') border-error @enderror"
                                    placeholder="Nguyễn Văn A" type="text" />
                                @error('name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- Email --}}
                            <div class="space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Email đăng nhập
                                    <span class="text-error">*</span></label>
                                <input name="email" value="{{ old('email') }}" required
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg @error('email') border-error @enderror"
                                    placeholder="example@company.com" type="email" />
                                @error('email')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- Mật khẩu --}}
                            <div class="space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Mật khẩu <span
                                        class="text-error">*</span></label>
                                <input name="password" required
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg @error('password') border-error @enderror"
                                    placeholder="••••••••" type="password" />
                                @error('password')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- Xác nhận mật khẩu --}}
                            <div class="space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Xác nhận mật khẩu
                                    <span class="text-error">*</span></label>
                                <input name="password_confirmation" required
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg"
                                    placeholder="••••••••" type="password" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Thông tin doanh nghiệp --}}
                <div class="bg-surface-container-low p-1 rounded-xl">
                    <div class="bg-surface-container-lowest p-6 md:p-8 rounded-lg soft-lift">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="material-symbols-outlined text-primary-container text-4xl">business</span>
                            <h2 class="font-headline text-2xl md:text-3xl text-on-surface">Thông tin doanh nghiệp</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            {{-- Tên công ty --}}
                            <div class="md:col-span-2 space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Tên công ty <span
                                        class="text-error">*</span></label>
                                <input name="company_name" value="{{ old('company_name') }}" required
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg @error('company_name') border-error @enderror"
                                    placeholder="Công ty TNHH Công Nghệ TechHire" type="text" />
                                @error('company_name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- Số điện thoại --}}
                            <div class="space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Số điện thoại liên
                                    hệ</label>
                                <input name="company_phone" value="{{ old('company_phone') }}"
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg"
                                    placeholder="+84 000 000 000" type="tel" />
                            </div>
                            {{-- Website --}}
                            <div class="space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Website doanh
                                    nghiệp</label>
                                <input name="company_website" value="{{ old('company_website') }}"
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg"
                                    placeholder="https://www.company.com" type="url" />
                            </div>
                            {{-- Địa chỉ --}}
                            <div class="md:col-span-2 space-y-1">
                                <label class="font-label text-xs uppercase tracking-wider text-outline">Địa chỉ trụ
                                    sở</label>
                                <textarea name="company_address" rows="2"
                                    class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary-container focus:ring-0 transition-all px-4 py-3 font-body text-base rounded-t-lg resize-none"
                                    placeholder="Tòa nhà Tech, Đường Số 1, Quận 1, TP. HCM">{{ old('company_address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="flex flex-col items-center gap-4 py-6">
                    <button type="submit"
                        class="electric-gradient text-on-primary w-full md:w-auto md:px-16 py-4 rounded-md font-medium text-lg scale-95 active:scale-90 active:opacity-90 transition-all shadow-lg hover:shadow-primary-container/20">
                        Hoàn tất đăng ký
                    </button>
                    <p class="font-body text-base text-on-surface-variant">
                        Bạn đã có tài khoản?
                        <a href="{{ url('authen/login') }}"
                            class="text-primary-container font-semibold hover:underline transition-all">Đăng nhập ngay</a>
                    </p>
                </div>
            </form>

            {{-- Decorative Cards (Asymmetric Layout Example) --}}
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-inverse-surface p-6 rounded-xl flex flex-col justify-between h-48 group overflow-hidden relative">
                    <div class="relative z-10">
                        <span class="material-symbols-outlined text-primary-fixed text-4xl mb-4">verified_user</span>
                        <p class="text-inverse-on-surface font-headline text-lg leading-tight">Môi trường bảo mật & tin cậy
                        </p>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <span class="material-symbols-outlined text-[120px]">security</span>
                    </div>
                </div>
                <div
                    class="bg-surface-container-high p-6 rounded-xl flex flex-col justify-between h-48 group overflow-hidden relative">
                    <div class="relative z-10">
                        <span class="material-symbols-outlined text-primary-container text-4xl mb-4">groups</span>
                        <p class="text-on-surface font-headline text-lg leading-tight">Tiếp cận 1M+ ứng viên tài năng</p>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <span class="material-symbols-outlined text-[120px]">rocket_launch</span>
                    </div>
                </div>
                <div
                    class="bg-primary-fixed p-6 rounded-xl flex flex-col justify-between h-48 group overflow-hidden relative">
                    <div class="relative z-10">
                        <span class="material-symbols-outlined text-on-primary-fixed text-4xl mb-4">trending_up</span>
                        <p class="text-on-primary-fixed font-headline text-lg leading-tight">Phát triển quy mô doanh nghiệp
                        </p>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <span class="material-symbols-outlined text-[120px]">insights</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
