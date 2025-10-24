<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSHP UNAIR') - Rumah Sakit Universitas Airlangga</title>
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
            --accent-color: #ff6b6b;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --text-color: #333;
            --border-radius: 12px;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #fff;
        }

        /* Alert Notification */
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .alert {
            border-radius: var(--border-radius);
            padding: 1.25rem 1.5rem;
            margin-bottom: 1rem;
            border: none;
            box-shadow: var(--shadow-lg);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
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
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
        }

        .alert-content i {
            font-size: 1.5rem;
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s ease;
            color: inherit;
            padding: 0;
            margin-left: 1rem;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 0;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .logo i {
            font-size: 2rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 0.5rem;
            align-items: center;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.95), rgba(0, 168, 232, 0.95)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center;
            padding: 5rem 2rem;
            text-align: center;
            color: white;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .hero-content p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Content Section */
        .content-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .content-section h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: 700;
        }

        /* Card Grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .card-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .card h3 {
            color: var(--dark-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .card p {
            color: #666;
            line-height: 1.8;
        }

        /* Image/Video Placeholder */
        .media-container {
            background: var(--light-color);
            border-radius: var(--border-radius);
            padding: 3rem;
            text-align: center;
            margin: 2rem 0;
            border: 2px dashed #ddd;
            transition: all 0.3s ease;
        }

        /* If the container includes media like an image or video, make the media responsive
           and visually remove the dashed frame by keeping it subtle. */
        .media-container img,
        .media-container video {
            width: 100%;
            max-width: 1920px; /* respect desired 1920px width */
            height: auto;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-radius: 12px;
            display: block;
            margin: 0 auto;
        }

        /* When media is present, reduce padding and soften the border */
        .media-container--media {
            /* Remove decorative border and background when actual media (video/image) is present */
            padding: 0;
            border: none;
            background: transparent;
        }

        /* Hide placeholder icon/text when real media is displayed */
        .media-container--media i,
        .media-container--media > p {
            display: none;
        }

        .media-container:hover {
            border-color: var(--primary-color);
            background: #f0f7ff;
        }

        .media-container i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .media-container p {
            color: #999;
            font-size: 1.1rem;
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 2rem 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }

        .footer-section p,
        .footer-section a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #999;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #0052a3;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background: #0087c1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .alert-container {
                right: 10px;
                left: 10px;
                max-width: none;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                flex-direction: column;
                padding: 1rem;
                gap: 0;
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-toggle {
                display: block;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .card-grid {
                grid-template-columns: 1fr;
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
                <li><a href="{{ route('struktur-organisasi') }}" class="{{ request()->routeIs('struktur-organisasi') ? 'active' : '' }}">
                    <i class="fas fa-sitemap"></i> Struktur Organisasi
                </a></li>
                <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a></li>
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
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }

        // Auto-hide alerts after 5 seconds
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