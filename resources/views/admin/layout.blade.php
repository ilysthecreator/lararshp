<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel RSHP UNAIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #0066cc;
            --secondary-color: #00a8e8;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-header h2 i {
            font-size: 2rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
        }

        .sidebar-menu li {
            margin: 0.25rem 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-left h3 {
            color: var(--dark-color);
            font-size: 1.5rem;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .btn-logout {
            padding: 0.5rem 1.5rem;
            background: var(--danger-color);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-logout:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        /* Content Area */
        .content {
            padding: 2rem;
        }

        /* Alert Styles */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .btn-close:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>
                <i class="fas fa-hospital"></i>
                <span>RSHP UNAIR</span>
            </h2>
            <p style="opacity: 0.8; font-size: 0.875rem; margin-top: 0.5rem;">Admin Dashboard</p>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jenis-hewan.index') }}" class="{{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                    <i class="fas fa-paw"></i>
                    <span>Jenis Hewan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ras-hewan.index') }}" class="{{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                    <i class="fas fa-dog"></i>
                    <span>Ras Hewan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kategori-klinis.index') }}" class="{{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                    <i class="fas fa-stethoscope"></i>
                    <span>Kategori Klinis</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kode-tindakan.index') }}" class="{{ request()->routeIs('admin.kode-tindakan.*') ? 'active' : '' }}">
                    <i class="fas fa-procedures"></i>
                    <span>Kode Tindakan Terapi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pet.index') }}" class="{{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                    <i class="fas fa-cat"></i>
                    <span>Data Pet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pemilik.index') }}" class="{{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                    <i class="fas fa-user-friends"></i>
                    <span>Data Pemilik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.role.index') }}" class="{{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Role</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Data User</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <h3>@yield('title')</h3>
            </div>
            <div class="topbar-right">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--dark-color);">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div style="font-size: 0.85rem; color: #666;">{{ ucfirst(Auth::user()->role ?? 'admin') }}</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <span><i class="fas fa-check-circle"></i> {{ session('success') }}</span>
                    <button type="button" class="btn-close" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <span><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</span>
                    <button type="button" class="btn-close" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
</body>
</html>