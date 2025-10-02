<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <!-- Header -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Dashboard Admin Iventaris</h4>
        </div>
        <div class="card-body">
            <h5>Selamat datang, <b>{{ $admin }}</b></h5>
            <p class="text-muted">Login terakhir: {{ $last_login }}</p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Total Iventaris</h6>
                    <h3 class="text-primary">{{ count($iventaris) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Total Aset</h6>
                    <h3 class="text-success">{{ count($aset) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Iventaris & Aset -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">📦 Daftar Iventaris</div>
                <ul class="list-group list-group-flush">
                    @foreach($iventaris as $item)
                        <li class="list-group-item">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">🏛️ Daftar Aset</div>
                <ul class="list-group list-group-flush">
                    @foreach($aset as $item)
                        <li class="list-group-item">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Tabel Inventaris -->
    <div class="card shadow-sm mt-4">
        <div class="card-header">📋 Iventaris Terbaru</div>
        <div class="card-body">
            <table class="table table-striped">
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
                    <td><span class="badge bg-warning">Dipinjam</span></td>
                    <td>2025-09-28</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
