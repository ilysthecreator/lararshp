@extends('perawat.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Dashboard Perawat</div>

                <div class="card-body">
                    <h5>Selamat Datang, {{ Auth::user()->name }}</h5>
                    <p class="text-muted">Anda login sebagai Perawat. Silakan pilih menu di bawah ini:</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center border-primary h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Data Pasien</h5>
                                    <p class="card-text">Lihat daftar pasien dan detail hewan.</p>
                                    <a href="{{ route('perawat.pasien.index') }}" class="btn btn-primary">Lihat Pasien</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center border-success h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Rekam Medis</h5>
                                    <p class="card-text">Buat, edit, dan kelola rekam medis pasien.</p>
                                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-success">Kelola Rekam Medis</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center border-info h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Profil Saya</h5>
                                    <p class="card-text">Lihat informasi akun Anda.</p>
                                    <a href="{{ route('perawat.profile.show') }}" class="btn btn-info text-white">Lihat Profil</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection