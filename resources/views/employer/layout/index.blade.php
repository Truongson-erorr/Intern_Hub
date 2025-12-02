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

    /* Sidebar - White Clean */
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

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
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

    /* Main Content */
    .main {
        flex: 1;
        margin-left: 260px;
        transition: var(--transition);
        background: var(--content-bg);
        min-height: 100vh;
    }

    .navbar {
        height: 80px;
        background: var(--navbar-bg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        border-bottom: 1px solid var(--border-color);
        box-shadow: var(--shadow);
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
        background: var(--sidebar-hover);
        transition: var(--transition);
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

    .content {
        padding: 30px;
    }

    /* Cards & Table - giống Admin */
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

    .card {
        background: var(--card-bg);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 30px;
        overflow: hidden;
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

    /* Responsive */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }
        .sidebar.active {
            transform: translateX(0);
        }
        .main {
            margin-left: 0;
        }
    }

    @media (max-width: 768px) {
        .user-details { display: none; }
        .content { padding: 20px; }
        .navbar { padding: 0 20px; }
    }
</style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-user-tie"></i>
            <h2>Employer Panel</h2>
        </div>

        <div class="sidebar-menu">
            <a href="#">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <a href="#">
                <i class="fas fa-briefcase"></i>
                <span>Quản lý việc làm</span>
            </a>

            <a href="#">
                <i class="fas fa-users"></i>
                <span>Ứng viên nộp đơn</span>
            </a>

            <a href="#">
                <i class="fas fa-user-cog"></i>
                <span>Hồ sơ công ty</span>
            </a>

            <a href="#">
                <i class="fas fa-sign-out-alt"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>

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

</body>
</html>