@extends('dokter.layout')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Rekam Medis</h1>
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
            <form action="{{ route('dokter.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="idpet">Pilih Pasien <span class="text-danger">*</span></label>
                            <select class="form-control" id="idpet" name="idpet" required>
                                <option value="">-- Pilih Pasien --</option>
                                @foreach ($pasien as $p)
                                    <option value="{{ $p->idpet }}" {{ (old('idpet', $rekamMedis->idpet) == $p->idpet) ? 'selected' : '' }}>
                                        {{ $p->nama_pet }} (Pemilik: {{ $p->pemilik->user->nama ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal Periksa <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa" value="{{ old('tgl_periksa', $rekamMedis->tgl_periksa) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="anamnesa">Anamnesa <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="anamnesa" name="anamnesa" rows="4" required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="diagnosa">Diagnosa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ old('diagnosa', $rekamMedis->diagnosa) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Tambahan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $rekamMedis->keterangan) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Detail Tindakan & Terapi <span class="text-danger">*</span></h5>
                        <div id="tindakan-repeater">
                            @php
                                // Prioritaskan old input, jika tidak ada, gunakan data dari database
                                $detailItems = old('tindakan', $rekamMedis->detailRekamMedis->map(function ($detail) {
                                    return [
                                        'detail_id' => $detail->iddetail_rekam_medis,
                                        'id' => $detail->idkode_tindakan_terapi,
                                        'jumlah' => $detail->jumlah,
                                        'keterangan' => $detail->keterangan,
                                    ];
                                })->toArray());
                            @endphp

                            @forelse ($detailItems as $index => $detail)
                            <div class="tindakan-item mb-3 border p-3">
                                <input type="hidden" name="tindakan[{{ $index }}][detail_id]" value="{{ $detail['detail_id'] ?? '' }}">
                                <div class="form-group">
                                    <label>Tindakan/Terapi</label>
                                    <select class="form-control" name="tindakan[{{ $index }}][id]" required>
                                        <option value="">-- Pilih Tindakan --</option>
                                        @foreach ($tindakan as $t)
                                            <option value="{{ $t->idkode_tindakan_terapi }}" {{ ($detail['id'] ?? '') == $t->idkode_tindakan_terapi ? 'selected' : '' }}>
                                                {{ $t->deskripsi_tindakan_terapi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="tindakan[{{ $index }}][jumlah]" 
                                               value="{{ $detail['jumlah'] ?? 1 }}" min="1" required>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label>Keterangan</label>
                                        <input type="text" class="form-control" name="tindakan[{{ $index }}][keterangan]" 
                                               value="{{ $detail['keterangan'] ?? '' }}">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-tindakan">Hapus</button>
                            </div>
                            @empty
                                {{-- Blok ini akan ditampilkan jika tidak ada data sama sekali, sebagai fallback --}}
                                <div class="tindakan-item mb-3 border p-3">
                                    <input type="hidden" name="tindakan[0][detail_id]" value="">
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
                                        <div class="form-group col-md-5">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control" name="tindakan[0][jumlah]" value="1" min="1" required>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" name="tindakan[0][keterangan]">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm remove-tindakan">Hapus</button>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" id="add-tindakan" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Tindakan</button>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50"></i> Update Rekam Medis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="template-tindakan" style="display: none;">
    <div class="tindakan-item mb-3 border p-3">
        <input type="hidden" name="tindakan[INDEX][detail_id]" value="">
        <div class="form-group">
            <label>Tindakan/Terapi</label>
            <select class="form-control" name="tindakan[INDEX][id]" required>
                <option value="">-- Pilih Tindakan --</option>
                @foreach ($tindakan as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->deskripsi_tindakan_terapi }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="tindakan[INDEX][jumlah]" value="1" min="1" required>
            </div>
            <div class="form-group col-md-7">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="tindakan[INDEX][keterangan]">
            </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm remove-tindakan">Hapus</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const repeater = document.getElementById('tindakan-repeater');
    const addButton = document.getElementById('add-tindakan');
    const template = document.getElementById('template-tindakan').innerHTML;
    let tindakanIndex = repeater.getElementsByClassName('tindakan-item').length;

    function manageRemoveButtons() {
        const items = repeater.querySelectorAll('.tindakan-item');
        items.forEach(item => {
            const removeBtn = item.querySelector('.remove-tindakan');
            if (items.length > 1) {
                removeBtn.style.display = 'inline-block';
            } else {
                removeBtn.style.display = 'none'; // Jangan biarkan menghapus item terakhir
            }
        });
    }

    addButton.addEventListener('click', function () {
        // Clone dari template bersih
        const newItem = template.cloneNode(true);
        
        // Ganti placeholder INDEX dengan angka index saat ini
        newItem.innerHTML = newItem.innerHTML.replace(/INDEX/g, tindakanIndex);

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

    manageRemoveButtons();
});
</script>
@endpush