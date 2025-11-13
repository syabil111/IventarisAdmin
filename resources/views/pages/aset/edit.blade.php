@extends('layouts.admin.master')

@section('title', 'Edit Aset')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Aset</h3>
                    <div class="card-tools">
                        <a href="{{ route('aset.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('aset.update', $aset->aset_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori Aset <span class="text-danger">*</span></label>
                                    <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id', $aset->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kode_aset" class="form-label">Kode Aset <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_aset" id="kode_aset" 
                                           class="form-control @error('kode_aset') is-invalid @enderror" 
                                           value="{{ old('kode_aset', $aset->kode_aset) }}" required>
                                    @error('kode_aset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama_aset" class="form-label">Nama Aset <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_aset" id="nama_aset" 
                                           class="form-control @error('nama_aset') is-invalid @enderror" 
                                           value="{{ old('nama_aset', $aset->nama_aset) }}" required>
                                    @error('nama_aset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_perolehan" class="form-label">Tanggal Perolehan <span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_perolehan" id="tgl_perolehan" 
                                           class="form-control @error('tgl_perolehan') is-invalid @enderror" 
                                           value="{{ old('tgl_perolehan', $aset->tgl_perolehan->format('Y-m-d')) }}" required>
                                    @error('tgl_perolehan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nilai_perolehan" class="form-label">Nilai Perolehan (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" name="nilai_perolehan" id="nilai_perolehan" 
                                           class="form-control @error('nilai_perolehan') is-invalid @enderror" 
                                           value="{{ old('nilai_perolehan', $aset->nilai_perolehan) }}" required step="0.01" min="0">
                                    @error('nilai_perolehan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kondisi" class="form-label">Kondisi <span class="text-danger">*</span></label>
                                    <select name="kondisi" id="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
                                        <option value="">Pilih Kondisi</option>
                                        <option value="Baik" {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="Rusak Berat" {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                    </select>
                                    @error('kondisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="foto_aset" class="form-label">Foto Aset</label>
                                    <input type="file" name="foto_aset" id="foto_aset" 
                                           class="form-control @error('foto_aset') is-invalid @enderror" 
                                           accept="image/*">
                                    @error('foto_aset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                </div>

                                <div class="mb-3">
                                    <div id="image-preview" class="mt-2">
                                        @if($aset->foto_aset)
                                            <img src="{{ Storage::url('public/aset/' . $aset->foto_aset) }}" 
                                                 alt="Foto Aset" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="hapus_foto" id="hapus_foto" value="1">
                                                <label class="form-check-label" for="hapus_foto">
                                                    Hapus foto saat ini
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update
                                </button>
                                <a href="{{ route('aset.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview image sebelum upload
    document.getElementById('foto_aset').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        const existingImg = preview.querySelector('img');
        const existingCheckbox = preview.querySelector('.form-check');
        
        if (existingImg) existingImg.remove();
        if (existingCheckbox) existingCheckbox.remove();
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.maxWidth = '200px';
                img.style.maxHeight = '200px';
                preview.appendChild(img);
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush