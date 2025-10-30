@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-0 mx-0" style="background-color: #f8f9fa; min-height: 100vh; width: 100%; overflow-x: hidden;">

  {{-- Header --}}
  <div class="card shadow-sm border-0 mx-0 mt-0 mb-4 py-4" style="background: linear-gradient(135deg, #1B3C53, #456882); border-radius: 0;">
    <div class="text-center text-white px-2">
      <h3 class="fw-bold mb-2">Sistem Manajemen Inventaris & Aset</h3>
      <p class="mb-0 opacity-75">Mengelola, memantau, dan mengoptimalkan aset organisasi dengan efisien.</p>
    </div>
  </div>

  {{-- Statistik --}}
  <div class="row g-2 g-md-3 justify-content-center mx-0 px-2 px-md-3 mb-4">
    <div class="col-6 col-sm-4 col-md-3 col-lg-2 px-1">
      <div class="card shadow-sm border-0 stat-card" style="border-radius: 10px;">
        <div class="card-body text-center py-3">
          <i class="bi bi-tag fs-2 text-primary mb-2"></i>
          <h6 class="text-muted mb-1">Kategori Aset</h6>
          <h4 class="fw-bold mb-0">{{ $kategoriCount ?? 8 }}</h4>
        </div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2 px-1">
      <div class="card shadow-sm border-0 stat-card" style="border-radius: 10px;">
        <div class="card-body text-center py-3">
          <i class="bi bi-box-seam fs-2 text-success mb-2"></i>
          <h6 class="text-muted mb-1">Total Aset</h6>
          <h4 class="fw-bold mb-0">{{ $asetCount ?? 120 }}</h4>
        </div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2 px-1">
      <div class="card shadow-sm border-0 stat-card" style="border-radius: 10px;">
        <div class="card-body text-center py-3">
          <i class="bi bi-geo-alt fs-2 text-danger mb-2"></i>
          <h6 class="text-muted mb-1">Lokasi Aset</h6>
          <h4 class="fw-bold mb-0">{{ $lokasiCount ?? 12 }}</h4>
        </div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2 px-1">
      <div class="card shadow-sm border-0 stat-card" style="border-radius: 10px;">
        <div class="card-body text-center py-3">
          <i class="bi bi-wrench fs-2 text-warning mb-2"></i>
          <h6 class="text-muted mb-1">Pemeliharaan</h6>
          <h4 class="fw-bold mb-0">{{ $pemeliharaanCount ?? 6 }}</h4>
        </div>
      </div>
    </div>



  {{-- Grafik --}}
  <div class="row g-2 g-md-3 mx-0 px-2 px-md-3 mb-4">
    <div class="col-lg-6 px-1">
      <div class="card shadow-sm border-0 chart-container" style="border-radius: 10px;">
        <div class="card-body p-3">
          <h6 class="fw-semibold mb-3">
            <i class="bi bi-bar-chart me-2 text-primary"></i>Distribusi Aset per Kategori
          </h6>
          <div class="chart-wrapper">
            <canvas id="asetChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 px-1">
      <div class="card shadow-sm border-0 chart-container" style="border-radius: 10px;">
        <div class="card-body p-3">
          <h6 class="fw-semibold mb-3">
            <i class="bi bi-pie-chart me-2 text-success"></i>Kondisi Aset
          </h6>
          <div class="chart-wrapper">
            <canvas id="conditionChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
<footer class="text-center text-muted py-3 mt-auto mx-0" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6; width: 100%;">
  <div class="container-fluid px-0">
    <small>© {{ date('Y') }} Sistem Inventaris & Aset</small>
  </div>
</footer>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Bar Chart - Asset Distribution
  new Chart(document.getElementById('asetChart'), {
    type: 'bar',
    data: {
      labels: ['Elektronik', 'Furnitur', 'Kendaraan', 'Peralatan Kantor', 'Lainnya'],
      datasets: [{
        label: 'Jumlah',
        data: [35, 25, 15, 20, 10],
        backgroundColor: ['#1B3C53','#456882','#D2C1B6','#8FB8DE','#4A7C59'],
        borderRadius: 8
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { 
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.7)',
          titleFont: { size: 14 },
          bodyFont: { size: 13 },
          padding: 10,
          cornerRadius: 8
        }
      },
      scales: {
        y: { 
          beginAtZero: true, 
          grid: { color: 'rgba(0, 0, 0, 0.05)' },
          ticks: { font: { size: 12 } }
        },
        x: { 
          grid: { display: false },
          ticks: { font: { size: 12 } }
        }
      }
    }
  });

  // Doughnut Chart - Asset Condition
  new Chart(document.getElementById('conditionChart'), {
    type: 'doughnut',
    data: {
      labels: ['Baik', 'Perlu Servis', 'Rusak'],
      datasets: [{
        data: [70, 20, 10],
        backgroundColor: ['#4A7C59', '#D2C1B6', '#8FB8DE'],
        borderWidth: 0,
        hoverOffset: 8
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '60%',
      plugins: {
        legend: {
          position: 'bottom',
          labels: { 
            usePointStyle: true, 
            padding: 20,
            font: { size: 13 }
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.7)',
          bodyFont: { size: 13 },
          padding: 10,
          cornerRadius: 8
        }
      }
    }
  });
});
</script>

{{-- ✅ Floating WhatsApp Button & Popup --}}
<div id="waButton" class="wa-btn shadow"><i class="bi bi-whatsapp"></i></div>

<div id="waPopup" class="wa-popup shadow-lg">
  <div class="wa-popup-header d-flex align-items-center justify-content-between">
    <h6 class="mb-0 fw-semibold text-success"><i class="bi bi-whatsapp me-1"></i>Hubungi Kami</h6>
    <button class="btn-close btn-sm" onclick="toggleWAPopup()"></button>
  </div>
  <div class="wa-popup-body mt-2">
    <p class="small text-muted mb-2">Silakan pilih cara untuk menghubungi admin:</p>
    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20sistem%20inventaris."
       target="_blank" class="btn btn-success w-100 mb-2">
       <i class="bi bi-whatsapp me-1"></i> Buka WhatsApp App
    </a>
    <a href="https://web.whatsapp.com/send?phone=6281234567890&text=Halo%20Admin,%20saya%20ingin%20bertanya."
       target="_blank" class="btn btn-outline-success w-100">
       <i class="bi bi-laptop me-1"></i> Buka WhatsApp Web
    </a>
  </div>
</div>

<style>
  /* Reset margin dan padding untuk full width */
  body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }
  
  /* Custom Styles untuk Dashboard */
  .stat-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    border-radius: 10px;
    height: 100%;
  }
  
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
  }
  
  .chart-container {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border: none;
    height: 100%;
  }
  
  .chart-wrapper {
    position: relative;
    height: 250px;
    width: 100%;
  }
  
  /* WhatsApp Button Styles */
  .wa-btn {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background-color: #25D366;
    color: white;
    font-size: 28px;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    z-index: 2000;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }
  
  .wa-btn:hover { 
    background-color: #1ebe5d; 
    transform: scale(1.08); 
  }

  .wa-popup {
    position: fixed;
    bottom: 90px;
    right: 30px;
    width: 280px;
    background: #fff;
    border-radius: 15px;
    padding: 15px;
    z-index: 1999;
    display: none;
    animation: fadeInUp 0.4s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border: 1px solid #eaeaea;
  }
  
  .wa-popup.show { 
    display: block; 
  }

  .wa-popup-header {
    border-bottom: 1px solid #eaeaea;
    padding-bottom: 10px;
  }

  @keyframes fadeInUp {
    from { 
      opacity: 0; 
      transform: translateY(15px); 
    }
    to { 
      opacity: 1; 
      transform: translateY(0); 
    }
  }

  @media (max-width: 768px) {
    .wa-popup { 
      right: 15px; 
      width: calc(100% - 30px); 
      max-width: 300px;
    }
    
    .stat-card .card-body {
      padding: 1rem;
    }
    
    .chart-wrapper {
      height: 200px;
    }
    
    /* Untuk mobile, beri sedikit padding */
    .container-fluid {
      padding-left: 5px;
      padding-right: 5px;
    }
  }

  /* Untuk desktop, hilangkan semua padding */
  @media (min-width: 769px) {
    .container-fluid {
      padding-left: 0;
      padding-right: 0;
    }
  }
</style>

<script>
  // WhatsApp Popup Functionality
  const waButton = document.getElementById('waButton');
  const waPopup = document.getElementById('waPopup');
  
  waButton.addEventListener('click', toggleWAPopup);

  function toggleWAPopup() {
    waPopup.classList.toggle('show');
  }

  window.addEventListener('click', function(e) {
    if (!waPopup.contains(e.target) && !waButton.contains(e.target)) {
      waPopup.classList.remove('show');
    }
  });
</script>
@endsection