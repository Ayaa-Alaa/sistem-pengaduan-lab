@extends('layouts.mahasiswa')
@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Dashboard Mahasiswa</h4>
    <a href="{{ route('keluhan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Buat Keluhan Baru
    </a>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h2 class="fw-bold text-primary">{{ $keluhans->total() }}</h2>
            <small class="text-muted">Total Keluhan</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h2 class="fw-bold text-warning">{{ $keluhans->where('status','pending')->count() }}</h2>
            <small class="text-muted">Pending</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h2 class="fw-bold text-info">{{ $keluhans->where('status','diproses')->count() }}</h2>
            <small class="text-muted">Diproses</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h2 class="fw-bold text-success">{{ $keluhans->where('status','selesai')->count() }}</h2>
            <small class="text-muted">Selesai</small>
        </div>
    </div>
</div>

<!-- Tabel Keluhan -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-bold">Riwayat Keluhan Saya</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keluhans as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->judul }}</td>
                    <td><span class="badge bg-secondary">{{ $k->kategori }}</span></td>
                    <td>
                        @if($k->prioritas == 'tinggi')
                            <span class="badge bg-danger">Tinggi</span>
                        @elseif($k->prioritas == 'sedang')
                            <span class="badge bg-warning text-dark">Sedang</span>
                        @else
                            <span class="badge bg-success">Rendah</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $k->status }}">
                            {{ ucfirst($k->status) }}
                        </span>
                    </td>
                    <td>{{ $k->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('keluhan.show', $k->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Belum ada keluhan. <a href="{{ route('keluhan.create') }}">Buat keluhan pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $keluhans->links() }}
    </div>
</div>
@endsection