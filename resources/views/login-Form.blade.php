<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Inventaris & Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { font-family: 'Poppins', sans-serif; }

        html, body { height: 100%; margin: 0; }
        body {
            min-height: 100vh;
            width: 100vw;
            background: radial-gradient(circle at 25% 15%, #1e2a78, #0a1a3a 80%);
            color: #fff;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .aurora {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 180vw;
            height: 180vh;
            background: conic-gradient(from 180deg, #2B32B2, #1488CC, #00C9A7, #2B32B2);
            filter: blur(140px);
            opacity: 0.42;
            z-index: 1;
            animation: auroraMove 13s infinite linear;
        }
        @keyframes auroraMove {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 42px 37px;
            background: rgba(255, 255, 255, 0.10);
            border-radius: 22px;
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 15px 48px rgba(20,40,80,0.27);
            animation: fadeUp 0.9s ease-out;
        }

        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(40px); }
            100%{opacity:1;transform:translateY(0);}
        }

        .icon-logo {
            font-size: 52px;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            width: 80px; height: 80px;
            border-radius: 50%;
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
            box-shadow: 0 0 30px rgba(0,198,255,0.4);
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.07); }
            100%{transform:scale(1);}
        }

        label { color: #dfe8ff; font-weight: 500; margin-bottom: 7px; }
        .form-control {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            height: 46px;
            border-radius: 11px;
            margin-bottom: 5px;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.68);}
        .form-control:focus {
            background: rgba(255,255,255,0.23);
            border-color: #00C9A7;
            box-shadow: 0 0 11px rgba(0,201,167,0.42);
        }

        .btn-login {
            margin-top: 8px;
            background: linear-gradient(135deg, #2B32B2, #1488CC);
            border: none;
            border-radius: 12px;
            padding: 12px 0;
            font-weight:600;
            color:#fff;
            width:100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 18px rgba(20,136,204,0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-login:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow:0 10px 30px rgba(20,136,204,0.47);
        }
        .footer-text {
            text-align: center;
            color: #cfd9ff;
            font-size: 13px;
            margin-top: 28px;
        }
        .footer-text span { color: #fff; font-weight: 600; }
    </style>
</head>
<body>
    <div class="aurora"></div>
    <div class="login-container">
        <div class="login-header text-center">
            <div class="icon-logo"><i class="bi bi-box-seam"></i></div>
            <h3>Inventaris & Aset</h3>
            <p>Kelola aset Anda dengan mudah dan elegan</p>
        </div>

        {{-- FORM LOGIN TERHUBUNG DENGAN BACKEND --}}
        <form method="POST" action="{{ route('auth.login.process') }}">
            @csrf
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" id="username"
                       class="form-control @error('username') is-invalid @enderror"
                       placeholder="Masukkan username" value="{{ old('username') }}">
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Jika login gagal --}}
            @if ($errors->has('login_error'))
                <div class="alert alert-danger py-2">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <button type="submit" class="btn-login">
                <i class="bi bi-door-open me-1"></i>Masuk Sekarang
            </button>
        </form>

        <div class="footer-text">
            © <span id="year"></span> <span>Sistem Inventaris & Aset</span><br>Semua Hak Dilindungi
        </div>
    </div>

    <script>
        document.getElementById("year").textContent = new Date().getFullYear();

        // Jika login sukses (flash session)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                html: '<b>{{ session('success') }}</b>',
                background: 'rgba(30,40,90,0.95)',
                color: '#fff',
                confirmButtonColor: '#1488CC',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</body>
</html>
