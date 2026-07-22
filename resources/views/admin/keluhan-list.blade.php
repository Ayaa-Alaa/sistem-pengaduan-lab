@extends('layouts.admin')
@section('title', 'Keluhan Masuk')

@section('content')
<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="diproses" {{ request('status')=='diproses'?'selected':'' }}>Diproses</option>
                    <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Kategori</label>
                <select name="kategori" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    <option value="hardware">Hardware</option>
                    <option value="software">Software</option>
                    <option value="jaringan">Jaringan</option>
                    <option value="fasilitas">Fasilitas</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Cari</label>
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Cari judul keluhan..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-search me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel -->
<div class="card">
    <div class="card-header bg-white py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-list-ul me-2"></i>Semua Keluhan</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">#</th>
                    <th>Mahasiswa</th>
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
                    <td>{{ $k->user->name }}</td>
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
                        <a href="{{ route('admin.keluhan.detail', $k->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>Tidak ada keluhan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $keluhans->links() }}</div>
</div>
@endsection