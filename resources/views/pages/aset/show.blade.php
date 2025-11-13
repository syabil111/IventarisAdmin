@extends('layouts.admin.master')

@section('title', 'Detail Aset')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Data Aset</h3>
                    <div class="card-tools">
                        <a href="{{ route('aset.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Kode Aset</th>
                                    <td>{{ $aset->kode_aset }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Aset</th>
                                    <td>{{ $aset->nama_aset }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $aset->kategori->nama_kategori ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Perolehan</th>
                                    <td>{{ $aset->tgl_perolehan->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Nilai Perolehan</th>
                                    <td>Rp {{ number_format($aset->nilai_perolehan, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'Baik' => 'success',
                                                'Rusak Ringan' => 'warning',
                                                'Rusak Berat' => 'danger'
                                            ][$aset->kondisi] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">{{ $aset->kondisi }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Dibuat</th>
                                    <td>{{ $aset->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diupdate</th>
                                    <td>{{ $aset->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <h5>Foto Aset</h5>
                                @if($aset->foto_aset)
                                    <img src="{{ Storage::url('public/aset/' . $aset->foto_aset) }}" 
                                         alt="Foto Aset" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                                @else
                                    <div class="text-muted py-5">
                                        <i class="fas fa-image fa-3x mb-3"></i>
                                        <p>Tidak ada foto</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('aset.edit', $aset->aset_id) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('aset.destroy', $aset->aset_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection