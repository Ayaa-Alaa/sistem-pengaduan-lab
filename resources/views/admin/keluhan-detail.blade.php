@extends('layouts.admin')
@section('title', 'Detail Keluhan')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between">
                <h6 class="fw-bold mb-0"><i class="bi bi-file-text me-2"></i>Detail Keluhan</h6>
                <span class="badge badge-{{ $keluhan->status }} fs-6">{{ ucfirst($keluhan->status) }}</span>
            </div>
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">{{ $keluhan->judul }}</h5>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <small class="text-muted d-block">Mahasiswa</small>
                        <strong>{{ $keluhan->user->name }}</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Kategori</small>
                        <span class="badge bg-secondary">{{ ucfirst($keluhan->kategori) }}</span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Prioritas</small>
                        @if($keluhan->prioritas == 'tinggi')
                            <span class="badge bg-danger">🔴 Tinggi</span>
                        @elseif($keluhan->prioritas == 'sedang')
                            <span class="badge bg-warning text-dark">🟡 Sedang</span>
                        @else
                            <span class="badge bg-success">🟢 Rendah</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Deskripsi</small>
                    <p class="bg-light p-3 rounded">{{ $keluhan->deskripsi }}</p>
                </div>
                @if($keluhan->foto)
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Foto Bukti</small>
                    <img src="{{ Storage::url($keluhan->foto) }}" class="img-fluid rounded" style="max-height:300px">
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Form Update Status -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Update Status</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.keluhan.update', $keluhan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $keluhan->status=='pending'?'selected':'' }}>⏳ Pending</option>
                            <option value="diproses" {{ $keluhan->status=='diproses'?'selected':'' }}>🔄 Diproses</option>
                            <option value="selesai" {{ $keluhan->status=='selesai'?'selected':'' }}>✅ Selesai</option>
                            <option value="ditolak" {{ $keluhan->status=='ditolak'?'selected':'' }}>❌ Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Admin</label>
                        <textarea name="catatan_admin" rows="4" class="form-control"
                            placeholder="Tulis catatan untuk mahasiswa...">{{ $keluhan->catatan_admin }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('admin.keluhan') }}" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left me-1"></i> Kembali
</a>
@endsection