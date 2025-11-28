@extends('site.layout')

@section('title', 'Home')

@section('content')
<div class="hero">
    <div class="hero-content">
        <h1>Selamat Datang di RSHP UNAIR</h1>
        <p>Rumah Sakit Pendidikan Universitas Airlangga - Pelayanan Kesehatan Berkualitas dengan Sentuhan Akademis</p>
        <a href="{{ route('layanan') }}" class="btn btn-primary" style="margin-top: 24px; padding: 14px 32px;">Lihat Layanan Kami</a>
    </div>
</div>

    <!-- Keunggulan -->
    <div class="content-section">
        <h2>Mengapa Memilih RSHP UNAIR?</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3>Dokter Berpengalaman</h3>
                <p>Tim medis profesional dari dosen dan praktisi terbaik Universitas Airlangga dengan keahlian di berbagai bidang spesialisasi.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-hospital-alt"></i>
                </div>
                <h3>Fasilitas Modern</h3>
                <p>Dilengkapi dengan peralatan medis canggih dan ruangan yang nyaman untuk kenyamanan pasien dan keluarga.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Layanan 24/7</h3>
                <p>Unit Gawat Darurat beroperasi 24 jam setiap hari untuk memberikan pelayanan kesehatan yang cepat dan tepat.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>RS Pendidikan</h3>
                <p>Sebagai rumah sakit pendidikan, kami menggabungkan praktik medis terbaik dengan riset dan inovasi terkini.</p>
            </div>
        </div>
    </div>

    <!-- Layanan Unggulan -->
    <div class="content-section">
        <h2>Layanan Unggulan</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3>Kardiologi</h3>
                <p>Pelayanan kesehatan jantung dan pembuluh darah dengan teknologi terkini.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3>Neurologi</h3>
                <p>Penanganan komprehensif untuk gangguan sistem saraf dan otak.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-baby"></i>
                </div>
                <h3>Obstetri & Ginekologi</h3>
                <p>Layanan kesehatan ibu dan anak dengan fasilitas NICU modern.</p>
            </div>
        </div>
    </div>

    <!-- Image Placeholder -->
    <div class="media-container">
        <i class="fas fa-camera"></i>
        <p style="margin-top: 16px;"><strong>Galeri Fasilitas Rumah Sakit</strong></p>
        <p style="margin-top: 8px;">Tempatkan foto-foto fasilitas RS seperti ruang rawat inap, ruang operasi, laboratorium, dll.</p>
    </div>

    <!-- Informasi Cepat -->
    <div class="content-section">
        <h2>Informasi Penting</h2>
        <div class="card-grid">
            <div class="card">
                <h3 style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <i class="fas fa-calendar-check" style="color: var(--primary); font-size: 24px;"></i> 
                    Jam Operasional
                </h3>
                <p style="margin-bottom: 8px;"><strong>Poliklinik:</strong> Senin - Sabtu (08:00 - 16:00)</p>
                <p><strong>IGD:</strong> 24 Jam Setiap Hari</p>
            </div>
            <div class="card">
                <h3 style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <i class="fas fa-ambulance" style="color: var(--primary); font-size: 24px;"></i> 
                    Layanan Darurat
                </h3>
                <p style="margin-bottom: 8px;"><strong>Hubungi segera:</strong> (031) 5999000</p>
                <p>Unit Gawat Darurat siap melayani Anda</p>
            </div>
            <div class="card">
                <h3 style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <i class="fas fa-notes-medical" style="color: var(--primary); font-size: 24px;"></i> 
                    Pendaftaran
                </h3>
                <p style="margin-bottom: 8px;">Daftar online atau langsung di loket pendaftaran</p>
                <p>Bawa kartu identitas dan kartu BPJS (jika ada)</p>
            </div>
        </div>
    </div>
</div>
@endsection