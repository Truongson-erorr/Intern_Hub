<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'InternHub'))</title>

    {{-- Fonts & Styles --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Calistoga&family=Inter:wght@400;500;600;700&family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    {{-- Tailwind CDN (có thể thay bằng Vite trong production) --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary": "#1050d4",
                        "on-secondary": "#ffffff",
                        "background": "#f9f9f9",
                        "primary-container": "#0052ff",
                        "tertiary": "#464e64",
                        "surface-container-low": "#f3f3f3",
                        "tertiary-container": "#5e667d",
                        "error-container": "#ffdad6",
                        "surface": "#f9f9f9",
                        "surface-variant": "#e2e2e2",
                        "secondary-fixed": "#dbe1ff",
                        "on-tertiary-fixed-variant": "#3f465c",
                        "on-tertiary-fixed": "#131b2e",
                        "on-secondary-fixed-variant": "#003dab",
                        "on-primary-fixed": "#001452",
                        "inverse-on-surface": "#f0f1f1",
                        "tertiary-fixed-dim": "#bec6e0",
                        "secondary-container": "#396bee",
                        "primary-fixed": "#dde1ff",
                        "outline": "#737688",
                        "inverse-primary": "#b7c4ff",
                        "tertiary-fixed": "#dae2fd",
                        "surface-bright": "#f9f9f9",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#dfe3ff",
                        "surface-container-high": "#e8e8e8",
                        "on-surface": "#1a1c1c",
                        "inverse-surface": "#2f3131",
                        "on-tertiary": "#ffffff",
                        "primary": "#003ec7",
                        "primary-fixed-dim": "#b7c4ff",
                        "on-secondary-fixed": "#00174c",
                        "on-tertiary-container": "#dde4ff",
                        "surface-dim": "#dadada",
                        "surface-container": "#eeeeee",
                        "on-surface-variant": "#434656",
                        "error": "#ba1a1a",
                        "on-primary": "#ffffff",
                        "surface-container-highest": "#e2e2e2",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#b5c4ff",
                        "outline-variant": "#c3c5d9",
                        "on-error": "#ffffff",
                        "on-background": "#1a1c1c",
                        "surface-tint": "#004ced",
                        "on-primary-fixed-variant": "#0038b6",
                        "on-secondary-container": "#fefcff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Be Vietnam Pro", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"],
                        "display": ["Calistoga", "serif"]
                    }
                },
            },
        }
    </script>
    <style>
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

        body {
            font-family: 'Inter', sans-serif;
            background-color: #FAFAFA;
            color: #1A1C1C;
        }

        h1,
        h2,
        h3 {
            font-family: 'Calistoga', serif;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-background selection:bg-primary-fixed selection:text-on-primary-fixed">

    {{-- Top Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl shadow-[0_4px_24px_-2px_rgba(15,23,42,0.06)]">
        <div class="flex justify-between items-center max-w-[1440px] mx-auto px-8 py-4">
            <a href="{{ url('user/trangchu') }}" class="text-2xl font-['Calistoga'] text-blue-600">InternHub</a>
            {{-- Desktop Links --}}
            <div class="hidden md:flex items-center space-x-8">
                <a class="{{ request()->routeIs('user.timviec') ? 'text-blue-600 font-medium border-b-2 border-blue-600 pb-1' : 'text-slate-600 hover:text-blue-500 transition-colors' }} font-['Be_Vietnam_Pro'] leading-[1.7] tracking-tight"
                    href="{{ route('user.timviec') }}">Tìm Việc</a>
                <a class="text-slate-600 hover:text-blue-500 transition-colors font-['Be_Vietnam_Pro'] leading-[1.7] tracking-tight"
                    href="#">Trang Chủ</a>
                <a class="text-slate-600 hover:text-blue-500 transition-colors font-['Be_Vietnam_Pro'] leading-[1.7] tracking-tight"
                    href="#">Giới Thiệu</a>
                <a class="text-slate-600 hover:text-blue-500 transition-colors font-['Be_Vietnam_Pro'] leading-[1.7] tracking-tight"
                    href="#">Liên Hệ</a>
            </div>
            <div class="flex items-center space-x-6">
                @guest
                    <a href="{{ url('authen/login') }}"
                        class="text-slate-600 hover:text-blue-500 transition-all duration-300 font-medium active:opacity-80">Đăng
                        Nhập</a>
                    <a href="{{ url('authen/register') }}"
                        class="electric-gradient text-white px-6 py-2.5 rounded-md font-medium hover:scale-95 transition-transform active:opacity-80 shadow-lg shadow-blue-500/20">
                        Đăng Bài Tuyển Dụng
                    </a>
                @else
                    {{-- Menu người dùng đã đăng nhập (tùy chỉnh) --}}
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">

                        {{-- Button --}}
                        <button @click="open = !open"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg
        text-slate-600 hover:text-primary hover:bg-slate-100 transition-all">

                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <span class="material-symbols-outlined">account_circle</span>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="open" x-transition
                            class="absolute right-0 mt-3 w-64 rounded-xl overflow-hidden
        bg-white shadow-[0px_20px_50px_rgba(0,0,0,0.15)]
        border border-gray-100 z-50">

                            {{-- Header --}}
                            <div class="px-5 py-4 border-b bg-slate-50">
                                <p class="font-bold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            {{-- Menu --}}
                            <div class="py-2 text-sm">

                                {{-- Profile --}}
                                <a href="{{ route('user.profile.index') }}"
                                    class="flex items-center gap-3 px-5 py-3 hover:bg-slate-100 transition">
                                    <span class="material-symbols-outlined text-base">person</span>
                                    <span>Tài khoản của tôi</span>
                                </a>

                                {{-- Saved Jobs --}}
                                <a href="{{ route('user.saved.index') }}"
                                    class="flex items-center gap-3 px-5 py-3 hover:bg-slate-100 transition">
                                    <span class="material-symbols-outlined text-base">bookmark</span>
                                    <span>Việc làm đã lưu</span>
                                </a>

                                {{-- My Applications --}}
                                <a href="{{ route('user.my_applications') }}"
                                    class="flex items-center gap-3 px-5 py-3 hover:bg-slate-100 transition">
                                    <span class="material-symbols-outlined text-base">description</span>
                                    <span>Đơn ứng tuyển</span>
                                </a>

                                <a href="{{ route('user.recommend_job') }}"
                                    class="flex items-center justify-between gap-3 px-5 py-3 hover:bg-slate-100 transition">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-base">recommend</span>
                                        <span>Việc làm đề xuất</span>
                                    </div>

                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">
                                        AI
                                    </span>
                                </a>

                                {{-- Divider --}}
                                <div class="my-2 border-t"></div>

                                {{-- Logout --}}
                                <a href="{{ route('authen.logout') }}"
                                    class="flex items-center gap-3 px-5 py-3 text-red-500 hover:bg-red-50 transition">
                                    <span class="material-symbols-outlined text-base">logout</span>
                                    <span>Đăng xuất</span>
                                </a>

                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Main Content Area --}}
    <main class="pt-24 overflow-hidden">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-900 dark:bg-black w-full mt-32">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 max-w-[1440px] mx-auto px-12 py-20">
            <div class="col-span-1">
                <div class="text-xl font-['Calistoga'] text-white mb-4">InternHub</div>
                <p class="font-['Be_Vietnam_Pro'] text-slate-400 leading-[1.7] mb-6">
                    © {{ date('Y') }} InternHub. The Digital Curator for Vietnamese IT Talent.
                </p>
            </div>
            <div>
                <h5 class="font-['Calistoga'] text-white mb-6">Ứng viên</h5>
                <ul class="space-y-4 font-['Be_Vietnam_Pro'] text-slate-400 leading-[1.7]">
                    <li><a class="hover:text-white transition-colors" href="{{ route('user.timviec') }}">Find Jobs</a>
                    </li>
                    <li><a class="hover:text-white transition-colors" href="#">Privacy Policy</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-['Calistoga'] text-white mb-6">Nhà tuyển dụng</h5>
                <ul class="space-y-4 font-['Be_Vietnam_Pro'] text-slate-400 leading-[1.7]">
                    <li><a class="hover:text-white transition-colors" href="#">For Employers</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Developer API</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Contact Support</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-['Calistoga'] text-white mb-6">Công ty</h5>
                <ul class="space-y-4 font-['Be_Vietnam_Pro'] text-slate-400 leading-[1.7]">
                    <li><a class="hover:text-white transition-colors" href="#">About Us</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Careers</a></li>
                    <li><a class="hover:text-white transition-colors" href="#">Blog</a></li>
                </ul>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
<script src="//unpkg.com/alpinejs" defer></script>
