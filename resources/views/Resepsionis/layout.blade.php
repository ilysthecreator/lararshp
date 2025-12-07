<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - Panel Resepsionis</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #0d6efd; /* Bootstrap Primary Blue */
            --secondary-color: #0dcaf0; /* Bootstrap Info */
            --dark-color: #212529;
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
            min-height: 100vh;
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
                <i class="fas fa-headset"></i>
                <span>Panel Resepsionis</span>
            </h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('resepsionis.dashboard') }}" class="{{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="{{ route('resepsionis.temu-dokter.index') }}" class="{{ request()->routeIs('resepsionis.temu-dokter.*') ? 'active' : '' }}"><i class="fas fa-calendar-check"></i><span>Janji Temu</span></a></li>
            <li><a href="{{ route('resepsionis.pemilik.index') }}" class="{{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}"><i class="fas fa-users"></i><span>Data Pemilik</span></a></li>
            <li><a href="{{ route('resepsionis.pet.index') }}" class="{{ request()->routeIs('resepsionis.pet.*') ? 'active' : '' }}"><i class="fas fa-paw"></i><span>Data Hewan</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <h3>@yield('title')</h3>
            </div>
            <div class="topbar-right d-flex align-items-center">
                <div class="user-info me-4">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama ?? 'R', 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight: 600;">{{ Auth::user()->nama ?? 'Resepsionis' }}</div>
                        <div style="font-size: 0.8rem; color: #6c757d;">{{ session('user_role_name', 'Resepsionis') }}</div>
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
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>