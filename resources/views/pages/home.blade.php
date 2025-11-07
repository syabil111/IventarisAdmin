@extends('layouts.admin.master')

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
{{-- ✅ Floating WhatsApp Button & Popup --}}
<div id="waButton" class="wa-btn">
  <div class="wa-pulse"></div>
  <i class="bi bi-whatsapp"></i>
</div>

<div id="waPopup" class="wa-popup shadow-lg">
  <div class="wa-popup-header d-flex align-items-center">
    <div class="wa-avatar me-2">
      <img src="https://i.ibb.co/hdMB7Gv/support-agent.png" alt="Admin">
    </div>
    <div>
      <h6 class="mb-0 fw-bold">Admin Inventaris</h6>
      <small class="text-success fw-semibold">Online • Siap membantu</small>
    </div>
    <button class="btn-close btn-sm ms-auto" onclick="toggleWAPopup()"></button>
  </div>

  <div class="wa-popup-body mt-2">
    <p class="small text-muted mb-2">Silakan pilih platform WhatsApp:</p>

    <a href="https://wa.me/6282283628922?text=Halo,%20saya%20ingin%20bertanya%20tentang%20sistem%20inventaris."
       target="_blank" class="btn wa-btn-main w-100 mb-2">
       <i class="bi bi-whatsapp me-1"></i> WhatsApp App (Mobile)
    </a>

    <a href="https://web.whatsapp.com/send?phone=6282283628922&text=Halo%20Admin,%20saya%20ingin%20bertanya."
       target="_blank" class="btn wa-btn-web w-100">
       <i class="bi bi-laptop me-1"></i> WhatsApp Web (Laptop/PC)
    </a>
  </div>
</div>

<style>
/* WhatsApp Button */
.wa-btn {
  position: fixed;
  bottom: 25px;
  right: 25px;
  width: 62px;
  height: 62px;
  background: linear-gradient(135deg, #25D366, #0fb34a);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 30px;
  cursor: pointer;
  z-index: 3000;
  transition: .3s;
  box-shadow: 0 6px 18px rgba(37, 211, 102, 0.5);
}

.wa-btn:hover {
  transform: scale(1.12) rotate(4deg);
}

/* Pulse Glow Animation */
.wa-pulse {
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(37, 211, 102, 0.4);
  border-radius: 50%;
  animation: pulse 1.8s infinite;
  z-index: -1;
}
@keyframes pulse {
  0% { transform: scale(0.8); opacity: .8; }
  100% { transform: scale(1.6); opacity: 0; }
}

/* Popup */
.wa-popup {
  position: fixed;
  bottom: 100px;
  right: 30px;
  width: 310px;
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(14px);
  border-radius: 18px;
  padding: 15px;
  display: none;
  z-index: 3100;
  animation: fadePop .4s ease;
  border: 1px solid rgba(255,255,255,0.3);
  box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}
.wa-popup.show { display: block; }

@keyframes fadePop {
  from { opacity: 0; transform: translateY(25px) scale(.92); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

/* Header */
.wa-popup-header {
  padding-bottom: 10px;
  border-bottom: 1px solid rgba(200,200,200,0.4);
}

/* Avatar */
.wa-avatar {
  width: 45px;
  height: 45px;
  background: #fff;
  border-radius: 50%;
  overflow: hidden;
  border: 2px solid #25D366;
  padding: 2px;
}
.wa-avatar img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
}

/* Buttons inside popup */
.wa-btn-main {
  background: #25D366;
  color: white;
  border-radius: 10px;
  font-weight: 600;
  transition: .25s;
}
.wa-btn-main:hover { background: #1ebe5d; }

.wa-btn-web {
  border: 2px solid #25D366;
  color: #25D366;
  border-radius: 10px;
  font-weight: 600;
}
.wa-btn-web:hover {
  background: #eaffef;
}

/* Mobile Fix */
@media (max-width: 768px) {
  .wa-popup { width: 90%; right: 5%; }
}
</style>

<script>
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
