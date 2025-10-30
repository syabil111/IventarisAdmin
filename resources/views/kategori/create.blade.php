@extends('layouts.master')

@section('title', 'Tambah Kategori - Sistem Inventaris')

@section('content')
<div class="main-content">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-plus-circle me-2"></i>
            Tambah Kategori Baru
        </h1>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="card-custom">
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="background: linear-gradient(135deg, #ef4444, #dc2626); border: none; color: white;">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('kategori.store') }}" id="kategoriForm">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                            value="{{ old('nama_kategori') }}" placeholder="Masukkan nama kategori" required>
                        @error('nama_kategori')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kode_kategori" class="form-label fw-semibold">Kode Kategori</label>
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
                    <label class="form-label fw-semibold">Status</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_aktif" value="1"
                                {{ old('status', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label text-success" for="status_aktif">
                                <i class="bi bi-check-circle me-1"></i>Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_nonaktif" value="0"
                                {{ old('status') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label text-danger" for="status_nonaktif">
                                <i class="bi bi-x-circle me-1"></i>Nonaktif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-check-circle me-2"></i>Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.main-content {
    padding: 20px;
    background-color: #f8f9fa;
    min-height: calc(100vh - 80px);
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding: 0 10px;
}

.page-title {
    color: #1B3C53;
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.card-custom {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 24px;
    border: none;
}

.card-body {
    padding: 0;
}

.form-label {
    color: #1B3C53;
    margin-bottom: 8px;
    font-weight: 500;
}

.form-control {
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 10px 12px;
    transition: all 0.2s;
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.btn-primary-custom {
    background: linear-gradient(135deg, #1B3C53, #456882);
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 60, 83, 0.3);
    color: white;
}

.btn-secondary-custom {
    background-color: #6b7280;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-secondary-custom:hover {
    background-color: #4b5563;
    color: white;
    transform: translateY(-2px);
}

.alert {
    border-radius: 8px;
    border: none;
}

.text-danger {
    font-size: 0.875em;
}

.form-check-input:checked {
    background-color: #1B3C53;
    border-color: #1B3C53;
}

.form-check-label {
    font-weight: 500;
}

@media (max-width: 768px) {
    .main-content {
        padding: 15px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .card-custom {
        padding: 16px;
    }
    
    .d-flex.gap-4 {
        gap: 2rem !important;
    }
    
    .d-flex.justify-content-end {
        flex-direction: column;
        gap: 10px;
    }
    
    .d-flex.justify-content-end .btn {
        width: 100%;
    }
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const namaInput = document.getElementById('nama_kategori');
        const kodeInput = document.getElementById('kode_kategori');
        const form = document.getElementById('kategoriForm');

        namaInput.addEventListener('blur', function () {
            if (!kodeInput.value) {
                const nama = this.value.trim();
                if (nama.length >= 4) {
                    kodeInput.value = nama.substring(0, 4).toUpperCase();
                }
            }
        });

        form.addEventListener('submit', function (e) {
            const nama = namaInput.value.trim();
            const kode = kodeInput.value.trim();
            if (!nama || !kode) {
                e.preventDefault();
                alert('Nama dan Kode kategori harus diisi!');
            }
        });
    });
</script>
@endsection