@extends('admin.layout')

@section('title', 'Tambah Kode Tindakan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kode Tindakan</h1>
        <a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Kode Tindakan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kode-tindakan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode">Kode Tindakan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode') }}" placeholder="Contoh: VAK-01" required>
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="idkategori">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control @error('idkategori') is-invalid @enderror" id="idkategori" name="idkategori" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->idkategori }}" {{ old('idkategori') == $item->idkategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="idkategori_klinis">Kategori Klinis <span class="text-danger">*</span></label>
                    <select class="form-control @error('idkategori_klinis') is-invalid @enderror" id="idkategori_klinis" name="idkategori_klinis" required>
                        <option value="" disabled selected>-- Pilih Kategori Klinis --</option>
                        @foreach($kategoriKlinis as $item)
                            <option value="{{ $item->idkategori_klinis }}" {{ old('idkategori_klinis') == $item->idkategori_klinis ? 'selected' : '' }}>
                                {{ $item->nama_kategori_klinis }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi_tindakan_terapi">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" rows="3" required>{{ old('deskripsi_tindakan_terapi') }}</textarea>
                    @error('deskripsi_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data</button>
            </form>
        </div>
    </div>
</div>
@endsection