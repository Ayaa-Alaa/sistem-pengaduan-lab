@extends('layouts.mahasiswa')
@section('title', 'Buat Keluhan Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2 text-primary"></i>Form Keluhan Baru</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('keluhan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Keluhan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Contoh: Monitor PC No.5 tidak menyala" value="{{ old('judul') }}">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="hardware" {{ old('kategori')=='hardware'?'selected':'' }}>💻 Hardware</option>
                                <option value="software" {{ old('kategori')=='software'?'selected':'' }}>🖥️ Software</option>
                                <option value="jaringan" {{ old('kategori')=='jaringan'?'selected':'' }}>🌐 Jaringan</option>
                                <option value="fasilitas" {{ old('kategori')=='fasilitas'?'selected':'' }}>🏫 Fasilitas</option>
                                <option value="lainnya" {{ old('kategori')=='lainnya'?'selected':'' }}>📋 Lainnya</option>
                            </select>
                            @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Prioritas <span class="text-danger">*</span></label>
                            <select name="prioritas" class="form-select @error('prioritas') is-invalid @enderror">
                                <option value="rendah" {{ old('prioritas')=='rendah'?'selected':'' }}>🟢 Rendah</option>
                                <option value="sedang" {{ old('prioritas','sedang')=='sedang'?'selected':'' }}>🟡 Sedang</option>
                                <option value="tinggi" {{ old('prioritas')=='tinggi'?'selected':'' }}>🔴 Tinggi</option>
                            </select>
                            @error('prioritas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Jelaskan keluhan secara detail...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto Bukti <span class="text-muted">(opsional)</span></label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Maks 2MB</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send me-1"></i> Kirim Keluhan
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection