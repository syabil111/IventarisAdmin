@extends('layouts.admin.master')

@section('title', 'Edit Kategori Aset')

@section('content')
<div class="container-fluid py-4 px-4 main-wrapper animate__animated animate__fadeIn" style="background: #f9f3ef; min-height: 100vh;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 animate__animated animate__fadeInDown">
        <div class="mb-2">
            <h2 class="fw-bold mb-0" style="color: #1b3c53;">
                <i class="bi bi-pencil-square me-2" style="color: #456882;"></i> Edit Kategori Aset
            </h2>
            <small style="color: #456882;">Perbarui informasi kategori aset</small>
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom shadow-sm hover-scale">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card-custom shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp">
        <form id="editForm" action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Informasi Timestamp --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="timestamp-info p-3 rounded-3" style="background: rgba(69, 104, 130, 0.1);">
                        <small class="d-block fw-semibold" style="color: #1b3c53;">Dibuat Pada:</small>
                        <small style="color: #456882;">
                            <i class="bi bi-calendar-plus me-1"></i>
                            {{ $kategori->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}
                        </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="timestamp-info p-3 rounded-3" style="background: rgba(210, 193, 182, 0.2);">
                        <small class="d-block fw-semibold" style="color: #1b3c53;">Terakhir Diupdate:</small>
                        <small style="color: #456882;">
                            <i class="bi bi-arrow-clockwise me-1"></i>
                            @if($kategori->updated_at->eq($kategori->created_at))
                                Belum pernah diupdate
                            @else
                                {{ $kategori->updated_at->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}
                            @endif
                        </small>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color: #1b3c53;">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        name="nama_kategori"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        placeholder="Masukkan nama kategori" 
                        required
                        style="border: 1.5px solid #d2c1b6; border-radius: 10px; padding: 10px 12px;">
                    @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color: #1b3c53;">Kode Kategori</label>
                    <input type="text" 
                           class="form-control" 
                           value="{{ $kategori->kode_kategori }}" 
                           readonly
                           style="border: 1.5px solid #d2c1b6; border-radius: 10px; padding: 10px 12px; background-color: rgba(210, 193, 182, 0.1);">
                    <small style="color: #456882;">Kode kategori tidak dapat diubah</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color: #1b3c53;">Status <span class="text-danger">*</span></label>
                    <select class="form-select" 
                            name="status" 
                            required
                            style="border: 1.5px solid #d2c1b6; border-radius: 10px; padding: 10px 12px;">
                        <option value="1" {{ old('status', $kategori->status) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $kategori->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color: #1b3c53;">Deskripsi</label>
                <textarea class="form-control" 
                          name="deskripsi" 
                          rows="4"
                          placeholder="Masukkan deskripsi kategori (opsional)"
                          style="border: 1.5px solid #d2c1b6; border-radius: 10px; padding: 10px 12px;">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
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
:root {
    --primary-dark: #1b3c53;
    --primary-medium: #456882;
    --primary-light: #d2c1b6;
    --background: #f9f3ef;
}

body {
    background: var(--background);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.main-wrapper { 
    max-width: 100%; 
}

/* Card Form */
.card-custom {
    background: #ffffff;
    border-radius: 1.2rem;
    padding: 2rem;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(27, 60, 83, 0.08);
    border: 1px solid rgba(210, 193, 182, 0.3);
}
.card-custom:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(27, 60, 83, 0.12);
}

/* Timestamp Info */
.timestamp-info {
    transition: all 0.3s ease;
}
.timestamp-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 60, 83, 0.1);
}

/* Label & Input */
.form-label { 
    color: var(--primary-dark); 
    margin-bottom: 6px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form-control, .form-select {
    border: 1.5px solid var(--primary-light);
    border-radius: 10px;
    padding: 10px 12px;
    transition: all 0.3s ease;
    color: var(--primary-dark);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-medium);
    box-shadow: 0 0 8px rgba(69, 104, 130, 0.25);
    outline: none;
}

.form-control[readonly] { 
    background-color: rgba(210, 193, 182, 0.1); 
    color: var(--primary-medium);
}

/* Tombol */
.btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
    border: none;
    color: white;
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(27, 60, 83, 0.25);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.btn-primary-custom:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(27, 60, 83, 0.35);
    background: linear-gradient(135deg, var(--primary-medium), var(--primary-dark));
    color: white;
}

.btn-secondary-custom {
    background: var(--primary-medium);
    color: white;
    border: none;
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(69, 104, 130, 0.25);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.btn-secondary-custom:hover {
    background: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(27, 60, 83, 0.35);
    color: white;
}

.hover-scale {
    transition: all 0.25s ease;
}
.hover-scale:hover {
    transform: scale(1.05);
}

/* Placeholder styling */
::placeholder {
    color: #d2c1b6 !important;
    opacity: 0.7;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Invalid feedback */
.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.is-invalid {
    border-color: #dc3545 !important;
}

/* Responsif */
@media (max-width: 992px) {
    .card-custom { 
        padding: 1.5rem; 
    }
    .d-flex.justify-content-end { 
        flex-direction: column; 
        gap: 10px; 
    }
    .btn { 
        width: 100%; 
    }
    .row.mb-4 {
        margin-bottom: 1rem !important;
    }
}

/* Text colors */
.text-muted {
    color: var(--primary-medium) !important;
}

.text-danger {
    color: #dc3545 !important;
}

/* Small text styling */
small {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            title: '<strong style="color: #1b3c53; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">Simpan Perubahan?</strong>',
            html: '<p style="color: #456882; margin-top: 8px; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">Waktu update akan direkam secara otomatis.</p>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="bi bi-check-circle me-1"></i> Ya, Update!',
            cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Batal',
            confirmButtonColor: '#1b3c53',
            cancelButtonColor: '#456882',
            background: '#f9f3ef',
            customClass: {
                popup: 'rounded-4 animate__animated animate__zoomIn shadow-lg border',
                confirmButton: 'btn px-4 py-2 fw-semibold shadow-sm rounded-3',
                cancelButton: 'btn px-4 py-2 fw-semibold shadow-sm rounded-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    background: '#f9f3ef',
                    color: '#1b3c53',
                    didOpen: () => { 
                        Swal.showLoading(); 
                    },
                    customClass: {
                        popup: 'rounded-4 animate__animated animate__fadeIn shadow-lg border'
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
            background: '#f9f3ef',
            color: '#456882',
            customClass: { 
                popup: 'rounded-4 animate__animated animate__fadeInDown shadow-lg border',
                icon: 'text-success'
            }
        });
    @endif

    // Auto-save timestamp indicator
    let isFormModified = false;
    const formInputs = form.querySelectorAll('input, select, textarea');
    
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (!isFormModified) {
                isFormModified = true;
                // Tambahkan indikator bahwa form telah dimodifikasi
                const timestampInfo = document.querySelector('.timestamp-info:last-child small:last-child');
                if (timestampInfo) {
                    timestampInfo.innerHTML = '<i class="bi bi-pencil me-1"></i> Sedang diedit...';
                    timestampInfo.style.color = '#d2c1b6';
                }
            }
        });
    });
});
</script>
@endsection