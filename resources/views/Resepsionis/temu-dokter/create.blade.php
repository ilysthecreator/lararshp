@extends('resepsionis.layout')

@section('title', 'Buat Janji Temu Baru')

@section('content')
<div class="card shadow-sm border-0 col-lg-10 mx-auto">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 fw-bold text-primary"><i class="fas fa-plus me-2"></i>Formulir Janji Temu</h6>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
            @csrf
            
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="idpet" class="form-label fw-semibold">Pilih Hewan <span class="text-danger">*</span></label>
                    <select name="idpet" id="idpet" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Hewan --</option>
                        @foreach($pets as $pet)
                            <option value="{{ $pet->idpet }}">
                                {{ $pet->nama }} (Pemilik: {{ $pet->pemilik->user->nama ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="idrole_user" class="form-label fw-semibold">Pilih Dokter <span class="text-danger">*</span></label>
                    <select name="idrole_user" id="idrole_user" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Dokter --</option>
                        @foreach($dokters as $roleUser)
                            <option value="{{ $roleUser->idrole_user }}">
                                {{ $roleUser->user->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="tgl_temu" class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tgl_temu" id="tgl_temu" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="jam_temu" class="form-label fw-semibold">Jam</label>
                    <input type="time" name="jam_temu" id="jam_temu" class="form-control" required>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection