<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Helpdesk Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg,
                #0a1628 0%,
                #1a3a6b 30%,
                #0d4fa8 60%,
                #1565c0 80%,
                #1976d2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Lingkaran dekoratif background */
        body::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            background: rgba(255,255,255,0.03);
            border-radius: 50%;
            top: -100px; left: -100px;
        }
        body::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            bottom: -80px; right: -80px;
        }

        /* Titik-titik dekoratif */
        .dot {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }
        .dot-1 { width: 200px; height: 200px; top: 10%; right: 15%; }
        .dot-2 { width: 120px; height: 120px; bottom: 20%; left: 10%; }
        .dot-3 { width: 80px;  height: 80px;  top: 50%; left: 5%; }
        .dot-4 { width: 60px;  height: 60px;  bottom: 10%; right: 20%; }

        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 16px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow:
                0 25px 60px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255,255,255,0.2);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            padding: 36px 32px 28px;
            text-align: center;
            position: relative;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -20px; left: 50%;
            transform: translateX(-50%);
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            clip-path: polygon(0 0, 100% 0, 50% 100%);
        }

        .logo-circle {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .logo-circle img {
            width: 54px; height: 54px;
            object-fit: contain;
        }

        .login-header h4 {
            color: white;
            font-weight: 700;
            margin-bottom: 4px;
            font-size: 20px;
        }

        .login-header p {
            color: rgba(255,255,255,0.75);
            font-size: 13px;
            margin: 0;
        }

        .login-body {
            padding: 40px 32px 32px;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #1a3a6b;
            margin-bottom: 6px;
        }

        .input-group-text {
            background: #e3f2fd;
            border: 1.5px solid #90caf9;
            border-right: none;
            color: #1565c0;
            font-size: 15px;
        }

        .form-control {
            border: 1.5px solid #90caf9;
            border-left: none;
            font-size: 14px;
            padding: 10px 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 3px rgba(25,118,210,0.15);
        }

        .input-group:focus-within .input-group-text {
            border-color: #1976d2;
        }

        .btn-login {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            border: none;
            color: white;
            padding: 13px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.3s;
            letter-spacing: 0.5px;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0a3a8a, #1565c0);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13,71,161,0.4);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-danger {
            background: #fff3f3;
            border: 1px solid #ffcdd2;
            color: #c62828;
            border-radius: 10px;
            font-size: 13px;
            padding: 10px 14px;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: rgba(255,255,255,0.6);
        }

        .footer-text span {
            color: rgba(255,255,255,0.9);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Dekorasi background -->
    <div class="dot dot-1"></div>
    <div class="dot dot-2"></div>
    <div class="dot dot-3"></div>
    <div class="dot dot-4"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-circle">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                         onerror="this.parentElement.innerHTML='<i class=\'bi bi-pc-display\' style=\'font-size:32px;color:white\'></i>'">
                </div>
                <h4>Sistem Helpdesk</h4>
                <p>Laboratorium Informatika</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                <h6 class="fw-bold text-center mb-4" style="color:#1a3a6b">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Akun Anda
                </h6>

                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Masukkan email anda"
                                   value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Masukkan password anda"
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-text">
            &copy; {{ date('Y') }} <span>Lab Informatika</span> — Sistem Helpdesk
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>