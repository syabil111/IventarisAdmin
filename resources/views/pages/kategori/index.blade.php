@extends('layouts.admin.master')

@section('title', 'Kategori Aset - Sistem Inventaris')

@section('content')
<div class="container-fluid py-4 px-4 main-wrapper">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 animate-header">
        <h2 class="fw-bold text-dark mb-3 mb-md-0 d-flex align-items-center gap-2">
            <i class="bi bi-tags-fill text-primary fs-3"></i>
            <span>Manajemen Kategori Aset</span>
        </h2>
        <a href="{{ route('kategori.create') }}"
           class="btn btn-add-category d-flex align-items-center gap-2 shadow-lg">
            <i class="bi bi-plus-circle-fill fs-5"></i>
            <span>Tambah Kategori</span>
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false,
                    background: '#f0fff4',
                    color: '#198754',
                    toast: true,
                    position: 'top-end',
                    customClass: {
                        popup: 'animate__animated animate__fadeInDown rounded-4 shadow-lg'
                    }
                });
            });
        </script>
    @elseif (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 2200,
                    showConfirmButton: false,
                    background: '#fff5f5',
                    color: '#dc3545',
                    toast: true,
                    position: 'top-end',
                    customClass: {
                        popup: 'animate__animated animate__fadeInDown rounded-4 shadow-lg'
                    }
                });
            });
        </script>
    @endif

    {{-- Card Table --}}
    <div class="card-custom shadow-xl border-0 rounded-5 overflow-hidden fade-in">
        @if (isset($kategoris) && count($kategoris))
            <div class="table-responsive table-wrapper">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-header text-center">
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama Kategori</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Dibuat</th>
                            <th>Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $kategori)
                            <tr class="table-row animate__animated animate__fadeInUp" data-id="{{ $kategori->id }}">
                                <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ strtoupper($kategori->nama_kategori) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill shadow-sm">
                                        {{ strtoupper($kategori->kode_kategori) }}
                                    </span>
                                </td>
                                <td>{{ $kategori->deskripsi ?? '-' }}</td>
                                <td class="text-center text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $kategori->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $kategori->status ? 'bg-success-soft text-success' : 'bg-danger-soft text-danger' }} px-3 py-2 rounded-pill shadow-sm">
                                        {{ $kategori->status ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                            class="btn btn-sm btn-light shadow-sm border text-primary hover-scale"
                                            title="Edit Kategori">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                            class="delete-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-light shadow-sm border text-danger hover-scale btn-delete-trigger"
                                                title="Hapus Kategori">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5 fade-in">
                <i class="bi bi-inbox fs-1 text-secondary opacity-50"></i>
                <h5 class="mt-3 fw-bold">Belum Ada Kategori</h5>
                <p class="text-muted mb-3">Tambahkan kategori untuk memulai</p>
                <a href="{{ route('kategori.create') }}" class="btn btn-add-category">
                    <i class="bi bi-plus-circle-fill me-2"></i> Tambah Kategori
                </a>
            </div>
        @endif
    </div>
</div>

{{-- STYLE --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
body {
    background: linear-gradient(135deg, #f9fbfd 0%, #eef2f7 100%);
    font-family: 'Poppins', sans-serif;
}
.main-wrapper { padding: 1.5rem; }
.card-custom {
    background: #fff; border-radius: 1.5rem; padding: 1.8rem;
    transition: all 0.4s ease; box-shadow: 0 5px 18px rgba(0,0,0,0.06);
}
.card-custom:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
.table-header { background: linear-gradient(90deg,#e9eff5,#f4f8fc); font-weight:600; color:#333; text-transform:uppercase; }
.table th, .table td { padding:14px 16px; font-size:0.93rem; }
.table-row { transition: all 0.3s ease; }
.table-row:hover { background-color:#f1f7ff!important; transform:scale(1.01); box-shadow:inset 0 0 0 2px #d0e3ff; }
.bg-success-soft { background-color:#e7f7ed!important; }
.bg-danger-soft { background-color:#fde8e8!important; }
.bg-primary-soft { background-color:#e3f2fd!important; }
.hover-scale { transition: all 0.25s ease; }
.hover-scale:hover { transform: scale(1.1); }
.btn-add-category {
    background: linear-gradient(135deg,#1B3C53,#4F709C); color:#fff; border:none; padding:10px 22px;
    border-radius:12px; font-weight:600; letter-spacing:0.3px;
    transition:all 0.3s ease; box-shadow:0 4px 12px rgba(27,60,83,0.25); text-decoration:none;
}
.btn-add-category:hover {
    transform:translateY(-2px) scale(1.03);
    background:linear-gradient(135deg,#274963,#5B80A6);
    box-shadow:0 8px 18px rgba(27,60,83,0.35); color:#fff;
}
.fade-in { animation: fadeIn 0.8s ease forwards; }
@keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }
.animate-header { animation: fadeDown 0.8s ease forwards; }
@keyframes fadeDown { from {opacity:0; transform:translateY(-15px);} to {opacity:1; transform:translateY(0);} }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll(".btn-delete-trigger").forEach(btn => {
        btn.addEventListener("click", function() {
            const form = this.closest("form");
            const row = this.closest("tr");

            Swal.fire({
                title: '<strong style="color:#1B3C53">Yakin ingin menghapus kategori ini?</strong>',
                html: '<p style="font-size:15px;color:#4F709C;margin-top:8px;">Tindakan ini <b>tidak dapat dibatalkan</b>.</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Ya, hapus',
                cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Batal',
                reverseButtons: true,
                background: 'rgba(255,255,255,0.95)',
                backdrop: `rgba(0,0,0,0.4)`,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                showClass: { popup: 'animate__animated animate__zoomIn animate__faster' },
                hideClass: { popup: 'animate__animated animate__zoomOut animate__faster' },
                customClass: {
                    popup: 'rounded-4 shadow-lg border-0',
                    confirmButton: 'btn btn-danger px-4 py-2 fw-semibold shadow-sm rounded-3',
                    cancelButton: 'btn btn-secondary px-4 py-2 fw-semibold shadow-sm rounded-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar.',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        background: '#f8f9fa',
                        didOpen: () => {
                            Swal.showLoading();
                            row.classList.add('animate__animated','animate__fadeOutLeft');
                            setTimeout(() => form.submit(), 600);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Dibatalkan',
                        text: 'Kategori tidak jadi dihapus.',
                        icon: 'info',
                        timer: 1500,
                        showConfirmButton: false,
                        background: '#f0f8ff',
                        color: '#4F709C',
                        customClass: {
                            popup: 'rounded-4 shadow-lg animate__animated animate__fadeIn'
                        }
                    });
                }
            });
        });
    });
});
</script>
@endsection
