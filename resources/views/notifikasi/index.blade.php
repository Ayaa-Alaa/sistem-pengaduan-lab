@extends('layouts.mahasiswa')
@section('title', 'Notifikasi')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-bell me-2"></i>Notifikasi</h6>
    </div>
    <div class="card-body p-0">
        @forelse($notifikasis as $n)
        <div class="d-flex align-items-start p-3 border-bottom {{ !$n->dibaca ? 'bg-light' : '' }}">
            <div class="me-3 mt-1">
                <i class="bi bi-bell{{ !$n->dibaca ? '-fill text-primary' : ' text-muted' }} fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <div class="fw-semibold">{{ $n->judul }}</div>
                <div class="text-muted small">{{ $n->pesan }}</div>
                <div class="text-muted" style="font-size:11px">{{ $n->created_at->diffForHumans() }}</div>
            </div>
            @if(!$n->dibaca)
            <form action="{{ route('notifikasi.baca', $n->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary">Tandai Dibaca</button>
            </form>
            @endif
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
            Tidak ada notifikasi
        </div>
        @endforelse
    </div>
</div>
@endsection