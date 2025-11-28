@extends('dokter.layout')

@section('title', 'Data Rekam Medis')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rekam Medis</h1>
        <a href="{{ route('dokter.rekam-medis.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Rekam Medis
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Rekam Medis</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Periksa</th>
                            <th>Nama Pasien</th>
                            <th>Pemilik</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rekamMedis as $rm)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($rm->tgl_periksa)->format('d M Y') }}</td>
                                <td>{{ $rm->pet->nama_pet ?? 'N/A' }}</td>
                                <td>{{ $rm->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                <td>{{ $rm->diagnosa }}</td>
                                <td>
                                    <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dokter.rekam-medis.edit', $rm->idrekam_medis) }}" class="btn btn-warning btn-sm" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dokter.rekam-medis.destroy', $rm->idrekam_medis) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data rekam medis ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data rekam medis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $rekamMedis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection