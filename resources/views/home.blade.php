<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Inventaris & Aset</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ---------- BASE ---------- */
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #2B32B2, #1488CC);
            color: #fff;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Background Glow */
        .circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            z-index: 0;
        }

        .circle1 {
            width: 260px;
            height: 260px;
            background: #1488CC;
            top: 10%;
            left: 8%;
        }

        .circle2 {
            width: 300px;
            height: 300px;
            background: #2B32B2;
            bottom: 10%;
            right: 8%;
        }

        /* ---------- NAVBAR ---------- */
        .navbar {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            z-index: 10;
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 1.4rem;
        }

        .btn-logout {
            background: linear-gradient(135deg, #FF5F6D, #FFC371);
            border: none;
            border-radius: 12px;
            padding: 8px 18px;
            color: #fff;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 99, 99, 0.3);
        }

        /* ---------- CARD ---------- */
        .dashboard-container {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 90px;
            padding-bottom: 60px;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.12);
            border: none;
            border-radius: 25px;
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            color: #fff;
            padding: 60px 70px;
            max-width: 750px;
            width: 90%;
            text-align: center;
            animation: fadeInUp 1s ease-in-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .welcome-icon {
            font-size: 3.8rem;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 0 25px rgba(0, 114, 255, 0.5);
        }

        .dashboard-card h2 {
            font-weight: 600;
            margin-bottom: 10px;
            color: #fff;
        }

        .dashboard-card p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
        }

        /* ---------- BUTTONS ---------- */
        .btn-dashboard {
            border: none;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-dashboard-primary {
            background: linear-gradient(135deg, #2B32B2, #1488CC);
            color: #fff;
        }

        .btn-dashboard-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(20, 136, 204, 0.4);
        }

        .btn-dashboard-outline {
            background: transparent;
            border: 2px solid #fff;
            color: #fff;
        }

        .btn-dashboard-outline:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* ---------- FOOTER ---------- */
        footer {
            text-align: center;
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            margin-top: 80px;
        }

        footer span {
            font-weight: 600;
            color: #fff;
        }

        /* ---------- RESPONSIVE ---------- */
        @media (max-width: 768px) {
            .dashboard-card {
                padding: 40px 25px;
            }

            .btn-dashboard {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Background Glow -->
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-box-seam me-2"></i> Inventaris & Aset
            </a>
            <div>
                <a href="/auth/login" class="btn-logout">
                    <i class="bi bi-door-open-fill me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="dashboard-container">
        <div class="dashboard-card">
            <div class="welcome-icon">
                <i class="bi bi-clipboard-data"></i>
            </div>

            <h2>Selamat Datang di Sistem Inventaris & Aset</h2>

            @if (session('success'))
                <p class="text-success fw-bold mt-2">{{ session('success') }}</p>
            @endif

            <p>Kelola seluruh data inventaris dan aset dengan mudah, cepat, dan terintegrasi dalam satu sistem.</p>

            <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                <a href="{{ route('admin') }}" class="btn-dashboard btn-dashboard-primary">
                    <i class="bi bi-box-seam me-1"></i> Lihat Data Aset
                </a>
                <a href="#" class="btn-dashboard btn-dashboard-outline">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Aset Baru
                </a>
            </div>
        </div>

        <footer class="mt-5">
            © {{ date('Y') }} <span>Sistem Inventaris & Aset</span> — All Rights Reserved
        </footer>
    </div>

</body>
</html>
