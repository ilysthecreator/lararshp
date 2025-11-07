@extends('admin.layout')

@section('title', 'Daftar Pet')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pet</h1>
        {{-- <a href="{{ route('admin.pet.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Pet</span>
        </a> --}}
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>ID</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Jenis Hewan</th>
                            <th>Ras</th>
                            <th>Jenis Kelamin</th>
                            <th>Tgl Lahir</th>
                            <th>Warna</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item->idpet }}</td>
                            <td><strong>{{ $item->nama_pet }}</strong></td>
                            <td>{{ $item->pemilik->user->nama ?? '-' }}</td>
                            <td>{{ $item->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                            <td>{{ $item->rasHewan->nama_ras ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</td>
                            <td>{{ $item->tgl_lahir ? \Carbon\Carbon::parse($item->tgl_lahir)->format('d M Y') : '-' }}</td>
                            <td>{{ $item->warna_bulu ?? '-' }}</td>
                            <td class="text-center">
                                {{-- <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $item->idpet }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.pet.destroy', $item->idpet) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form> --}}
                                -
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data pet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "pageLength": 10,
        "ordering": true,
        "searching": true
    });
});
</script>
@endpush