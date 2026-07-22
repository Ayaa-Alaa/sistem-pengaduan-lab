@extends('layouts.mahasiswa')
@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->name }}! 👋</h5>
        <p class="text-muted mb-0 small">Berikut ringkasan keluhan kamu</p>
    </div>
    <a href="{{ route('keluhan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Buat Keluhan
    </a>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-3 text-center" style="border-left: 4px solid #0d6efd !important">
            <h3 class="fw-bold text-primary">{{ $keluhans->total() }}</h3>
            <small class="text-muted">Total Keluhan</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 text-center" style="border-left: 4px solid #ffc107 !important">
            <h3 class="fw-bold text-warning">{{ $keluhans->where('status','pending')->count() }}</h3>
            <small class="text-muted">Pending</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 text-center" style="border-left: 4px solid #0dcaf0 !important">
            <h3 class="fw-bold text-info">{{ $keluhans->where('status','diproses')->count() }}</h3>
            <small class="text-muted">Diproses</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 text-center" style="border-left: 4px solid #198754 !important">
            <h3 class="fw-bold text-success">{{ $keluhans->where('status','selesai')->count() }}</h3>
            <small class="text-muted">Selesai</small>
        </div>
    </div>
</div>

<!-- Tabel -->
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-list-ul me-2"></i>Riwayat Keluhan Saya</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">#</th>
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
                    <td class="ps-3">{{ $loop->iteration }}</td>
                    <td>{{ $k->judul }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($k->kategori) }}</span></td>
                    <td>
                        @if($k->prioritas == 'tinggi')
                            <span class="badge bg-danger">🔴 Tinggi</span>
                        @elseif($k->prioritas == 'sedang')
                            <span class="badge bg-warning text-dark">🟡 Sedang</span>
                        @else
                            <span class="badge bg-success">🟢 Rendah</span>
                        @endif
                    </td>
                    <td><span class="badge badge-{{ $k->status }}">{{ ucfirst($k->status) }}</span></td>
                    <td>{{ $k->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('keluhan.show', $k->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Belum ada keluhan. <a href="{{ route('keluhan.create') }}">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $keluhans->links() }}</div>
</div>
@endsection