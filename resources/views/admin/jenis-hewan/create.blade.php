@extends('admin.layout')
@section('title', 'Tambah Jenis Hewan')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jenis Hewan</h1>
        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Jenis Hewan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_jenis_hewan">Nama Jenis Hewan <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                           id="nama_jenis_hewan" 
                           name="nama_jenis_hewan" 
                           value="{{ old('nama_jenis_hewan') }}" 
                           placeholder="Contoh: Anjing (Canis lupus familiaris)"
                           required>
                    @error('nama_jenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Masukkan nama jenis hewan beserta nama ilmiahnya (opsional)
                    </small>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection