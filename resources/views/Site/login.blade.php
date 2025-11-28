@extends('site.layout')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <!-- Kolom Kiri (Branding) -->
    <div class="login-branding">
        <div class="login-branding-content">
            <a href="{{ route('home') }}" class="logo" style="color: white; margin-bottom: 24px;">
                <i class="fas fa-hospital"></i>
                <span>RSHP UNAIR</span>
            </a>
            <h1 style="font-size: 32px; font-weight: 700; margin-bottom: 16px; letter-spacing: -0.5px;">Pelayanan Kesehatan Terdepan</h1>
            <p style="font-size: 16px; opacity: 0.8; line-height: 1.7;">Mengintegrasikan pendidikan, penelitian, dan pelayanan medis berkualitas untuk memberikan pengalaman terbaik bagi pasien.</p>
            <div style="margin-top: 32px; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 32px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="https://via.placeholder.com/50" alt="Avatar" style="border-radius: 50%; border: 2px solid white;">
                    <div>
                        <p style="font-weight: 600; margin: 0;">"Pelayanan cepat dan profesional."</p>
                        <p style="opacity: 0.8; font-size: 14px; margin: 0;">- Budi, Pasien</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan (Form Login) -->
    <div class="login-form-wrapper">
        <!-- Login Card -->
        <div class="login-card">
            <div style="text-align: center; margin-bottom: 24px;">
                <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 8px;">Portal Login</h1>
                <p style="color: var(--text-secondary); font-size: 15px;">Selamat datang kembali, silakan login.</p>
            </div>

            @if(session('success'))
            <div style="padding: 16px; background: #f0fdf4; color: #166534; border-radius: 8px; margin-bottom: 24px; border: 1px solid #bbf7d0; font-size: 14px;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div style="padding: 16px; background: #fef2f2; color: #991b1b; border-radius: 8px; margin-bottom: 24px; border: 1px solid #fecaca; font-size: 14px;">
                <i class="fas fa-exclamation-circle"></i> 
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); font-size: 14px;">
                        Email
                    </label>
                    <input 
                        type="email" 
                        name="email"
                        value="{{ old('email') }}"
                        required 
                        style="width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                        placeholder="nama@email.com"
                    >
                </div>

                <!-- Password -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); font-size: 14px;">
                        Password
                    </label>
                    <div style="position: relative;">
                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            required 
                            style="width: 100%; padding: 12px 16px; padding-right: 48px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                            placeholder="Masukkan password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-secondary); cursor: pointer; font-size: 16px; padding: 0;"
                        >
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="remember" style="width: 16px; height: 16px; cursor: pointer; accent-color: var(--primary);">
                        <span style="font-size: 14px; color: var(--text-secondary);">Ingat Saya</span>
                    </label>
                    <a href="#" style="color: var(--primary); text-decoration: none; font-size: 14px; font-weight: 500;">
                        Lupa Password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-size: 15px; font-weight: 500;">
                    Login
                </button>

                <div style="text-align: center; margin-top: 24px;">
                    <p style="font-size: 14px; color: var(--text-secondary);">Belum punya akun? <a href="#" style="color: var(--primary); font-weight: 500; text-decoration: none;">Daftar Sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    body {
        background: var(--surface);
    }
    .navbar, .footer {
        display: none; /* Sembunyikan navbar dan footer di halaman login */
    }
    .login-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 100vh;
    }
    .login-branding {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px;
    }
    .login-branding-content {
        max-width: 450px;
    }
    .login-form-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px;
        background: var(--background);
    }
    .login-card {
        width: 100%;
        max-width: 400px;
    }
    @media (max-width: 992px) {
        .login-container {
            grid-template-columns: 1fr;
        }
        .login-branding { display: none; }
    }
    input:focus {
        outline: none;
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    input[type="checkbox"]:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }
</style>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection