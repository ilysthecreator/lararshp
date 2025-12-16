@extends('pemilik.layout')
@section('title', 'Jadwal Temu Dokter')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal & Jam</th>
                        <th>Hewan</th>
                        <th>Dokter</th>
                        <th>No Urut</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $j)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($j->waktu_daftar)->isoFormat('D MMMM Y, HH:mm') }}</td>
                        <td>
                            <strong>{{ $j->pet->nama }}</strong><br>
                            <small class="text-muted">{{ $j->pet->rasHewan->nama_ras ?? '' }}</small>
                        </td>
                        <td>{{ $j->dokterRoleUser->user->nama ?? 'Dokter Umum' }}</td>
                        <td class="text-center fw-bold fs-5">#{{ $j->no_urut }}</td>
                        <td>
                            @if($j->status == '1') <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($j->status == '2') <span class="badge bg-success">Selesai</span>
                            @else <span class="badge bg-secondary">Batal</span> @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4">Tidak ada riwayat jadwal.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $jadwal->links() }}
    </div>
</div>
@endsection