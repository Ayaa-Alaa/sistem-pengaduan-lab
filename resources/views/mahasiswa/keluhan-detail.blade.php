@extends('layouts.mahasiswa')
@section('title', 'Detail Keluhan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-file-text me-2 text-primary"></i>Detail Keluhan</h6>
                <span class="badge badge-{{ $keluhan->status }} fs-6">{{ ucfirst($keluhan->status) }}</span>
            </div>
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">{{ $keluhan->judul }}</h5>
                <div class="row g-3 mb-3">
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
                    <div class="col-md-4">
                        <small class="text-muted d-block">Tanggal</small>
                        <span>{{ $keluhan->created_at->format('d F Y') }}</span>
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
                @if($keluhan->catatan_admin)
                <div class="alert alert-info">
                    <strong><i class="bi bi-chat-dots me-1"></i>Catatan Admin:</strong><br>
                    {{ $keluhan->catatan_admin }}
                </div>
                @endif
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection