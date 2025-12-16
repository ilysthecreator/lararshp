@extends('dokter.layout')

@section('title', 'Profil Saya')

@section('content')
<div class="row">
    <!-- Card Foto & Info Singkat -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow" style="width: 120px; height: 120px; font-size: 3rem; font-weight: bold;">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                </div>
                <h5 class="fw-bold text-dark">{{ $user->nama }}</h5>
                <p class="text-muted mb-1 badge badge-info px-3 py-2">{{ $user->dokter->spesialisasi ?? 'Dokter' }}</p>
                <p class="text-muted small"><i class="fas fa-envelope mr-1"></i> {{ $user->email }}</p>
            </div>
        </div>
    </div>

    <!-- Form Edit Profil -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-edit mr-2"></i>Edit Informasi Profil</h6>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('dokter.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="spesialisasi" class="col-sm-3 col-form-label">Spesialisasi</label>
                        <div class="col-sm-9">
                            <input type="text" name="spesialisasi" id="spesialisasi" class="form-control @error('spesialisasi') is-invalid @enderror" value="{{ old('spesialisasi', $user->dokter->spesialisasi ?? '') }}" required>
                            @error('spesialisasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_telepon" class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_telepon" id="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon', $user->dokter->no_telepon ?? '') }}" required>
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_lisensi" class="col-sm-3 col-form-label">No. Lisensi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control bg-light" value="{{ $user->dokter->no_lisensi ?? '-' }}" readonly>
                            <small class="text-muted">Nomor lisensi tidak dapat diubah secara mandiri.</small>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h6 class="mb-3 text-muted font-weight-bold">Ubah Password</h6>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection