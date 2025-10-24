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
        <!-- CONTOH PENGGUNAAN:
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.xxx" 
            width="100%" 
            height="450" 
            style="border:0; border-radius: 12px;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
        -->
    </div>

    <!-- Form Kontak -->
    <div class="content-section">
        <h2>Kirim Pesan</h2>
        <form style="max-width: 800px; margin: 0 auto;">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Nama Lengkap *</label>
                <input type="text" required style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: border 0.3s;" placeholder="Masukkan nama lengkap Anda">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Email *</label>
                <input type="email" required style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: border 0.3s;" placeholder="nama@email.com">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Nomor Telepon *</label>
                <input type="tel" required style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: border 0.3s;" placeholder="08xxxxxxxxxx">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Subjek *</label>
                <select required style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: border 0.3s;">
                    <option value="">-- Pilih Subjek --</option>
                    <option value="informasi">Informasi Umum</option>
                    <option value="jadwal">Jadwal Dokter</option>
                    <option value="pendaftaran">Pendaftaran</option>
                    <option value="komplain">Komplain</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Pesan *</label>
                <textarea required rows="6" style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: border 0.3s; resize: vertical;" placeholder="Tulis pesan Anda di sini..."></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem;">
                <i class="fas fa-paper-plane"></i> Kirim Pesan
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
                <p>@RSHPUnair</p>
                <a href="#" class="btn btn-secondary" style="margin-top: 1rem;">Kunjungi</a>
            </div>
            <div class="card" style="text-align: center;">
                <div class="card-icon">
                    <i class="fab fa-instagram" style="color: #e4405f;"></i>
                </div>
                <h3>Instagram</h3>
                <p>@rshp_unair</p>
                <a href="#" class="btn btn-secondary" style="margin-top: 1rem;">Kunjungi</a>
            </div>
            <div class="card" style="text-align: center;">
                <div class="card-icon">
                    <i class="fab fa-twitter" style="color: #1da1f2;"></i>
                </div>
                <h3>Twitter</h3>
                <p>@RSHPUnair</p>
                <a href="#" class="btn btn-secondary" style="margin-top: 1rem;">Kunjungi</a>
            </div>
            <div class="card" style="text-align: center;">
                <div class="card-icon">
                    <i class="fab fa-youtube" style="color: #ff0000;"></i>
                </div>
                <h3>YouTube</h3>
                <p>RSHP Unair Official</p>
                <a href="#" class="btn btn-secondary" style="margin-top: 1rem;">Kunjungi</a>
            </div>
        </div>
    </div>

    <!-- Emergency Contact -->
    <div class="content-section" style="background: #ff6b6b; color: white; text-align: center;">
        <h2 style="color: white;"><i class="fas fa-exclamation-triangle"></i> Kondisi Darurat?</h2>
        <p style="font-size: 1.2rem; margin-bottom: 1rem;">Segera hubungi layanan gawat darurat kami</p>
        <a href="tel:0315999111" class="btn btn-primary" style="background: white; color: #ff6b6b; font-size: 1.3rem; padding: 1rem 3rem;">
            <i class="fas fa-phone-alt"></i> (031) 5999111
        </a>
    </div>
</div>

<style>
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }
</style>
@endsection