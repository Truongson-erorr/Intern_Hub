<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Hệ thống tuyển dụng - Module Nhà tuyển dụng">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <title>Employer Portal - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/employer-custom.css') }}" rel="stylesheet">
    
    @stack('css') </head>

<body>

    <div class="d-flex" id="wrapper">

        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-brand">
                <i class="fas fa-briefcase me-2"></i> InternHub
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Tổng quan
                </a>
                
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-file-alt"></i> Tin tuyển dụng
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-users"></i> Hồ sơ ứng viên <span class="badge bg-danger rounded-pill ms-2">3</span>
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-building"></i> Hồ sơ công ty
                </a>
                
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog"></i> Cài đặt
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white top-navbar px-4 py-3 border-bottom">
                <div class="d-flex align-items-center w-100 justify-content-between">
                    
                    <button class="btn btn-light text-primary" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" alt="hugenerd" width="40" height="40" class="rounded-circle me-2 border">
                            <span class="d-none d-sm-inline mx-1 fw-bold">Xin chào, HR Manager</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Đăng xuất</a></li>
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
    
    @stack('js') </body>

</html>