@extends('admin.layout')

@section('title', 'Daftar Pet')
@section('page-title', 'Daftar Pet')

@section('content')
<div class="card">
    <div class="card-header">
        <h4><i class="fas fa-cat"></i> Daftar Pet</h4>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Pet</th>
                    <th>Pemilik</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Warna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td><strong>{{ $item->nama_pet }}</strong></td>
                    <td>{{ $item->pemilik->nama_pemilik ?? '-' }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.75rem; background: #e7f3ff; color: #0066cc; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">
                            {{ $item->jenisHewan->nama_jenis ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $item->rasHewan->nama_ras ?? '-' }}</td>
                    <td>
                        @if($item->jenis_kelamin == 'Jantan')
                            <span style="padding: 0.25rem 0.75rem; background: #d1ecf1; color: #0c5460; border-radius: 12px; font-size: 0.85rem;">
                                <i class="fas fa-mars"></i> Jantan
                            </span>
                        @elseif($item->jenis_kelamin == 'Betina')
                            <span style="padding: 0.25rem 0.75rem; background: #f8d7da; color: #721c24; border-radius: 12px; font-size: 0.85rem;">
                                <i class="fas fa-venus"></i> Betina
                            </span>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') : '-' }}</td>
                    <td>{{ $item->warna ?? '-' }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-sm" style="background: var(--danger-color); color: white;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 2rem; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        <p>Belum ada data pet</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection