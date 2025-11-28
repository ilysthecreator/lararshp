@extends('dokter.layout')

@section('title', 'Data Pasien')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pasien Baru
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Pasien</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Pemilik</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasien as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->idpet }}</td>
                                <td>{{ $p->nama_pet }}</td>
                                {{-- Mengakses nama pemilik melalui relasi --}}
                                <td>{{ $p->pemilik->user->nama ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tgl_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-sm" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data pasien.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
{{-- Jika Anda menggunakan DataTables, Anda bisa menambahkan CSS-nya di sini --}}
{{-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@endpush

@push('scripts')
{{-- Jika Anda menggunakan DataTables, Anda bisa menambahkan JS-nya di sini --}}
{{-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> --}}
{{-- <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> --}}
{{-- <script> $(document).ready(function() { $('#dataTable').DataTable(); }); </script> --}}
@endpush