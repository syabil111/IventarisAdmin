<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Inventaris & Aset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --secondary: #1e40af;
            --accent: #3b82f6;
            --light-bg: #f1f5f9;
            --white: #ffffff;
        }

        * {
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        body {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            min-height: 100vh;
            color: #334155;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn {
            background: linear-gradient(90deg, #ef4444, #f97316);
            border: none;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 500;
        }

        .logout-btn:hover {
            box-shadow: 0 4px 10px rgba(249, 115, 22, 0.4);
            transform: translateY(-2px);
        }

        /* HEADER CARD */
        .welcome-section {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            color: #fff;
            padding: 50px 30px;
            text-align: center;
            margin-top: 60px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .welcome-section h2 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .welcome-section p {
            color: #e0e7ff;
        }

        /* SECTION TITLE */
        .section-title {
            color: #fff;
            font-weight: 600;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* CARD STYLE */
        .content-card {
            background: var(--white);
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content-card .card-header {
            font-weight: 600;
            padding: 14px 20px;
            border: none;
            color: #fff;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 500;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        /* TABLE STYLE */
        .table-container {
            background: var(--white);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        .table thead {
            background-color: #eff6ff;
        }

        .table th {
            color: #1e3a8a;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: #f1f5f9;
        }

        /* FOOTER */
        footer {
            color: #e0e7ff;
            text-align: center;
            padding: 30px 0;
            font-size: 0.9rem;
            margin-top: 60px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }

        footer span {
            font-weight: 600;
        }

        /* ANIMATION */
        .fade-in {
            opacity: 0;
            transform: translateY(15px);
            animation: fadeIn 1s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-box-seam"></i> Inventaris & Aset Admin
            </a>
            <div class="ms-auto">
                <a href="{{ route('logout') }}" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- WELCOME SECTION -->
    <div class="container">
        <div class="welcome-section fade-in">
            <h2>👋 Selamat Datang, <span class="text-warning">{{ $admin }}</span></h2>
            <p>anda login sebagai<strong>Administrator</strong></p>
            <small>Login terakhir: {{ $last_login }}</small>
        </div>
    </div>

    <!-- DAFTAR INVENTARIS & ASET -->
    <div class="container my-5 fade-in">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="content-card">
                    <div class="card-header bg-primary">
                        <i class="bi bi-box-seam me-1"></i> Daftar Inventaris
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($iventaris as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item }}
                                <i class="bi bi-check-circle text-success"></i>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="content-card">
                    <div class="card-header bg-success">
                        <i class="bi bi-briefcase me-1"></i> Daftar Aset
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($aset as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item }}
                                <i class="bi bi-building-check text-primary"></i>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL INVENTARIS TERBARU -->
    <div class="container fade-in">
        <h4 class="section-title">📋 Inventaris Terbaru</h4>
        <div class="table-container">
            <table class="table align-middle table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Laptop</td>
                        <td>Elektronik</td>
                        <td><span class="badge bg-success">Tersedia</span></td>
                        <td>2025-09-30</td>
                    </tr>
                    <tr>
                        <td>Printer</td>
                        <td>Elektronik</td>
                        <td><span class="badge bg-warning text-dark">Dipinjam</span></td>
                        <td>2025-09-28</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        © {{ date('Y') }} <span>Sistem Inventaris & Aset</span> — Semua Hak Dilindungi
    </footer>

</body>
</html>
