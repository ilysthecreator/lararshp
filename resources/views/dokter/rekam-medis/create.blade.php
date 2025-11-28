@extends('dokter.layout')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Rekam Medis Baru</h1>
        <a href="{{ route('dokter.rekam-medis.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('dokter.rekam-medis.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri: Data Utama -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="idpet">Pilih Pasien <span class="text-danger">*</span></label>
                            <select class="form-control" id="idpet" name="idpet" required>
                                <option value="">-- Pilih Pasien --</option>
                                @foreach ($pasien as $p)
                                    <option value="{{ $p->idpet }}" {{ old('idpet') == $p->idpet ? 'selected' : '' }}>
                                        {{ $p->nama_pet }} (Pemilik: {{ $p->pemilik->user->nama ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal Periksa <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa" value="{{ old('tgl_periksa', date('Y-m-d')) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="anamnesa">Anamnesa <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="anamnesa" name="anamnesa" rows="4" required>{{ old('anamnesa') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="diagnosa">Diagnosa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ old('diagnosa') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Tambahan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Detail Tindakan -->
                    <div class="col-md-6">
                        <h5>Detail Tindakan & Terapi <span class="text-danger">*</span></h5>
                        <div id="tindakan-repeater">
                            <div class="tindakan-item mb-3 border p-3">
                                <div class="form-group">
                                    <label>Tindakan/Terapi</label>
                                    <select class="form-control" name="tindakan[0][id]" required>
                                        <option value="">-- Pilih Tindakan --</option>
                                        @foreach ($tindakan as $t)
                                            <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->deskripsi_tindakan_terapi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="tindakan[0][jumlah]" value="1" min="1" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Keterangan</label>
                                        <input type="text" class="form-control" name="tindakan[0][keterangan]">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-tindakan" style="display: none;">Hapus</button>
                            </div>
                        </div>
                        <button type="button" id="add-tindakan" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Tindakan</button>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50"></i> Simpan Rekam Medis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let tindakanIndex = 1;
    const repeater = document.getElementById('tindakan-repeater');
    const addButton = document.getElementById('add-tindakan');

    // Fungsi untuk mengelola tombol hapus
    function manageRemoveButtons() {
        const items = repeater.querySelectorAll('.tindakan-item');
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-tindakan');
            if (items.length > 1) {
                removeBtn.style.display = 'inline-block';
            } else {
                removeBtn.style.display = 'none';
            }
        });
    }

    addButton.addEventListener('click', function () {
        const firstItem = repeater.querySelector('.tindakan-item');
        const newItem = firstItem.cloneNode(true);

        // Reset nilai input pada item baru
        newItem.querySelector('select').name = `tindakan[${tindakanIndex}][id]`;
        newItem.querySelector('input[type="number"]').name = `tindakan[${tindakanIndex}][jumlah]`;
        newItem.querySelector('input[type="text"]').name = `tindakan[${tindakanIndex}][keterangan]`;
        newItem.querySelector('select').value = '';
        newItem.querySelector('input[type="number"]').value = '1';
        newItem.querySelector('input[type="text"]').value = '';

        repeater.appendChild(newItem);
        tindakanIndex++;
        manageRemoveButtons();
    });

    repeater.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-tindakan')) {
            e.target.closest('.tindakan-item').remove();
            manageRemoveButtons();
        }
    });

    // Panggil saat load untuk memastikan tombol hapus disembunyikan jika hanya ada 1 item
    manageRemoveButtons();
});
</script>
@endpush