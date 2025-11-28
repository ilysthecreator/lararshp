<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSHP UNAIR') - Rumah Sakit Universitas Airlangga</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --background: #ffffff;
            --surface: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: var(--background);
            font-weight: 400;
        }

        /* Alert Notification */
        .alert-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            max-width: 420px;
        }

        .alert {
            background: white;
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 12px;
            border-left: 3px solid;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            border-left-color: #10b981;
        }

        .alert-error {
            border-left-color: #ef4444;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .alert-content i {
            font-size: 20px;
        }

        .alert-success .alert-content i {
            color: #10b981;
        }

        .alert-error .alert-content i {
            color: #ef4444;
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            opacity: 0.4;
            transition: opacity 0.2s;
            color: inherit;
            padding: 0;
            margin-left: 12px;
        }

        .alert-close:hover {
            opacity: 0.8;
        }

        /* Navbar */
        .navbar {
            background: white;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 20px;
        }

        .logo i {
            font-size: 28px;
            color: var(--primary);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 8px;
            align-items: center;
        }

        .nav-menu a {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 14px;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: var(--primary);
            background: #eff6ff;
        }

        .nav-menu a i {
            font-size: 14px;
            margin-right: 6px;
        }

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 24px;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            background: var(--surface);
            padding: 80px 24px;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 42px;
            margin-bottom: 16px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .hero-content p {
            font-size: 18px;
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Container */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 64px 24px;
        }

        /* Content Section */
        .content-section {
            background: white;
            border-radius: 12px;
            padding: 48px;
            margin-bottom: 32px;
            border: 1px solid var(--border);
        }

        .content-section h2 {
            color: var(--text-primary);
            margin-bottom: 32px;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        /* Card Grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 32px;
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .card h3 {
            color: var(--text-primary);
            margin-bottom: 12px;
            font-size: 18px;
            font-weight: 600;
        }

        .card p {
            color: var(--text-secondary);
            line-height: 1.7;
            font-size: 14px;
        }

        /* Media Container */
        .media-container {
            background: var(--surface);
            border-radius: 12px;
            padding: 64px;
            text-align: center;
            margin: 32px 0;
            border: 2px dashed var(--border);
        }

        .media-container img,
        .media-container video {
            width: 100%;
            max-width: 1920px;
            height: auto;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
        }

        .media-container--media {
            padding: 0;
            border: none;
            background: transparent;
        }

        .media-container--media i,
        .media-container--media > p {
            display: none;
        }

        .media-container i {
            font-size: 48px;
            color: var(--border);
            margin-bottom: 16px;
        }

        .media-container p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Footer */
        .footer {
            background: var(--text-primary);
            color: white;
            padding: 64px 24px 24px;
            margin-top: 80px;
        }

        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 600;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 12px;
            font-size: 14px;
            transition: color 0.2s;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-light);
        }

        .btn-secondary {
            background: var(--surface);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .alert-container {
                right: 16px;
                left: 16px;
                max-width: none;
            }

            .navbar-container {
                padding: 12px 16px;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 16px;
                gap: 0;
                border-bottom: 1px solid var(--border);
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-menu a {
                width: 100%;
                padding: 12px 16px;
            }

            .nav-toggle {
                display: block;
            }

            .hero {
                padding: 48px 16px;
            }

            .hero-content h1 {
                font-size: 32px;
            }

            .hero-content p {
                font-size: 16px;
            }

            .container {
                padding: 32px 16px;
            }

            .content-section {
                padding: 24px;
            }

            .content-section h2 {
                font-size: 24px;
            }

            .card-grid {
                grid-template-columns: 1fr;
            }

            .media-container {
                padding: 32px;
            }
        }
    </style>
</head>
<body>
    <!-- Alert Container -->
    @if(session('success') || session('error'))
    <div class="alert-container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <div class="alert-content">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" role="alert">
                <div class="alert-content">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif
    </div>
    @endif

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-hospital"></i>
                <span>RSHP UNAIR</span>
            </a>
            <button class="nav-toggle" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Home
                </a></li>
                <li><a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'active' : '' }}">
                    <i class="fas fa-stethoscope"></i> Layanan
                </a></li>
                <li><a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">
                    <i class="fas fa-phone"></i> Kontak
                </a></li>
                @guest
                    <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a></li>
                @else
                    @php
                        $dashboardRoute = 'home';
                        $userRole = session('user_role');
                        switch ($userRole) {
                            case 1: $dashboardRoute = 'admin.dashboard'; break;
                            case 2: $dashboardRoute = 'dokter.dashboard'; break;
                            case 3: $dashboardRoute = 'perawat.dashboard'; break;
                            case 4: $dashboardRoute = 'resepsionis.dashboard'; break;
                            case 5: $dashboardRoute = 'pemilik.dashboard'; break;
                        }
                    @endphp
                    <li>
                        <a href="{{ route($dashboardRoute) }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Rumah Sakit Universitas Airlangga</h3>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Mulyorejo, Surabaya, Jawa Timur</p>
                <p><i class="fas fa-phone"></i> (031) 5999000</p>
                <p><i class="fas fa-envelope"></i> info@rshp.unair.ac.id</p>
            </div>
            <div class="footer-section">
                <h3>Layanan Cepat</h3>
                <a href="{{ route('layanan') }}">Layanan Medis</a>
                <a href="#">IGD 24 Jam</a>
                <a href="#">Jadwal Dokter</a>
                <a href="#">Pendaftaran Online</a>
            </div>
            <div class="footer-section">
                <h3>Informasi</h3>
                <a href="#">Tentang Kami</a>
                <a href="#">Berita</a>
                <a href="#">Karir</a>
                <a href="#">FAQ</a>
            </div>
            <div class="footer-section">
                <h3>Ikuti Kami</h3>
                <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-youtube"></i> YouTube</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Rumah Sakit Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.style.transition = 'opacity 0.3s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                });
            }, 5000);
        });
    </script>
</body>
</html>