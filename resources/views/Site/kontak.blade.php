@extends('site.layout')

@section('title', 'Kontak')

@section('content')
<div class="hero">
    <div class="hero-content">
        <h1>Hubungi Kami</h1>
        <p>Kami siap melayani dan menjawab pertanyaan Anda</p>
    </div>
</div>

<div class="container">
    <!-- Informasi Kontak -->
    <div class="content-section">
        <h2>Informasi Kontak</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Alamat</h3>
                <p>Jl. Prof. Dr. Moestopo No. 47<br>
                Surabaya, Jawa Timur 60131<br>
                Indonesia</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3>Telepon</h3>
                <p><strong>Call Center:</strong> (031) 5999000<br>
                <strong>IGD:</strong> (031) 5999111<br>
                <strong>Fax:</strong> (031) 5999222</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Email</h3>
                <p><strong>Umum:</strong> info@rshp.unair.ac.id<br>
                <strong>Pendaftaran:</strong> daftar@rshp.unair.ac.id<br>
                <strong>Komplain:</strong> complaint@rshp.unair.ac.id</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Jam Operasional</h3>
                <p><strong>Poliklinik:</strong><br>
                Senin - Jumat: 08:00 - 16:00<br>
                Sabtu: 08:00 - 13:00<br>
                <strong>IGD:</strong> 24 Jam</p>
            </div>
        </div>
    </div>

    <!-- Map Placeholder -->
    <div class="media-container">
        <i class="fas fa-map-marked-alt"></i>
        <p><strong>Google Maps Lokasi RS</strong></p>
        <p>Embed Google Maps di sini</p>
    </div>

    <!-- Form Kontak -->
    <div class="content-section">
        <h2>Kirim Pesan</h2>
        <form style="max-width: 720px; margin: 0 auto;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); font-size: 14px;">Nama Lengkap *</label>
                <input type="text" required style="width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border 0.2s; font-family: 'Inter', sans-serif;" placeholder="Masukkan nama lengkap Anda">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); font-size: 14px;">Email *</label>
                <input type="email" required style="width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border 0.2s; font-family: 'Inter', sans-serif;" placeholder="nama@email.com">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); font-size: 14px;">Nomor Telepon *</label>
                <input type="tel" required style="width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border 0.2s; font-family: 'Inter', sans-serif;" placeholder="08xxxxxxxxxx">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); font-size: 14px;">Subjek *</label>
                <select required style="width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border 0.2s; font-family: 'Inter', sans-serif; background: white;">
                    <option value="">-- Pilih Subjek --</option>
                    <option value="informasi">Informasi Umum</option>
                    <option value="jadwal">Jadwal Dokter</option>
                    <option value="pendaftaran">Pendaftaran</option>
                    <option value="komplain">Komplain</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            
            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); font-size: 14px;">Pesan *</label>
                <textarea required rows="6" style="width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border 0.2s; resize: vertical; font-family: 'Inter', sans-serif;" placeholder="Tulis pesan Anda di sini..."></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 15px; padding: 14px;">
                Kirim Pesan
            </button>
        </form>
    </div>

    <!-- Social Media -->
    <div class="content-section">
        <h2>Ikuti Kami di Media Sosial</h2>
        <div class="card-grid">
            <div class="card" style="text-align: center;">
                <div class="card-icon">
                    <i class="fab fa-facebook" style="color: #1877f2;"></i>
                </div>
                <h3>Facebook</h3>
                <p style="margin-bottom: 16px;">@RSHPUnair</p>
                <a href="#" class="btn btn-secondary">Kunjungi</a>
            </div>
            <div class="card" style="text-align: center;">
                <div class="card-icon">
                    <i class="fab fa-instagram" style="color: #e4405f;"></i>
                </div>
                <h3>Instagram</h3>
                <p style="margin-bottom: 16px;">@rshp_unair</p>
                <a href="#" class="btn btn-secondary">Kunjungi</a>
            </div>
            <div class="card" style="text-align: center;">
                <div class="card-icon">
                    <i class="fab fa-twitter" style="color: #1da1f2;"></i>
                </div>
                <h3>Twitter</h3>
                <p style="margin-bottom: 16px;">@RSHPUnair</p>
                <a href="#" class="btn btn-secondary">Kunjungi</a>
            </div>
            <div class="card" style="text-align: center;">
                <div class="card-icon">
                    <i class="fab fa-youtube" style="color: #ff0000;"></i>
                </div>
                <h3>YouTube</h3>
                <p style="margin-bottom: 16px;">RSHP Unair Official</p>
                <a href="#" class="btn btn-secondary">Kunjungi</a>
            </div>
        </div>
    </div>

    <!-- Emergency Contact -->
    <div class="content-section" style="background: #fef2f2; border: 1px solid #fecaca; text-align: center;">
        <h2 style="color: #991b1b;"><i class="fas fa-exclamation-triangle"></i> Kondisi Darurat?</h2>
        <p style="font-size: 16px; margin-bottom: 20px; color: #991b1b;">Segera hubungi layanan gawat darurat kami</p>
        <a href="tel:0315999111" class="btn" style="background: #dc2626; color: white; font-size: 16px; padding: 14px 32px;">
            <i class="fas fa-phone-alt"></i> (031) 5999111
        </a>
    </div>
</div>

<style>
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
</style>
@endsection