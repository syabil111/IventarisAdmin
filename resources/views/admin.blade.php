<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Pusat Kontrol Aset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS DARI KODE ANDA DIGABUNGKAN DI SINI */
        :root {
            --primary-blue-light: #00c6ff;
            --primary-blue-dark: #0072ff;
            --sidebar-bg: rgba(255, 255, 255, 0.08);
            --active-bg-start: #2563eb;
            --active-bg-end: #1d4ed8;
            --logout-btn-bg-start: #2B32B2;
            --logout-btn-bg-end: #1488CC;
            --text-light: #cbd5e1;
            --good-color: #10b981; 
            --maintenance-color: #f59e0b; 
            --damaged-color: #ef4444; 
        }

        * { font-family: 'Poppins', sans-serif; }

        body {
            background: radial-gradient(circle at top left, #1e3a8a, #0f172a);
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: var(--sidebar-bg);
            backdrop-filter: blur(15px);
            border-right: 1px solid rgba(255,255,255,0.15);
            box-shadow: 2px 0 25px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 100;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h4 {
            font-weight: 700;
            font-size: 1.3rem;
            margin-top: 10px;
            color: #fff;
        }

        .sidebar-header .logo {
            font-size: 45px;
            background: linear-gradient(135deg, var(--primary-blue-light), var(--primary-blue-dark));
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 25px rgba(0,198,255,0.5);
        }

        .nav-links {
            padding: 25px 0;
            flex-grow: 1;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #fff;
            transform: translateX(3px);
            background: rgba(255,255,255,0.05);
        }

        /* LOGIKA BLADE: request()->routeIs('dashboard') */
        .nav-links a.active {
            background: linear-gradient(135deg, var(--active-bg-start), var(--active-bg-end));
            border-left: 5px solid var(--primary-blue-light);
            color: #fff;
            transform: translateX(5px);
            box-shadow: 0 0 20px rgba(37,99,235,0.4);
            font-weight: 600;
        }
        
        .nav-links i {
            font-size: 1.2rem;
        }

        /* LOGOUT BUTTON IN FOOTER */
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px; 
        }

        .btn-logout-sidebar {
            background: linear-gradient(135deg, var(--logout-btn-bg-start), var(--logout-btn-bg-end));
            border: none;
            border-radius: 18px; 
            padding: 10px 25px;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 18px rgba(20,136,204,0.35);
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout-sidebar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(20,136,204,0.45);
            opacity: 0.95;
            color: #fff;
        }

        .btn-logout-sidebar i {
            font-size: 1.1rem;
        }
        
        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 40px;
            background: radial-gradient(circle at 30% 10%, #1e40af, #0f172a);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        /* AURORA GLOW */
        .aurora {
            position: absolute;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 180deg, #2B32B2, #1488CC, #00C9A7, #2B32B2);
            filter: blur(180px);
            animation: auroraMove 18s infinite linear;
            opacity: 0.25;
            top: 0;
            left: 0;
            z-index: -1;
        }

        @keyframes auroraMove {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* WELCOME BOX */
        .welcome-box {
            position: relative;
            background: rgba(255,255,255,0.08);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            padding: 50px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            animation: fadeIn 1s ease forwards;
        }

        .welcome-box .icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--primary-blue-light), var(--primary-blue-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 0 25px rgba(0,198,255,0.5);
            animation: float 3s infinite ease-in-out;
        }

        .welcome-box h2 {
            color: #fff;
            font-weight: 700;
            font-size: 1.9rem;
        }

        .welcome-box p {
            color: #dbeafe;
            margin-bottom: 5px; 
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* DASHBOARD CARDS */
        .stat-card {
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 30px;
            color: #fff;
            text-align: center;
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.15);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,198,255,0.4);
        }

        .stat-card i {
            font-size: 40px;
            margin-bottom: 10px;
            color: #00e6ff;
        }

        .stat-card h3 {
            font-size: 1.5rem;
            margin-bottom: 5px;
            font-weight: 700;
        }
        
        /* ACTION BUTTONS */
        .btn-group {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn-glass {
            background: rgba(255,255,255,0.1);
            border: 1px solid var(--primary-blue-light);
            color: #fff;
            border-radius: 14px;
            padding: 12px 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .btn-glass:hover {
            background: linear-gradient(135deg, #1488CC, #2B32B2);
            border-color: #fff;
            box-shadow: 0 8px 25px rgba(0,198,255,0.5);
            transform: translateY(-3px) scale(1.02);
        }

        /* MAIN FOOTER di main-content*/
        .main-content footer {
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-top: 60px;
        }

        .main-content footer span {
            color: #fff;
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .sidebar { width: 220px; }
            .main-content { margin-left: 220px; padding: 30px; }
            .btn-group { flex-direction: column; gap: 10px; }
            .btn-glass { width: 80%; margin: 5px auto; }
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; padding: 25px; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-header">
                <div class="logo"><i class="bi bi-box-seam"></i></div>
                <h4>Inventaris & Aset</h4>
            </div>

            <div class="nav-links">
                {{-- Dashboard aktif di halaman ini --}}
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-house-door"></i> Dashboard</a>
                
                {{-- Link ke Data Aset --}}
                <a href="{{ route('aset.index') }}" class="{{ request()->routeIs('aset.*') ? 'active' : '' }}"><i class="bi bi-box2-heart"></i> Data Aset</a>
                
                <a href="#"><i class="bi bi-clipboard-data"></i> Data Barang</a> 
                
                <a href="#"><i class="bi bi-people"></i> Pengguna</a>
                <a href="#"><i class="bi bi-graph-up"></i> Laporan</a>
            </div>
        </div>
        
        <div class="sidebar-footer">
            <a href="{{ route('logout') }}" class="btn-logout-sidebar">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <small>© 2025 Inventaris & Aset</small>
        </div>
    </div>

    <div class="main-content">
        <div class="aurora"></div>

        <div class="welcome-box mb-5">
            <div class="icon"><i class="bi bi-box2-heart-fill" style="font-size:42px;color:white;"></i></div>
            
            <h2>Pusat Kontrol Aset</h2>
            
            <p>Kelola dan pantau seluruh aset Anda secara mudah dan modern.</p>
            <p>Nikmati tampilan yang elegan, interaktif, dan memanjakan mata.</p>

        </div>

        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <i class="bi bi-box"></i>
                    <h3>245</h3>
                    <p>Total Aset</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <i class="bi bi-exclamation-triangle"></i>
                    <h3>12</h3>
                    <p>Barang Rusak</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <i class="bi bi-check2-circle"></i>
                    <h3>233</h3>
                    <p>Aset Aktif</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <i class="bi bi-people"></i>
                    <h3>8</h3>
                    <p>Pengguna</p>
                </div>
            </div>
        </div>

        <div class="text-center btn-group">
            <a href="{{ route('aset.index') }}" class="btn-glass"><i class="bi bi-folder2-open"></i> Kelola Data Aset</a>
            
            <a href="#" class="btn-glass"><i class="bi bi-plus-circle"></i> Tambah Aset Baru</a>
        </div>

        <footer>
            © 2025 <span>Sistem Inventaris & Aset</span> — Semua Hak Dilindungi
        </footer>
    </div>

</body>
</html>