@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left:4px solid #0d6efd !important">
            <h3 class="fw-bold text-primary">{{ $stats['total'] }}</h3>
            <small class="text-muted">Total Keluhan</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left:4px solid #ffc107 !important">
            <h3 class="fw-bold text-warning">{{ $stats['pending'] }}</h3>
            <small class="text-muted">Pending</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left:4px solid #0dcaf0 !important">
            <h3 class="fw-bold text-info">{{ $stats['diproses'] }}</h3>
            <small class="text-muted">Diproses</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left:4px solid #198754 !important">
            <h3 class="fw-bold text-success">{{ $stats['selesai'] }}</h3>
            <small class="text-muted">Selesai</small>
        </div>
    </div>
</div>

<!-- Keluhan Terbaru -->
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Keluhan Terbaru</h6>
        <a href="{{ route('admin.keluhan') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Mahasiswa</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keluhans as $k)
                <tr>
                    <td class="ps-3">{{ $k->user->name }}</td>
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
                    <td>
                        <a href="{{ route('admin.keluhan.detail', $k->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada keluhan masuk</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection