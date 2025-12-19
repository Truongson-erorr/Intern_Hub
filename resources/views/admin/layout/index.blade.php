<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #7209b7;
            --sidebar-bg: #ffffff;
            --sidebar-hover: #f0f7ff;
            --navbar-bg: #ffffff;
            --content-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-light: #64748b;
            --text-dark: #1e293b;
            --text-muted: #94a3b8;
            --border-color: #e2e8f0;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: var(--content-bg);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Sidebar Styles - White Theme */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: var(--text-dark);
            transition: var(--transition);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: var(--shadow);
            border-right: 1px solid var(--border-color);
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--sidebar-bg);
        }

        .sidebar-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .sidebar-header i {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-light);
            text-decoration: none;
            padding: 14px 20px;
            margin: 4px 12px;
            border-radius: var(--radius);
            transition: var(--transition);
            font-weight: 500;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: var(--sidebar-hover);
            color: var(--primary);
            transform: translateX(4px);
        }

        .sidebar-menu a.logout {
            color: #ef4444;
        }

        .sidebar-menu a.logout:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* Main Content Area */
        .main {
            flex: 1;
            margin-left: 260px;
            transition: var(--transition);
            background: var(--content-bg);
            min-height: 100vh;
        }

        /* Navbar Styles */
        .navbar {
            height: 80px;
            background: var(--navbar-bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 1px solid var(--border-color);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--text-muted);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .toggle-sidebar:hover {
            background: var(--sidebar-hover);
            color: var(--primary);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: var(--radius);
            transition: var(--transition);
            background: var(--sidebar-hover);
        }

        .user-info:hover {
            background: rgba(67, 97, 238, 0.15);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .logout-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.2);
        }

        /* Content Styles */
        .content {
            padding: 30px;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .stat-info p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Recent Activity */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--sidebar-hover);
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
        }

        .view-all:hover {
            gap: 8px;
        }

        .card-body {
            padding: 25px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background: var(--sidebar-hover);
            font-weight: 600;
            color: var(--text-dark);
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr:hover {
            background: var(--sidebar-hover);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-success { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
        .badge-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .badge-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        .badge-primary { background: rgba(67, 97, 238, 0.1); color: var(--primary); }

        .action-btn {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .action-btn:hover {
            color: var(--secondary);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 240px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main {
                margin-left: 0;
            }
            
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .navbar {
                padding: 0 20px;
            }
            
            .content {
                padding: 20px;
            }
            
            .user-details {
                display: none;
            }
            
            .navbar-right {
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 15px;
                overflow-x: auto;
            }
            
            .table {
                min-width: 600px;
            }
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-user-shield"></i>
            <h2>Admin Panel</h2>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Trang chủ</span>
            </a>

            <a href="{{ route('admin.user.manager') }}"
            class="{{ request()->routeIs('admin.user.manager') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Quản lý người dùng</span>
            </a>

            <a href="{{ route('admin.category.manager') }}"
            class="{{ request()->routeIs('admin.category.manager') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span>Quản lý danh mục</span>
            </a>

            <a href="{{ route('admin.job.manager') }}"
            class="{{ request()->routeIs('admin.job.manager') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                <span>Quản lý công việc</span>
            </a>

            <a href="{{ route('admin.employer.manager') }}"
            class="{{ request()->routeIs('admin.employer.manager') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i>
                <span>Quản lý công ty</span>
            </a>

            <a href="{{ route('admin.application_job') }}"
            class="{{ request()->routeIs('admin.application_job') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Danh sách CV ứng tuyển</span>
            </a>

            <a href="{{ url('authen/logout') }}" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>

    {{-- Main content area --}}
    <div class="main">
        {{-- Top Navbar --}}
        <div class="navbar">
            <div class="navbar-left">
                <button class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="navbar-right">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ substr($user->name ?? $user->email ?? 'A', 0, 1) }}
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ $user->name ?? $user->email ?? 'Admin' }}</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
                <a href="{{ route('authen.logout') }}" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </div>
        @yield('content')
    </div>

    <script>
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>