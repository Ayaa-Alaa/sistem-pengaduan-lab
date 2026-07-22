@extends('layouts.admin')
@section('title', 'Laporan Keluhan')

@section('content')
<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Bulan</label>
                <select name="bulan" class="form-select form-select-sm">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1,12) as $b)
                        <option value="{{ $b }}" {{ request('bulan')==$b?'selected':'' }}>
                            {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Tahun</label>
                <select name="tahun" class="form-select form-select-sm">
                    @foreach(range(date('Y'), date('Y')-3) as $t)
                        <option value="{{ $t }}" {{ request('tahun')==$t?'selected':'' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-search me-1"></i> Filter
                </button>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.laporan.pdf', request()->query()) }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-file-pdf me-1"></i> Export PDF
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h3 class="fw-bold text-primary">{{ $stats['total'] }}</h3>
            <small class="text-muted">Total</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h3 class="fw-bold text-success">{{ $stats['selesai'] }}</h3>
            <small class="text-muted">Selesai</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h3 class="fw-bold text-warning">{{ $stats['pending'] }}</h3>
            <small class="text-muted">Pending</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h3 class="fw-bold text-danger">{{ $stats['ditolak'] }}</h3>
            <small class="text-muted">Ditolak</small>
        </div>
    </div>
</div>

<!-- Tabel -->
<div class="card">
    <div class="card-header bg-white py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-table me-2"></i>Data Keluhan</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">#</th>
                    <th>Mahasiswa</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keluhans as $i => $k)
                <tr>
                    <td class="ps-3">{{ $i+1 }}</td>
                    <td>{{ $k->user->name }}</td>
                    <td>{{ $k->judul }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($k->kategori) }}</span></td>
                    <td><span class="badge badge-{{ $k->status }}">{{ ucfirst($k->status) }}</span></td>
                    <td>{{ $k->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection