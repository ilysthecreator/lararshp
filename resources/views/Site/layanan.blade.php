@extends('site.layout')

@section('title', 'Layanan')

@section('content')
<div class="hero">
    <div class="hero-content">
        <h1>Layanan Medis Kami</h1>
        <p>Pelayanan kesehatan berkualitas dengan berbagai spesialisasi medis</p>
    </div>
</div>

<div class="container">
    <!-- Layanan Poliklinik -->
    <div class="content-section">
        <h2>Layanan Poliklinik</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3>Poli Umum</h3>
                <p>Pemeriksaan kesehatan umum dan konsultasi medis untuk berbagai keluhan kesehatan sehari-hari.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3>Poli Jantung</h3>
                <p>Pemeriksaan dan penanganan penyakit kardiovaskular dengan teknologi EKG dan echocardiography.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-lungs"></i>
                </div>
                <h3>Poli Paru</h3>
                <p>Diagnosis dan terapi penyakit pernapasan termasuk asma, PPOK, dan infeksi paru.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3>Poli Saraf</h3>
                <p>Penanganan gangguan sistem saraf seperti stroke, epilepsi, dan neuropati.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-bone"></i>
                </div>
                <h3>Poli Ortopedi</h3>
                <p>Perawatan tulang, sendi, dan otot termasuk cedera olahraga dan kelainan postur.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-baby-carriage"></i>
                </div>
                <h3>Poli Anak</h3>
                <p>Pemeriksaan kesehatan anak, imunisasi, dan tumbuh kembang anak.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-female"></i>
                </div>
                <h3>Poli Kandungan</h3>
                <p>Layanan kesehatan reproduksi wanita, kehamilan, dan persalinan.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Poli Mata</h3>
                <p>Pemeriksaan dan pengobatan gangguan penglihatan dan penyakit mata.</p>
            </div>
        </div>
    </div>

    <!-- Media Placeholder -->
    <div class="media-container">
        <i class="fas fa-video"></i>
        <p><strong>Video Fasilitas Poliklinik</strong></p>
        <p>Tempatkan video tour fasilitas poliklinik di sini</p>
    </div>

    <!-- Layanan Penunjang -->
    <div class="content-section">
        <h2>Layanan Penunjang Medis</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-vial"></i>
                </div>
                <h3>Laboratorium</h3>
                <p>Pemeriksaan laboratorium lengkap dengan hasil cepat dan akurat menggunakan peralatan modern.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-x-ray"></i>
                </div>
                <h3>Radiologi</h3>
                <p>Layanan Rontgen, CT Scan, MRI, dan USG untuk diagnosis yang tepat.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-pills"></i>
                </div>
                <h3>Farmasi</h3>
                <p>Apotek dengan stok obat lengkap dan konsultasi farmasi profesional.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-procedures"></i>
                </div>
                <h3>Fisioterapi</h3>
                <p>Rehabilitasi medis untuk pemulihan fungsi gerak dan mengurangi nyeri.</p>
            </div>
        </div>
    </div>

    <!-- Layanan Rawat Inap -->
    <div class="content-section">
        <h2>Layanan Rawat Inap</h2>
        <div class="card-grid">
            <div class="card">
                <h3><i class="fas fa-bed" style="margin-right: 8px; color: var(--primary);"></i> Kelas VIP</h3>
                <p>Kamar private dengan fasilitas lengkap, AC, TV, kulkas, dan sofa untuk penunggu.</p>
            </div>
            <div class="card">
                <h3><i class="fas fa-bed" style="margin-right: 8px; color: var(--primary);"></i> Kelas I</h3>
                <p>Kamar dengan 2 tempat tidur, AC, TV, dan kamar mandi dalam.</p>
            </div>
            <div class="card">
                <h3><i class="fas fa-bed" style="margin-right: 8px; color: var(--primary);"></i> Kelas II</h3>
                <p>Kamar dengan 4 tempat tidur, AC, dan fasilitas standar yang nyaman.</p>
            </div>
            <div class="card">
                <h3><i class="fas fa-bed" style="margin-right: 8px; color: var(--primary);"></i> Kelas III</h3>
                <p>Kamar dengan beberapa tempat tidur dan fasilitas standar sesuai standar BPJS.</p>
            </div>
        </div>
    </div>

    <!-- Image Placeholder -->
    <div class="media-container">
        <i class="fas fa-images"></i>
        <p><strong>Galeri Ruang Rawat Inap</strong></p>
        <p>Tempatkan foto-foto ruang rawat inap berbagai kelas</p>
    </div>

    <!-- Layanan Unggulan -->
    <div class="content-section">
        <h2>Layanan Unggulan</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-ambulance"></i>
                </div>
                <h3>IGD 24 Jam</h3>
                <p>Unit Gawat Darurat yang siap melayani kasus darurat medis setiap saat dengan tim dokter jaga 24 jam.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <h3>ICU & NICU</h3>
                <p>Intensive Care Unit dan Neonatal ICU dengan monitoring ketat dan peralatan life support modern.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-syringe"></i>
                </div>
                <h3>Hemodialisa</h3>
                <p>Layanan cuci darah dengan mesin modern dan tenaga medis berpengalaman.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-briefcase-medical"></i>
                </div>
                <h3>Medical Check Up</h3>
                <p>Paket pemeriksaan kesehatan lengkap untuk deteksi dini penyakit dengan harga terjangkau.</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="content-section" style="text-align: center; background: var(--surface); border: 1px solid var(--border);">
        <h2>Butuh Informasi Lebih Lanjut?</h2>
        <p style="font-size: 16px; margin-bottom: 24px; color: var(--text-secondary);">Tim kami siap membantu Anda dengan pelayanan terbaik</p>
        <a href="{{ route('kontak') }}" class="btn btn-primary" style="padding: 14px 32px;">Hubungi Kami</a>
    </div>
</div>
@endsection