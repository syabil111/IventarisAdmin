@extends('layouts.admin.master')

@section('title', 'Edit Kategori Aset')

@section('content')
<div class="container-fluid py-4 px-4 main-wrapper animate__animated animate__fadeIn">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 animate__animated animate__fadeInDown">
        <h2 class="fw-bold text-dark mb-3 mb-md-0 d-flex align-items-center gap-2">
            <i class="bi bi-pencil-square text-primary fs-3"></i> Edit Kategori Aset
        </h2>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom shadow-sm hover-scale">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card-custom shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp">
        <form id="editForm" action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        name="nama_kategori"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        placeholder="Masukkan nama kategori" required>
                    @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kode Kategori</label>
                    <input type="text" class="form-control" value="{{ $kategori->kode_kategori }}" readonly>
                    <small class="text-muted">Kode kategori tidak dapat diubah</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <option value="1" {{ old('status', $kategori->status) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $kategori->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="4"
                    placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 pt-3">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom hover-scale">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom hover-scale" id="btnSubmit">
                    <i class="bi bi-check-circle me-2"></i> Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>

{{-- STYLE --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
body {
    background: linear-gradient(135deg, #f8fafc, #eef2f6);
    font-family: 'Poppins', sans-serif;
}
.main-wrapper { max-width: 100%; }

/* Card Form */
.card-custom {
    background: #ffffff;
    border-radius: 1.2rem;
    padding: 2rem;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
}
.card-custom:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
}

/* Label & Input */
.form-label { color: #1B3C53; margin-bottom: 6px; }
.form-control, .form-select {
    border: 1.5px solid #d1d5db;
    border-radius: 10px;
    padding: 10px 12px;
    transition: all 0.3s ease;
}
.form-control:focus, .form-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 8px rgba(37, 99, 235, 0.25);
}
.form-control[readonly] { background-color: #f3f4f6; }

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

.hover-scale {
    transition: all 0.25s ease;
}
.hover-scale:hover {
    transform: scale(1.05);
}

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
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('editForm');
    const submitBtn = document.getElementById('btnSubmit');

    // Konfirmasi popup sebelum submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Simpan Perubahan?",
            text: "Pastikan semua data sudah benar.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Update!",
            cancelButtonText: "Batal",
            confirmButtonColor: "#1b3c53",
            cancelButtonColor: "#6c757d",
            background: "#fff",
            customClass: {
                popup: 'rounded-4 animate__animated animate__zoomIn shadow-lg border-0'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => { Swal.showLoading(); },
                    background: "#f9fafb",
                    customClass: {
                        popup: 'rounded-4 animate__animated animate__fadeIn shadow-lg border-0'
                    }
                });

                setTimeout(() => {
                    form.submit();
                }, 1000);
            }
        });
    });

    // Notifikasi otomatis setelah sukses update (session flash)
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
