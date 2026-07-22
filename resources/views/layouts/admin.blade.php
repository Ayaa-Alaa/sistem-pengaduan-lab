<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            font-size: 14px;
            transition: 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .sidebar .nav-link i { width: 20px; }
        .main-content { margin-left: 250px; padding: 28px; }
        .logo-area {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .topbar {
            background: white;
            padding: 14px 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card { border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .badge-pending  { background-color: #ffc107 !important; color: #000 !important; }
        .badge-diproses { background-color: #0dcaf0 !important; color: #000 !important; }
        .badge-selesai  { background-color: #198754 !important; color: #fff !important; }
        .badge-ditolak  { background-color: #dc3545 !important; color: #fff !important; }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <div class="logo-area">
    <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" 
             style="height:40px; width:40px; object-fit:contain; flex-shrink:0;">
        <div>
            <div class="text-white-50" style="font-size:10px; letter-spacing:1px;">LAB INFORMATIKA</div>
            <div class="text-white fw-bold" style="font-size:13px;">Sistem Helpdesk</div>
        </div>
    </div>
</div>
        <nav class="nav flex-column mt-2 flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.keluhan') }}" class="nav-link {{ request()->routeIs('admin.keluhan*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-circle me-2"></i> Keluhan Masuk
            </a>
            <a href="{{ route('admin.laporan') }}" class="nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan
            </a>
        </nav>
        <div class="p-3" style="border-top:1px solid rgba(255,255,255,0.1)">
            <div class="text-white-50 small">Login sebagai</div>
            <div class="text-white fw-semibold mb-2">{{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                    <i class="bi bi-box-arrow-left me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h6 class="mb-0 fw-bold">@yield('title')</h6>
            <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ now()->format('d F Y') }}</span>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>