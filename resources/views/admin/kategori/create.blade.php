@extends('admin.layout')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kategori</h1>
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Kategori</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama_kategori') is-invalid @enderror" 
                           id="nama_kategori" 
                           name="nama_kategori" 
                           value="{{ old('nama_kategori') }}" 
                           placeholder="Contoh: Obat, Vaksin, Pakan"
                           required>
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data</button>
            </form>
        </div>
    </div>
</div>
@endsection