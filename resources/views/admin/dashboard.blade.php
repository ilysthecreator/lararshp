@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    /* Core Styles */
    .container-fluid { padding: 2rem; }
    
    /* Card & Grid Styles */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .card {
        position: relative;
        background: white;
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
    }

    .card-body {
        padding: 1.25rem;
    }

    /* Stats Card Styles */
    .stat-card {
        border-left: 4px solid;
        background: white;
        padding: 1.25rem;
    }

    .stat-icon {
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        font-size: 1.5rem;
    }

    .stat-card.primary { border-left-color: #0066cc; }
    .stat-card.success { border-left-color: #28a745; }
    .stat-card.warning { border-left-color: #ffc107; }
    .stat-card.info { border-left-color: #17a2b8; }

    .stat-icon.primary { 
        background: rgba(0, 102, 204, 0.1);
        color: #0066cc;
    }
    .stat-icon.success { 
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    .stat-icon.warning { 
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    .stat-icon.info { 
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
    }

    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, #0066cc, #00a8e8);
        color: white;
        border: none;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .welcome-card h2 {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .welcome-card p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
    }

    /* Feature Grid */
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .feature-icon {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }

    /* Text Utilities */
    .text-xs {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .text-primary { color: #0066cc !important; }
    .text-success { color: #28a745 !important; }
    .text-warning { color: #ffc107 !important; }
    .text-info { color: #17a2b8 !important; }
    .text-muted { color: #6c757d !important; }

    /* Spacing */
    .mb-1 { margin-bottom: 0.25rem !important; }
    .mb-2 { margin-bottom: 0.5rem !important; }
    .mb-3 { margin-bottom: 1rem !important; }
    .mb-4 { margin-bottom: 1.5rem !important; }
    .mt-2 { margin-top: 0.5rem !important; }
    
    /* Button Overrides */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.2rem;
    }
</style>

<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="stats-grid">
        <!-- Jenis Hewan -->
        <div class="card stat-card success">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-success mb-1">Jenis Hewan</div>
                        <div class="h4 mb-0 font-weight-bold">{{ $stats['jenis_hewan'] }}</div>
                    </div>
                    <div class="stat-icon success">
                        <i class="fas fa-paw"></i>
                    </div>
                </div>
                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-success btn-sm d-block mt-3">
                    Kelola Data
                </a>
            </div>
        </div>

        <!-- Total Pet -->
        <div class="card stat-card warning">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-warning mb-1">Total Pet</div>
                        <div class="h4 mb-0 font-weight-bold">{{ $stats['pet'] }}</div>
                    </div>
                    <div class="stat-icon warning">
                        <i class="fas fa-cat"></i>
                    </div>
                </div>
                <a href="{{ route('admin.pet.index') }}" class="btn btn-warning btn-sm d-block mt-3">
                    Kelola Data
                </a>
            </div>
        </div>

        <!-- Total Pemilik -->
        <div class="card stat-card info">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-info mb-1">Total Pemilik</div>
                        <div class="h4 mb-0 font-weight-bold">{{ $stats['pemilik'] }}</div>
                    </div>
                    <div class="stat-icon info">
                        <i class="fas fa-user-friends"></i>
                    </div>
                </div>
                <a href="{{ route('admin.pemilik.index') }}" class="btn btn-info btn-sm d-block mt-3">
                    Kelola Data
                </a>
            </div>
        </div>

        <!-- Total Users -->
        <div class="card stat-card primary">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-primary mb-1">Total Users</div>
                        <div class="h4 mb-0 font-weight-bold">{{ $stats['user'] }}</div>
                    </div>
                    <div class="stat-icon primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm d-block mt-3">
                    Kelola Data
                </a>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="card welcome-card mb-4">
        <div class="card-body">
            <h2>
                <i class="fas fa-home mr-2"></i>
                Selamat Datang di Dashboard Admin
            </h2>
            <p>
                Selamat datang di panel admin RSHP UNAIR. Dari sini Anda dapat mengelola berbagai aspek sistem dengan mudah dan efisien.
            </p>
        </div>
    </div>

    <!-- Feature Cards -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="text-primary font-weight-bold mb-4">Fitur Manajemen</h4>
            <div class="feature-grid">
                <!-- Jenis Hewan -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature-icon primary">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h5 class="font-weight-bold mb-2">Jenis Hewan</h5>
                        <p class="text-muted mb-0">Kelola daftar jenis hewan yang ditangani di rumah sakit.</p>
                    </div>
                </div>

                <!-- Users -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature-icon success">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="font-weight-bold mb-2">Manajemen Users</h5>
                        <p class="text-muted mb-0">Kelola pengguna sistem dan hak akses.</p>
                    </div>
                </div>

                <!-- Reports -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature-icon primary">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="font-weight-bold mb-2">Laporan & Statistik</h5>
                        <p class="text-muted mb-0">Pantau kinerja sistem dengan dashboard analitik.</p>
                    </div>
                </div>

                <!-- Settings -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="feature-icon success">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h5 class="font-weight-bold mb-2">Pengaturan Sistem</h5>
                        <p class="text-muted mb-0">Konfigurasi sistem sesuai kebutuhan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection