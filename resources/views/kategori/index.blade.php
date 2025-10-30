@extends('layouts.master')

@section('title', 'Kategori Aset - Sistem Inventaris')

@section('content')
<div class="main-content">
  <div class="page-header">
      <h2 class="fw-bold"><i class="bi bi-tags me-2"></i> Manajemen Kategori Aset</h2>
      <a href="{{ route('kategori.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah Kategori</a>
  </div>

  <div class="card-custom">
      @if(session('success'))
      <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
      </div>
      @endif

      @if(isset($kategoris) && count($kategoris))
      <div class="table-responsive">
          <table class="table table-custom">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Nama Kategori</th>
                      <th>Kode</th>
                      <th>Deskripsi</th>
                      <th>Tanggal Dibuat</th>
                      <th>Status</th>
                      <th class="text-center">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($kategoris as $kategori)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td class="fw-bold">{{ $kategori->nama_kategori }}</td>
                      <td><span class="badge-custom">{{ $kategori->kode_kategori }}</span></td>
                      <td>{{ $kategori->deskripsi ?? '-' }}</td>
                      <td>{{ $kategori->created_at->format('d/m/Y H:i') }}</td>
                      <td>
                        <span class="badge-custom {{ $kategori->status ? 'badge-active' : 'badge-inactive' }}">
                            {{ $kategori->status ? 'Aktif' : 'Nonaktif' }}
                        </span>
                      </td>
                      <td class="text-center">
                          <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-edit"><i class="bi bi-pencil-square"></i></a>

                          <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline delete-form">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-delete btn-delete-trigger">
                                <i class="bi bi-trash"></i>
                            </button>
                          </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      @else
      <div class="text-center py-5">
          <i class="bi bi-inbox fs-1 text-secondary"></i>
          <h5 class="mt-3 fw-bold">Belum Ada Kategori</h5>
          <p>Tambahkan kategori untuk memulai</p>
          <a href="{{ route('kategori.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah Kategori</a>
      </div>
      @endif
  </div>
</div>

<style>
/* Custom Styles untuk halaman Kategori */
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

.page-header h2 {
    color: #1B3C53;
    margin: 0;
}

.card-custom {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 24px;
    border: none;
}

.table-custom {
    width: 100%;
    margin-bottom: 0;
}

.table-custom th {
    background-color: #f8f9fa;
    color: #1B3C53;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
    padding: 12px 8px;
}

.table-custom td {
    padding: 12px 8px;
    vertical-align: middle;
    border-bottom: 1px solid #e9ecef;
}

.table-custom tbody tr:hover {
    background-color: #f8f9fa;
}

.badge-custom {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85em;
    font-weight: 500;
}

.badge-active {
    background-color: #d1fae5;
    color: #065f46;
}

.badge-inactive {
    background-color: #fee2e2;
    color: #991b1b;
}

.btn-edit {
    background-color: #3b82f6;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    transition: all 0.2s;
}

.btn-edit:hover {
    background-color: #2563eb;
    color: white;
    transform: translateY(-1px);
}

.btn-delete {
    background-color: #ef4444;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    transition: all 0.2s;
}

.btn-delete:hover {
    background-color: #dc2626;
    color: white;
    transform: translateY(-1px);
}

.alert {
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border-left: 4px solid #10b981;
}

.text-center.py-5 {
    padding: 3rem 1rem;
}

.text-center.py-5 i {
    opacity: 0.7;
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
    
    .table-responsive {
        font-size: 0.9em;
    }
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// ========== SweetAlert Delete Confirm ==========
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll(".btn-delete-trigger").forEach(btn => {
        btn.addEventListener("click", function(){
            let form = this.closest(".delete-form");

            Swal.fire({
                title: "Hapus kategori?",
                text: "Data ini tidak bisa dikembalikan.",
                icon: "warning",
                background: "#ffffff",
                color: "#1f2937",
                iconColor: "#eab308",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal",
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                customClass: {
                    popup: "rounded-4 shadow-lg",
                    confirmButton: "px-4 py-2 rounded-pill fw-bold",
                    cancelButton: "px-4 py-2 rounded-pill fw-bold"
                }
            }).then((result)=>{
                if(result.isConfirmed){
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection