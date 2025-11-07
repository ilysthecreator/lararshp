@extends('layouts.app')

@section('title', 'Dashboard Pemilik')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-paw mr-2"></i>
                Data Hewan Peliharaan Saya
            </h3>
        </div>
        <div class="card-body">
            <p>Berikut adalah daftar hewan peliharaan Anda yang terdaftar di RSHP UNAIR.</p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Pet</th>
                            <th>Nama Hewan</th>
                            <th>Jenis Hewan</th>
                            <th>Ras</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pets as $pet)
                            <tr>
                                <td>{{ $pet->idpet }}</td>
                                <td>{{ $pet->nama_pet }}</td>
                                <td>{{ $pet->jenisHewan->nama_jenis ?? 'N/A' }}</td>
                                <td>{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pet->tgl_lahir)->format('d F Y') }}</td>
                                <td>{{ $pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Anda belum memiliki data hewan peliharaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection