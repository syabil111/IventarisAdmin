<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Inventaris & Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: radial-gradient(circle at top left, #2B32B2, #1488CC);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Efek partikel animasi latar */
        .background-dots {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(255,255,255,0.15) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: moveDots 15s linear infinite;
        }

        @keyframes moveDots {
            from { background-position: 0 0; }
            to { background-position: 100px 100px; }
        }

        .login-container {
            position: relative;
            width: 420px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(18px);
            border-radius: 22px;
            padding: 40px 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
            z-index: 2;
            animation: fadeInUp 1s ease-in-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        .login-header h3 {
            font-weight: 600;
            font-size: 1.7rem;
        }

        .login-header p {
            color: #e0e0e0;
            font-size: 0.95rem;
        }

        label {
            color: #f8f9fa;
            font-weight: 500;
        }

        .form-control {
            height: 46px;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            transition: 0.3s;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.25);
            border-color: #1488CC;
            box-shadow: 0 0 8px rgba(20, 136, 204, 0.5);
        }

        .btn-login {
            background: linear-gradient(135deg, #2B32B2, #1488CC);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(20, 136, 204, 0.4);
        }

        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            color: #d0d0d0;
            font-size: 13px;
        }

        .footer-text span {
            color: #ffffff;
            font-weight: 600;
        }

        .icon-logo {
            font-size: 40px;
            color: #fff;
            background: linear-gradient(135deg, #1488CC, #2B32B2);
            width: 70px;
            height: 70px;
            line-height: 70px;
            text-align: center;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="background-dots"></div>

    <div class="login-container shadow-lg">
        <div class="login-header">
            <div class="icon-logo shadow">
                <i class="bi bi-box-seam"></i>
            </div>
            <h3>Inventaris & Aset</h3>
            <p>Masuk untuk mengelola sistem Anda</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.login.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control"
                       placeholder="Masukkan username" value="{{ old('username') }}" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                       placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-login w-100">
                <i class="bi bi-door-open me-1"></i> Masuk Sekarang
            </button>
        </form>

        <div class="footer-text mt-3">
            © {{ date('Y') }} <span>Sistem Inventaris & Aset</span><br>
            Semua Hak Dilindungi
        </div>
    </div>

</body>
</html>
