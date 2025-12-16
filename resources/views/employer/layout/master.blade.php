<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Hệ thống tuyển dụng - Module Nhà tuyển dụng">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employer Portal - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/employer-custom.css') }}" rel="stylesheet">

    @stack('css')
</head>

<body>

    <div class="d-flex" id="wrapper">

        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-brand">
                <i class="fas fa-briefcase me-2"></i> InternHub
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('employer.dashboard') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Tổng quan
                </a>

                <a href="{{ route('employer.jobs.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('employer.jobs.index') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> Tin tuyển dụng
                </a>

                <a href="{{ route('employer.candidates.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('employer.candidates.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Hồ sơ ứng viên

                    @if (isset($pendingCount) && $pendingCount > 0)
                        <span
                            class="badge bg-danger rounded-pill ms-2 animate__animated animate__pulse animate__infinite">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('employer.profile.index') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('employer.profile.index') ? 'active' : '' }}">
                    <i class="fas fa-building"></i> Hồ sơ công ty
                </a>

                <a href="#"
                    class="list-group-item list-group-item-action {{ request()->routeIs('') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Cài đặt
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white top-navbar px-4 py-3 border-bottom">
                <div class="d-flex align-items-center w-100 justify-content-between">

                    <button class="btn btn-light text-primary" id="sidebarToggle">
                        <i class="fas fa-times"></i>
                    </button>

                    <span class="d-none d-sm-flex align-items-center justify-content-center text-center gap-2">
                        <div class="lh-sm">
                            <div class="fw-bold">
                                {{ auth()->user()->employer->company_name ?? '' }}
                            </div>

                            <small class="text-muted d-block">
                                Tài khoản nhà tuyển dụng
                            </small>

                            @if (auth()->user()->employer->is_approved == 1)
                                <small class="badge bg-success mt-1">
                                    <i class="fas fa-check-circle me-1"></i>Tài Khoản Đã Xác Thực
                                </small>
                            @else
                                <small class="badge bg-warning text-dark mt-1">
                                    <i class="fas fa-clock me-1"></i> Tài Khoản Chờ Xác Thực
                                </small>
                            @endif
                        </div>
                    </span>

                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-sm-inline mx-1">
                                <span class="fw-bold">Xin chào, {{ auth()->user()->name }}</span><br>
                                <small class="text-muted">Chúc bạn một ngày làm việc hiệu quả</small>
                            </span>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li class="px-3 py-2">
                                <strong>{{ auth()->user()->name }}</strong><br>
                                <small class="text-muted">Nhà Tuyển Dụng</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('employer.account.index') }}">
                                    <i class="fas fa-user me-2"></i> Thông tin tài khoản
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2"></i> Cài đặt
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ url('authen/logout') }}">
                                    <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="container-fluid px-4 py-4">
                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/employer-custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>

</html>
