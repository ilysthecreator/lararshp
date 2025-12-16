<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Area Pemilik Hewan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            /* Warna Ungu untuk Pemilik/Customer */
            --primary-color: #6f42c1; 
            --secondary-color: #a57cc4;
            --sidebar-width: 260px;
        }
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; }
        .sidebar {
            position: fixed; left: 0; top: 0; width: var(--sidebar-width); min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            z-index: 1000; box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar-header { padding: 2rem 1.5rem; color: white; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-menu { list-style: none; padding: 1rem 0; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 1rem; padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8); text-decoration: none; font-weight: 500; transition: 0.3s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; }
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; display: flex; flex-direction: column; }
        .topbar {
            background: white; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex; justify-content: space-between; align-items: center;
        }
        .content { padding: 2rem; flex: 1; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0 fw-bold"><i class="fas fa-cat me-2"></i>Pet Owner</h4>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('pemilik.dashboard') }}" class="{{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('pemilik.jadwal.index') }}" class="{{ request()->routeIs('pemilik.jadwal.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> Jadwal Temu</a></li>
            <li><a href="{{ route('pemilik.riwayat.index') }}" class="{{ request()->routeIs('pemilik.riwayat.*') ? 'active' : '' }}"><i class="fas fa-history"></i> Rekam Medis</a></li>
            <li><a href="{{ route('pemilik.profil.index') }}" class="{{ request()->routeIs('pemilik.profil.*') ? 'active' : '' }}"><i class="fas fa-user"></i> Profil & Pet</a></li>
        </ul>
    </aside>
    <div class="main-content">
        <div class="topbar">
            <h5 class="m-0 text-dark">@yield('title')</h5>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold">{{ Auth::user()->nama }}</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-sm btn-danger">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
        <div class="content">@yield('content')</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>