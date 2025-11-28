<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dashboard Dokter RSHP UNAIR</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #007bff; /* Biru Dokter */
            --secondary-color: #17a2b8; /* Info/Teal */
            --dark-color: #343a40;
            --sidebar-width: 260px;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f6fa;
        }
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
        .sidebar-header h2 i { font-size: 2rem; }
        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
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
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
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
            margin: 0;
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
            background: #dc3545;
            color: white !important;
            border: none;
            border-radius: 6px;
            text-decoration: none;
        }
        .content { padding: 2rem; }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>
                <i class="fas fa-user-md"></i>
                <span>Panel Dokter</span>
            </h2>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dokter.dashboard') }}" class="{{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dokter.pasien.index') }}" class="{{ request()->routeIs('dokter.pasien.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Data Pasien</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dokter.rekam-medis.index') }}" class="{{ request()->routeIs('dokter.rekam-medis.*') ? 'active' : '' }}">
                    <i class="fas fa-file-medical-alt"></i>
                    <span>Rekam Medis</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dokter.profile.show') }}" class="{{ request()->routeIs('dokter.profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
        </ul>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <h3>@yield('title')</h3>
            </div>
            <div class="topbar-right d-flex align-items-center">
                <div class="user-info mr-4">
                    <div class="user-avatar">
                        {{ strtoupper(substr(session('user_name', 'D'), 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight: 600;">{{ session('user_name', 'Dokter') }}</div>
                        <div style="font-size: 0.8rem; color: #6c757d;">{{ session('user_role_name', 'Dokter') }}</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}"
                   class="btn-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>