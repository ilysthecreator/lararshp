@extends('layouts.app')

@section('title', 'Manajemen Janji Temu Dokter')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Janji Temu Dokter</h1>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Janji Temu Baru
        </a>
    </div>

    <!-- Display Success Message -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Janji Temu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal & Waktu</th>
                            <th>Nama Hewan</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($temuDokter as $index => $temu)
                        <tr>
                            <td>{{ $temuDokter->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($temu->tgl_temu)->isoFormat('D MMMM YYYY') }}, {{ $temu->jam_temu }}</td>
                            <td>{{ $temu->pet->nama_pet ?? 'N/A' }}</td>
                            <td>{{ $temu->pet->pemilik->user->nama ?? 'N/A' }}</td>
                            <td>drh. {{ $temu->dokter->user->nama ?? 'N/A' }}</td>
                            <td>
                                @if($temu->status == 'Dijadwalkan')
                                    <span class="badge badge-info">{{ $temu->status }}</span>
                                @elseif($temu->status == 'Selesai')
                                    <span class="badge badge-success">{{ $temu->status }}</span>
                                @elseif($temu->status == 'Dibatalkan')
                                    <span class="badge badge-danger">{{ $temu->status }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ $temu->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('resepsionis.temu-dokter.edit', $temu->idtemu_dokter) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('resepsionis.temu-dokter.destroy', $temu->idtemu_dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data janji temu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $temuDokter->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk menutup alert secara otomatis setelah beberapa detik
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 3000);
</script>
@endpush