@extends('perawat.layout')

@section('title', 'Profil Saya')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header text-center bg-dark text-white">
                <h4>Profil Saya</h4>
            </div>
            <div class="card-body text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=random" class="rounded-circle mb-3" width="100" alt="Avatar">
                
                <h3 class="mb-0">{{ $user->nama }}</h3>
                <p class="text-muted">Perawat</p>

                <hr>
                <div class="text-start"> {{-- Ubah text-left jadi text-start untuk Bootstrap 5 --}}
                    <div class="mb-3">
                        <label class="fw-bold">Email</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ $user->nama }}" readonly>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('perawat.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection