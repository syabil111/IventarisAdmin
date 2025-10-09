<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Aset | Manajemen Aset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ================================== */
        /* CSS INLINE (SEMUA GAYA) */
        /* ================================== */
        :root {
            --primary-blue-light: #00c6ff;
            --primary-blue-dark: #0072ff;
            --sidebar-bg: rgba(255, 255, 255, 0.08);
            --active-bg-start: #2563eb;
            --active-bg-end: #1d4ed8;
            --logout-btn-bg-start: #2B32B2;
            --logout-btn-bg-end: #1488CC;
            --text-light: #cbd5e1;
            --good-color: #10b981; /* Kondisi Baik */
            --maintenance-color: #f59e0b; /* Perlu Maintenance */
            --damaged-color: #ef4444; /* Kondisi Rusak */
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

        /* LOGIKA BLADE: request()->routeIs('aset.*') */
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
        
        /* DASHBOARD & ASET CARDS */
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
            min-height: 150px;
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

        /* DATA ASET PAGE SPECIFIC */

        .page-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }

        .page-header .icon {
            font-size: 35px;
            color: var(--primary-blue-light);
        }

        .page-header h2 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .page-header p {
            color: var(--text-light);
            font-size: 0.95rem;
            margin: 0;
        }

        /* CARD COLORS */
        .stat-card.total { background: rgba(0, 114, 255, 0.2); }
        .stat-card.good { background: rgba(16, 185, 129, 0.2); }
        .stat-card.maintenance { background: rgba(245, 158, 11, 0.2); }
        .stat-card.damaged { background: rgba(239, 68, 68, 0.2); }

        /* CONTROLS (BUTTONS & SEARCH) */
        .data-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-tambah-aset {
            background: var(--primary-blue-dark);
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-tambah-aset:hover {
            background: var(--primary-blue-light);
            box-shadow: 0 4px 15px rgba(0, 198, 255, 0.5);
        }

        .search-bar {
            display: flex;
            max-width: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .search-bar input {
            background: transparent;
            border: none;
            padding: 10px 15px;
            color: #fff;
            flex-grow: 1;
        }

        .search-bar input::placeholder {
            color: var(--text-light);
        }

        .search-bar button {
            background: var(--primary-blue-dark);
            border: none;
            padding: 0 15px;
            color: #fff;
            transition: background 0.3s;
        }

        .search-bar button:hover {
            background: var(--primary-blue-light);
        }

        /* FILTER BUTTONS */
        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-buttons .btn {
            font-size: 0.85rem;
            padding: 8px 15px;
            border-radius: 10px;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
        }

        .filter-buttons .btn-primary {
            background: var(--primary-blue-dark);
            border-color: var(--primary-blue-light);
        }

        .filter-buttons .btn-secondary {
            background: rgba(255,255,255,0.1);
        }

        /* DATA TABLE */
        .table-responsive {
            margin-top: 20px;
            background: rgba(255,255,255,0.05);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
            color: #fff;
        }

        .table thead th {
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 2px solid rgba(255,255,255,0.1);
            font-weight: 600;
            color: var(--primary-blue-light);
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table tbody td {
            border-top: 1px solid rgba(255,255,255,0.05);
            vertical-align: middle;
        }

        /* BADGES */
        .badge-status {
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
        }

        .badge-baik { background-color: var(--good-color); }
        .badge-rusak { background-color: var(--damaged-color); }
        .badge-maintenance { background-color: var(--maintenance-color); }
        .badge-tersedia { 
            background-color: #2563eb; 
            color: #fff;
        }
        .badge-tidak { 
            background-color: #4b5563; 
            color: #fff;
        }

        /* ACTION BUTTONS IN TABLE */
        .table .action-buttons a {
            color: #fff;
            padding: 6px;
            border-radius: 5px;
            margin: 0 3px;
            transition: background 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .table .action-buttons .edit-btn { background-color: var(--primary-blue-dark); }
        .table .action-buttons .delete-btn { background-color: var(--damaged-color); }
        .table .action-buttons .detail-btn { background-color: var(--good-color); }

        .table .action-buttons a:hover {
            opacity: 0.8;
        }

        /* PAGINATION */
        .pagination-info {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .pagination-controls {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 5px;
        }

        .pagination-controls .page-link {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            border-radius: 8px;
            margin: 0 2px;
            transition: background 0.3s;
        }

        .pagination-controls .page-item.active .page-link {
            background: var(--primary-blue-dark);
            border-color: var(--primary-blue-light);
            box-shadow: 0 0 10px rgba(0,198,255,0.3);
        }

        .pagination-controls .page-link:hover {
            background: rgba(255,255,255,0.2);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; padding: 25px; }
            .data-controls { justify-content: center; }
            .search-bar { width: 100%; max-width: none; }
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
                {{-- Link ke Dashboard --}}
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-house-door"></i> Dashboard</a>
                
                {{-- Data Aset aktif di halaman ini (Asumsi route: aset.index atau aset.*) --}}
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

        <div class="page-header">
            <div class="icon"><i class="bi bi-box2-heart"></i></div>
            <div>
                <h2>Manajemen Data Aset</h2>
                <p>Lihat, kelola, dan perbarui seluruh data aset perusahaan.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card total">
                    <i class="bi bi-box"></i>
                    <h3>245</h3>
                    <p>Total Aset</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="stat-card good">
                    <i class="bi bi-check2-circle"></i>
                    <h3>220</h3>
                    <p>Aset Kondisi Baik</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="stat-card maintenance">
                    <i class="bi bi-tools"></i>
                    <h3>15</h3>
                    <p>Perlu Maintenance</p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="stat-card damaged">
                    <i class="bi bi-x-octagon"></i>
                    <h3>10</h3>
                    <p>Kondisi Rusak</p>
                </div>
            </div>
        </div>

        <div class="data-controls">
            <a href="#" class="btn-tambah-aset" onclick="alert('Formulir Tambah Aset Baru muncul di sini.'); return false;">
                <i class="bi bi-plus-circle"></i> Tambah Aset Baru
            </a>
            <div class="search-bar">
                <input type="text" placeholder="Cari aset (kode, nama, lokasi...)">
                <button><i class="bi bi-search"></i></button>
            </div>
        </div>

        <div class="filter-buttons mb-4">
            <a href="#" class="btn btn-primary">Semua Aset</a>
            <a href="#" class="btn btn-secondary">Kondisi Baik (220)</a>
            <a href="#" class="btn btn-secondary">Maintenance (15)</a>
            <a href="#" class="btn btn-secondary">Rusak (10)</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Kode Aset</th>
                        <th style="width: 25%;">Nama Aset</th>
                        <th style="width: 15%;">Lokasi</th>
                        <th style="width: 15%;">Kondisi</th>
                        <th style="width: 10%;">Tersedia</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ASET/24/SR001</td>
                        <td>Server Rack Mount Dell R740xd</td>
                        <td>Ruang Server</td>
                        <td><span class="badge-status badge-baik">Baik</span></td>
                        <td><span class="badge-status badge-tersedia">Ya</span></td>
                        <td class="action-buttons">
                            <a href="#" class="detail-btn" onclick="alert('Menampilkan Detail ASET/24/SR001'); return false;" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="#" class="edit-btn" onclick="alert('Membuka Form Edit ASET/24/SR001'); return false;" title="Edit"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" class="delete-btn" onclick="alert('Konfirmasi Hapus ASET/24/SR001'); return false;" title="Hapus"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>ASET/24/LP005</td>
                        <td>Laptop Lenovo ThinkPad X1 Carbon</td>
                        <td>Divisi Keuangan</td>
                        <td><span class="badge-status badge-rusak">Rusak</span></td>
                        <td><span class="badge-status badge-tidak">Tidak</span></td>
                        <td class="action-buttons">
                            <a href="#" class="detail-btn" onclick="alert('Menampilkan Detail ASET/24/LP005'); return false;" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="#" class="edit-btn" onclick="alert('Membuka Form Edit ASET/24/LP005'); return false;" title="Edit"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" class="delete-btn" onclick="alert('Konfirmasi Hapus ASET/24/LP005'); return false;" title="Hapus"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <p class="pagination-info">Menampilkan 1 sampai 10 dari 245 Aset</p>
            <nav class="pagination-controls">
                <ul class="pagination mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">25</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </nav>
        </div>

        <footer>
            © 2025 <span>Sistem Inventaris & Aset</span> — Semua Hak Dilindungi
        </footer>
    </div>

</body>
</html>