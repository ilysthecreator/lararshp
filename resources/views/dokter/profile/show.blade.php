@extends('dokter.layout')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil Saya</h1>
    </div>

    <!-- Session Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Spesialisasi -->
                        <div class="form-group">
                            <label for="spesialisasi">Spesialisasi</label>
                            <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" value="{{ old('spesialisasi', $user->dokter->spesialisasi ?? '') }}" required>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="form-group">
                            <label for="no_telepon">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->dokter->no_telepon ?? '') }}" required>
                        </div>

                        <hr>

                        <h6 class="font-weight-bold">Ubah Password (Opsional)</h6>
                        <p class="text-muted small">Kosongkan jika Anda tidak ingin mengubah password.</p>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save fa-sm"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-3" src="{{ asset('assets/img/undraw_profile.svg') }}" alt="Foto Profil" style="width: 120px; height: 120px;">
                    <h5 class="font-weight-bold">{{ $user->nama }}</h5>
                    <p class="text-muted">{{ $user->dokter->spesialisasi ?? 'Spesialisasi Belum Diatur' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection