@extends('layouts.master')

@section('title', 'Edit Kategori Aset')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <h3 class="fw-bold mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Kategori Aset</h3>

        <div class="card card-custom">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" 
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            name="nama_kategori" 
                            value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                            placeholder="Masukkan nama kategori"
                            required>
                        @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kode Kategori</label>
                        <input type="text" class="form-control" value="{{ $kategori->kode_kategori }}" readonly style="background-color: #f1f1f1;">
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
                    <textarea class="form-control" name="deskripsi" rows="4" placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary-custom">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-check-circle me-2"></i>Update Kategori
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

.container-fluid {
    padding: 0 15px;
}

.card-custom {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 24px;
    border: none;
}

.form-label {
    color: #1B3C53;
    margin-bottom: 8px;
}

.form-control, .form-select {
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 10px 12px;
    transition: all 0.2s;
}

.form-control:focus, .form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control[readonly] {
    background-color: #f8f9fa;
    color: #6b7280;
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

.invalid-feedback {
    display: block;
    margin-top: 4px;
    font-size: 0.875em;
    color: #dc2626;
}

.text-muted {
    font-size: 0.875em;
    margin-top: 4px;
}

@media (max-width: 768px) {
    .main-content {
        padding: 15px;
    }
    
    .container-fluid {
        padding: 0 10px;
    }
    
    .card-custom {
        padding: 16px;
    }
    
    .row.mb-3 {
        margin-bottom: 1rem !important;
    }
    
    .col-md-6 {
        margin-bottom: 1rem;
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