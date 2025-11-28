@extends('admin.layout')

@section('title', 'Tambah Data Pet')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Pet</h1>
        <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Data Pet</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pet.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="idpemilik">Pemilik <span class="text-danger">*</span></label>
                    <select class="form-control @error('idpemilik') is-invalid @enderror" id="idpemilik" name="idpemilik" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach($pemilik as $item)
                            <option value="{{ $item->idpemilik }}" {{ old('idpemilik') == $item->idpemilik ? 'selected' : '' }}>
                                {{ $item->user->nama ?? 'N/A' }} ({{ $item->user->email ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                    @error('idpemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="idras_hewan">Ras Hewan <span class="text-danger">*</span></label>
                    <select class="form-control @error('idras_hewan') is-invalid @enderror" id="idras_hewan" name="idras_hewan" required>
                        <option value="">-- Pilih Ras Hewan --</option>
                        @foreach($rasHewan as $item)
                            <option value="{{ $item->idras_hewan }}" {{ old('idras_hewan') == $item->idras_hewan ? 'selected' : '' }}>
                                {{ $item->nama_ras }} ({{ $item->jenisHewan->nama_jenis_hewan }})
                            </option>
                        @endforeach
                    </select>
                    @error('idras_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_pet">Nama Pet <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_pet') is-invalid @enderror" id="nama_pet" name="nama_pet" value="{{ old('nama_pet') }}" required>
                    @error('nama_pet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jantan" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="jantan">Jantan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="betina" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="betina">Betina</label>
                        </div>
                    </div>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                    @error('tgl_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="warna_bulu">Warna / Tanda</label>
                    <input type="text" class="form-control @error('warna_bulu') is-invalid @enderror" id="warna_bulu" name="warna_bulu" value="{{ old('warna_bulu') }}">
                    @error('warna_bulu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
