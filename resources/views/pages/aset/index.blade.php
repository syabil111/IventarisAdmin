@extends('layouts.admin.master')

@section('title', 'Data Aset')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Aset</h3>
                    <div class="card-tools">
                        <a href="{{ route('aset.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Aset
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table id="asetTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Aset</th>
                                <th>Nama Aset</th>
                                <th>Kategori</th>
                                <th>Tanggal Perolehan</th>
                                <th>Nilai Perolehan</th>
                                <th>Kondisi</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aset as $aset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $aset->kode_aset }}</td>
                                <td>{{ $aset->nama_aset }}</td>
                                <td>{{ $aset->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $aset->tgl_perolehan->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($aset->nilai_perolehan, 2, ',', '.') }}</td>
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
                                <td>
                                    @if($aset->foto_aset)
                                        <img src="{{ Storage::url('public/aset/' . $aset->foto_aset) }}" 
                                             alt="Foto Aset" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="table-actions">
                                    <a href="{{ route('aset.show', $aset->aset_id) }}" 
                                       class="btn btn-info btn-sm" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('aset.edit', $aset->aset_id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('aset.destroy', $aset->aset_id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection