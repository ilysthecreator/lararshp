@extends('admin.layout')

@section('title', 'Tambah Kategori Klinis')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Klinis</h1>
        <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Kategori Klinis</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_kategori_klinis">Nama Kategori Klinis <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama_kategori_klinis') is-invalid @enderror" 
                           id="nama_kategori_klinis" 
                           name="nama_kategori_klinis" 
                           value="{{ old('nama_kategori_klinis') }}" 
                           placeholder="Contoh: Pemeriksaan Fisik"
                           required>
                    @error('nama_kategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data</button>
            </form>
        </div>
    </div>
</div>
@endsection