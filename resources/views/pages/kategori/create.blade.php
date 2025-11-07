@extends('layouts.admin.master')

@section('title', 'Tambah Kategori - Sistem Inventaris')

@section('content')
<div class="container-fluid py-4 px-4 main-wrapper animate__animated animate__fadeIn">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 animate__animated animate__fadeInDown">
        <h2 class="fw-bold text-dark mb-3 mb-md-0">
            <i class="bi bi-plus-circle me-2 text-primary"></i> Tambah Kategori Baru
        </h2>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom hover-scale">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card-custom shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp">
        <form method="POST" action="{{ route('kategori.store') }}" id="kategoriForm">
            @csrf

            {{-- Error Alert --}}
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4"
                style="background: linear-gradient(135deg, #ef4444, #dc2626); border: none; color: white;">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Input Fields --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        value="{{ old('nama_kategori') }}" placeholder="Masukkan nama kategori" required>
                    @error('nama_kategori')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kode_kategori" class="form-label fw-semibold">Kode Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="kode_kategori" name="kode_kategori"
                        value="{{ old('kode_kategori') }}" placeholder="Masukkan kode kategori" required>
                    @error('kode_kategori')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                    placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                <div class="d-flex gap-4 flex-wrap">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_aktif" value="1"
                            {{ old('status', '1') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label text-success fw-semibold" for="status_aktif">
                            <i class="bi bi-check-circle me-1"></i>Aktif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_nonaktif" value="0"
                            {{ old('status') == '0' ? 'checked' : '' }}>
                        <label class="form-check-label text-danger fw-semibold" for="status_nonaktif">
                            <i class="bi bi-x-circle me-1"></i>Nonaktif
                        </label>
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end gap-2 pt-3">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom hover-scale">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom hover-scale" id="btnSubmit">
                    <i class="bi bi-check-circle me-2"></i> Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

{{-- STYLE --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
body { background: linear-gradient(135deg, #f8fafc, #eef2f6); font-family: 'Poppins', sans-serif; }

.main-wrapper { max-width: 100%; }

/* Card dan Input */
.card-custom {
    background: #fff;
    border-radius: 1.2rem;
    padding: 2rem;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
.card-custom:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}
.form-label { color: #1B3C53; margin-bottom: 6px; }
.form-control {
    border: 1.5px solid #d1d5db;
    border-radius: 10px;
    padding: 10px 12px;
    transition: all 0.3s ease;
}
.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 8px rgba(37,99,235,0.25);
}

/* Tombol */
.btn-primary-custom {
    background: linear-gradient(135deg, #1B3C53, #3b82f6);
    border: none;
    color: white;
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-primary-custom:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(37,99,235,0.3);
}
.btn-secondary-custom {
    background: #6b7280;
    color: white;
    border: none;
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-secondary-custom:hover {
    background: #4b5563;
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
.hover-scale { transition: all 0.25s ease; }
.hover-scale:hover { transform: scale(1.05); }

/* Responsif */
@media (max-width: 992px) {
    .card-custom { padding: 1.5rem; }
    .d-flex.justify-content-end { flex-direction: column; gap: 10px; }
    .btn { width: 100%; }
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const namaInput = document.getElementById('nama_kategori');
    const kodeInput = document.getElementById('kode_kategori');
    const form = document.getElementById('kategoriForm');

    // Otomatis buat kode kategori dari nama
    namaInput.addEventListener('blur', function () {
        if (!kodeInput.value) {
            const nama = this.value.trim();
            if (nama.length >= 4) {
                kodeInput.value = nama.substring(0, 4).toUpperCase();
            }
        }
    });

    // SweetAlert konfirmasi sebelum submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Simpan Kategori Baru?",
            text: "Pastikan semua data sudah benar.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Simpan!",
            cancelButtonText: "Batal",
            confirmButtonColor: "#1b3c53",
            cancelButtonColor: "#6c757d",
            background: "#fff",
            customClass: { popup: 'rounded-4 animate__animated animate__zoomIn shadow-lg border-0' }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => { Swal.showLoading(); },
                    background: "#f9fafb",
                    customClass: { popup: 'rounded-4 animate__animated animate__fadeIn shadow-lg border-0' }
                });
                setTimeout(() => form.submit(), 1000);
            }
        });
    });

    // Notifikasi sukses setelah simpan
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            toast: true,
            position: 'top-end',
            background: '#f0fff4',
            color: '#198754',
            customClass: { popup: 'rounded-4 animate__animated animate__fadeInDown shadow-lg' }
        });
    @endif
});
</script>
@endsection
