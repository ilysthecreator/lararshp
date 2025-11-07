@extends('site.layout')

@section('title', 'Login')

@section('content')
<div class="hero" style="padding: 3rem 2rem;">
    <div class="hero-content">
        <h1>Portal Login</h1>
        <p>Akses untuk Pasien, Dokter, dan Staff</p>
    </div>
</div>

<div class="container" style="padding: 3rem 2rem;">
    <div style="max-width: 500px; margin: 0 auto;">
        <!-- Login Card -->
        <div class="content-section" style="padding: 3rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fas fa-user-circle" style="font-size: 3rem; color: white;"></i>
                </div>
                <h2 style="margin-bottom: 0.5rem;">Selamat Datang</h2>
                <p style="color: #666;">Silakan login untuk melanjutkan</p>
            </div>

            @if(session('success'))
            <div style="padding: 1rem; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #c3e6cb;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div style="padding: 1rem; background: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #f5c6cb;">
                <i class="fas fa-exclamation-circle"></i> 
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Username/Email -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input 
                        type="email" 
                        name="email"
                        value="{{ old('email') }}"
                        required 
                        style="width: 100%; padding: 0.875rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: all 0.3s;"
                        placeholder="admin@mail.com"
                    >
                </div>

                <!-- Password -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div style="position: relative;">
                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            required 
                            style="width: 100%; padding: 0.875rem; padding-right: 3rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: all 0.3s;"
                            placeholder="Masukkan password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #999; cursor: pointer; font-size: 1.1rem;"
                        >
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="remember" style="width: 18px; height: 18px; cursor: pointer;">
                        <span style="font-size: 0.95rem; color: #666;">Ingat Saya</span>
                    </label>
                    <a href="#" style="color: var(--primary-color); text-decoration: none; font-size: 0.95rem; font-weight: 500;">
                        Lupa Password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 600;">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

        <!-- Portal Access Info -->
        <div style="margin-top: 2rem;">
            <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
                <div class="card" style="text-align: center; padding: 1.5rem;">
                    <div style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 0.5rem;">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <h4 style="font-size: 0.95rem; margin: 0;">Portal Pasien</h4>
                </div>
                <div class="card" style="text-align: center; padding: 1.5rem;">
                    <div style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 0.5rem;">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h4 style="font-size: 0.95rem; margin: 0;">Portal Dokter</h4>
                </div>
                <div class="card" style="text-align: center; padding: 1.5rem;">
                    <div style="font-size: 2.5rem; color: #28a745; margin-bottom: 0.5rem;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 style="font-size: 0.95rem; margin: 0;">Portal Staff</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Section -->
    <div style="max-width: 800px; margin: 3rem auto;">
        <div class="content-section" style="background: #f8f9fa; text-align: center;">
            <h3 style="margin-bottom: 1rem;"><i class="fas fa-question-circle"></i> Butuh Bantuan?</h3>
            <p style="color: #666; margin-bottom: 1.5rem;">Hubungi customer service kami untuk bantuan login atau masalah teknis lainnya</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:0315999000" class="btn btn-primary">
                    <i class="fas fa-phone"></i> (031) 5999000
                </a>
                <a href="mailto:support@rshp.unair.ac.id" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> support@rshp.unair.ac.id
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    input:focus {
        outline: none;
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }
    
    input[type="checkbox"]:focus {
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.2);
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