@extends('site.layout')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="hero">
    <div class="hero-content">
        <h1>Struktur Organisasi</h1>
        <p>Tim Manajemen dan Kepemimpinan RSHP UNAIR</p>
    </div>
</div>

<div class="container">
    <!-- Dewan Pimpinan -->
    <div class="content-section">
        <h2>Dewan Pimpinan</h2>
        <div style="max-width: 400px; margin: 2rem auto;">
            <div class="card" style="text-align: center;">
                <div class="media-container" style="margin: 0 0 1rem 0; padding: 2rem;">
                    <i class="fas fa-user-tie" style="font-size: 5rem;"></i>
                    <p style="margin-top: 1rem; color: #999;">Foto Direktur</p>
                </div>
                <h3>Direktur Utama</h3>
                <p style="color: var(--primary-color); font-weight: 600;">Prof. Dr. dr. [Nama Direktur], Sp.XX</p>
                <p style="margin-top: 0.5rem; color: #666;">Memimpin operasional dan strategis rumah sakit</p>
            </div>
        </div>
    </div>

    <!-- Manajemen Eksekutif -->
    <div class="content-section">
        <h2>Manajemen Eksekutif</h2>
        <div class="card-grid">
            <div class="card" style="text-align: center;">
                <div class="media-container" style="margin: 0 0 1rem 0; padding: 2rem;">
                    <i class="fas fa-user-md" style="font-size: 4rem;"></i>
                    <p style="margin-top: 0.5rem; color: #999;">Foto</p>
                </div>
                <h3>Wakil Direktur Medis</h3>
                <p style="color: var(--primary-color); font-weight: 600;">dr. [Nama], Sp.XX</p>
                <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">Mengawasi pelayanan medis dan kualitas perawatan</p>
            </div>
            
            <div class="card" style="text-align: center;">
                <div class="media-container" style="margin: 0 0 1rem 0; padding: 2rem;">
                    <i class="fas fa-user-tie" style="font-size: 4rem;"></i>
                    <p style="margin-top: 0.5rem; color: #999;">Foto</p>
                </div>
                <h3>Wakil Direktur Umum</h3>
                <p style="color: var(--primary-color); font-weight: 600;">[Nama], S.E., M.M.</p>
                <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">Mengelola administrasi dan keuangan</p>
            </div>
            
            <div class="card" style="text-align: center;">
                <div class="media-container" style="margin: 0 0 1rem 0; padding: 2rem;">
                    <i class="fas fa-user-nurse" style="font-size: 4rem;"></i>
                    <p style="margin-top: 0.5rem; color: #999;">Foto</p>
                </div>
                <h3>Kepala Bidang Keperawatan</h3>
                <p style="color: var(--primary-color); font-weight: 600;">[Nama], S.Kep., Ns., M.Kep.</p>
                <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">Mengkoordinasi layanan keperawatan</p>
            </div>
        </div>
    </div>

    <!-- Diagram Struktur -->
    <div class="content-section">
        <h2>Bagan Struktur Organisasi</h2>
        <div class="media-container">
            <i class="fas fa-sitemap" style="font-size: 5rem;"></i>
            <p><strong>Diagram Struktur Organisasi</strong></p>
            <p>Tempatkan gambar bagan struktur organisasi lengkap di sini</p>
            <p style="margin-top: 1rem; color: #666;">Format: PNG atau JPG, Ukuran: Min. 1200px width</p>
        </div>
    </div>

    <!-- Kepala Instalasi -->
    <div class="content-section">
        <h2>Kepala Instalasi & Unit</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-procedures"></i>
                </div>
                <h3>Instalasi Rawat Inap</h3>
                <p style="font-weight: 600; color: var(--primary-color);">dr. [Nama], Sp.XX</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-ambulance"></i>
                </div>
                <h3>Instalasi Gawat Darurat</h3>
                <p style="font-weight: 600; color: var(--primary-color);">dr. [Nama], Sp.EM</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-clinic-medical"></i>
                </div>
                <h3>Instalasi Rawat Jalan</h3>
                <p style="font-weight: 600; color: var(--primary-color);">dr. [Nama], M.Kes</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-vial"></i>
                </div>
                <h3>Instalasi Laboratorium</h3>
                <p style="font-weight: 600; color: var(--primary-color);">dr. [Nama], Sp.PK</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-x-ray"></i>
                </div>
                <h3>Instalasi Radiologi</h3>
                <p style="font-weight: 600; color: var(--primary-color);">dr. [Nama], Sp.Rad</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-pills"></i>
                </div>
                <h3>Instalasi Farmasi</h3>
                <p style="font-weight: 600; color: var(--primary-color);">Apt. [Nama], S.Farm</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-user-nurse"></i>
                </div>
                <h3>Instalasi Bedah Sentral</h3>
                <p style="font-weight: 600; color: var(--primary-color);">dr. [Nama], Sp.An</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3>Instalasi ICU/ICCU</h3>
                <p style="font-weight: 600; color: var(--primary-color);">dr. [Nama], Sp.An-KIC</p>
            </div>
        </div>
    </div>

    <!-- Komite & Kelompok Staf -->
    <div class="content-section">
        <h2>Komite & Kelompok Staf Medis</h2>
        <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
            <div class="card">
                <h3><i class="fas fa-shield-alt"></i> Komite Medis</h3>
                <p>Mengawasi standar pelayanan medis dan etika profesi</p>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-user-check"></i> Komite Keperawatan</h3>
                <p>Menjamin kualitas asuhan keperawatan</p>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-clipboard-check"></i> Komite Mutu</h3>
                <p>Peningkatan mutu dan keselamatan pasien</p>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-file-medical"></i> Komite Rekam Medis</h3>
                <p>Pengelolaan dan pengawasan rekam medis</p>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-biohazard"></i> Komite PPI</h3>
                <p>Pencegahan dan Pengendalian Infeksi</p>
            </div>
            
            <div class="card">
                <h3><i class="fas fa-balance-scale"></i> Komite Etik</h3>
                <p>Pengawasan aspek etika dalam pelayanan</p>
            </div>
        </div>
    </div>

    <!-- Tim Pendidikan -->
    <div class="content-section">
        <h2>Divisi Pendidikan & Penelitian</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Pendidikan & Pelatihan</h3>
                <p>Menyelenggarakan program pendidikan kedokteran, keperawatan, dan profesi kesehatan lainnya sebagai rumah sakit pendidikan.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-microscope"></i>
                </div>
                <h3>Penelitian & Pengembangan</h3>
                <p>Mendukung riset medis dan inovasi pelayanan kesehatan berbasis bukti ilmiah.</p>
            </div>
        </div>
    </div>

    <!-- Video Section -->
    <div class="media-container">
        <i class="fas fa-video"></i>
        <p><strong>Video Profil Tim & Fasilitas</strong></p>
        <p>Tempatkan video profil tim medis dan tour fasilitas rumah sakit</p>
    </div>
</div>
@endsection