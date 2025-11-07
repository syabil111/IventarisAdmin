<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aset | Sistem Inventaris</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f3ef;
            color: #2f2f2f;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 240px;
            height: 100%;
            background-color: #344e41;
            padding-top: 20px;
            color: #fff;
        }
        .sidebar h4 {
            font-weight: 700;
            text-align: center;
            color: #fff;
            margin-bottom: 40px;
        }
        .sidebar .nav-link {
            color: #d8c3b1;
            font-weight: 500;
            padding: 12px 20px;
            transition: 0.3s;
        }
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background-color: #3a5a40;
            color: #fff;
            border-radius: 10px;
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 260px;
            padding: 30px;
        }
        .card-custom {
            background-color: #e9e2d0;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            padding: 25px;
        }

        .btn-add {
            background-color: #3a5a40;
            color: white;
            border-radius: 12px;
            padding: 8px 18px;
            font-weight: 500;
        }
        .btn-add:hover {
            background-color: #588157;
            color: #fff;
        }

        .table thead {
            background-color: #344e41;
            color: #fff;
            font-size: 14px;
        }
        .table td, .table th {
            vertical-align: middle;
            font-size: 14px;
        }

        .asset-img {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .badge-status {
            border-radius: 20px;
            padding: 6px 12px;
        }
        .badge-baik {
            background-color: #198754;
            color: white;
        }
        .badge-rusak {
            background-color: #dc3545;
            color: white;
        }

        .modal-header {
            background-color: #344e41;
            color: #fff;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            margin-top: 25px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4><i class="bi bi-box"></i> Inventaris</h4>
    <a href="<?= base_url('dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="<?= base_url('kategori') ?>" class="nav-link"><i class="bi bi-tags"></i> Kategori Aset</a>
    <a href="<?= base_url('aset') ?>" class="nav-link active"><i class="bi bi-box-seam"></i> Data Aset</a>
    <a href="<?= base_url('lokasi') ?>" class="nav-link"><i class="bi bi-geo-alt"></i> Lokasi Aset</a>
    <a href="<?= base_url('pemeliharaan') ?>" class="nav-link"><i class="bi bi-tools"></i> Pemeliharaan</a>
    <a href="<?= base_url('mutasi') ?>" class="nav-link"><i class="bi bi-arrow-left-right"></i> Mutasi Aset</a>
    <hr class="text-light mx-3">
    <a href="<?= base_url('logout') ?>" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark"><i class="bi bi-box-seam"></i> Data Aset</h3>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle"></i> Tambah Aset
        </button>
    </div>

    <div class="card card-custom">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Kode</th>
                    <th>Nama Aset</th>
                    <th>Tgl Perolehan</th>
                    <th>Nilai (Rp)</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($aset as $a): ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if($a['foto_aset']): ?>
                            <img src="<?= base_url('uploads/aset/'.$a['foto_aset']) ?>" class="asset-img">
                        <?php else: ?>
                            <img src="<?= base_url('uploads/noimage.png') ?>" class="asset-img">
                        <?php endif; ?>
                    </td>
                    <td><?= esc($a['nama_kategori']) ?></td>
                    <td><span class="badge bg-secondary"><?= esc($a['kode_aset']) ?></span></td>
                    <td><?= esc($a['nama_aset']) ?></td>
                    <td><?= date('d/m/Y', strtotime($a['tgl_perolehan'])) ?></td>
                    <td><?= number_format($a['nilai_perolehan'], 0, ',', '.') ?></td>
                    <td>
                        <?php if($a['kondisi'] == 'Baik'): ?>
                            <span class="badge-status badge-baik">Baik</span>
                        <?php else: ?>
                            <span class="badge-status badge-rusak"><?= esc($a['kondisi']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $a['aset_id'] ?>"><i class="bi bi-pencil"></i></button>
                        <a href="<?= base_url('aset/delete/'.$a['aset_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus aset ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= $a['aset_id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?= base_url('aset/update/'.$a['aset_id']) ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Aset</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Kategori</label>
                                        <select name="kategori_id" class="form-select" required>
                                            <?php foreach($kategori as $k): ?>
                                                <option value="<?= $k['id'] ?>" <?= $k['id']==$a['kategori_id']?'selected':'' ?>><?= esc($k['nama_kategori']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Aset</label>
                                        <input type="text" name="nama_aset" class="form-control" value="<?= esc($a['nama_aset']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nilai Perolehan</label>
                                        <input type="number" name="nilai_perolehan" class="form-control" value="<?= esc($a['nilai_perolehan']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kondisi</label>
                                        <select name="kondisi" class="form-select">
                                            <option <?= $a['kondisi']=='Baik'?'selected':'' ?>>Baik</option>
                                            <option <?= $a['kondisi']=='Rusak'?'selected':'' ?>>Rusak</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Foto Aset (Opsional)</label>
                                        <input type="file" name="foto_aset" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        © <?= date('Y') ?> Sistem Inventaris Aset - Versi Modern
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('aset/store') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Aset Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach($kategori as $k): ?>
                                <option value="<?= $k['id'] ?>"><?= esc($k['nama_kategori']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nama Aset</label>
                        <input type="text" name="nama_aset" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Perolehan</label>
                        <input type="date" name="tgl_perolehan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nilai Perolehan</label>
                        <input type="number" name="nilai_perolehan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kondisi</label>
                        <select name="kondisi" class="form-select" required>
                            <option>Baik</option>
                            <option>Rusak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Foto Aset</label>
                        <input type="file" name="foto_aset" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
