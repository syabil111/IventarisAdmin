<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Inventaris & Aset</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-blue: #1488CC;
      --secondary-blue: #2B32B2;
      --text-light: #e0f0ff;
      --bg-dark: #0a1a3a;
      --bg-gradient-start: #1e2a78;
    }
    
    * {
      font-family: 'Poppins', sans-serif;
    }

    /* Base Body & Background */
    html, body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background: radial-gradient(circle at 25% 15%, var(--bg-gradient-start), var(--bg-dark) 85%);
      color: #fff;
      overflow-x: hidden;
      scroll-behavior: smooth;
    }

    /* --- Aurora Glow Background --- */
    .aurora {
      position: fixed;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 200vw;
      height: 200vh;
      background: conic-gradient(from 180deg, var(--secondary-blue), var(--primary-blue), #00C9A7, var(--secondary-blue));
      filter: blur(180px); /* Increased blur for smoother effect */
      opacity: 0.2; /* Slightly reduced opacity */
      z-index: 0;
      animation: auroraMove 24s infinite linear; /* Slower animation */
    }

    @keyframes auroraMove {
      0% { transform: translate(-50%, -50%) rotate(0deg) scale(1); }
      50% { transform: translate(-50%, -50%) rotate(180deg) scale(1.1); }
      100% { transform: translate(-50%, -50%) rotate(360deg) scale(1); }
    }

    /* --- Navbar --- */
    .navbar {
      background: rgba(255,255,255,0.05) !important; /* Slightly more transparent */
      backdrop-filter: blur(18px); /* Increased blur */
      border-bottom: 1px solid rgba(255,255,255,0.1);
      position: sticky;
      top: 0;
      z-index: 10;
      padding: 14px 6%; /* Increased padding */
      box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow */
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.4rem; /* Slightly larger */
      color: #fff !important;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .icon-navbar {
      font-size: 26px; /* Slightly larger icon */
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      width: 45px;
      height: 45px;
      line-height: 45px;
      border-radius: 50%;
      box-shadow: 0 0 18px rgba(0,198,255,0.3); /* Softer shadow */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-logout {
      background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
      border: none;
      border-radius: 18px; /* More rounded */
      padding: 10px 25px;
      color: #fff;
      font-weight: 600;
      box-shadow: 0 4px 18px rgba(43,50,178,0.35);
      transition: all 0.4s ease;
    }

    .btn-logout:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(20,136,204,0.45);
      opacity: 0.9;
    }

    /* --- Dashboard Main Content --- */
    .dashboard-container {
      position: relative;
      z-index: 2;
      min-height: calc(100vh - 80px);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 60px 15px;
    }

    .dashboard-box {
      background: rgba(255,255,255,0.06); /* More subtle background */
      backdrop-filter: blur(20px); /* Increased blur for depth */
      border-radius: 40px; /* More rounded corners */
      padding: 70px 50px;
      max-width: 550px; /* Slightly wider */
      box-shadow: 0 15px 50px rgba(20,40,80,0.3); /* Deeper, softer shadow */
      border: 1px solid rgba(255,255,255,0.1); /* Subtle border for definition */
      animation: fadeInUp 1.6s ease;
      transition: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smoother transition */
    }

    .dashboard-box:hover {
      transform: translateY(-10px) scale(1.02); /* More pronounced lift and slight scale */
      box-shadow: 0 25px 75px rgba(20,136,204,0.35);
    }

    .dashboard-icon {
      font-size: 85px; /* Larger icon */
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      box-shadow: 0 0 45px rgba(0,198,255,0.5), inset 0 0 20px rgba(255,255,255,0.2); /* Added inner shadow */
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 30px auto;
      animation: pulse 2.5s infinite cubic-bezier(0.4, 0, 0.6, 1); /* Smoother pulse */
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); box-shadow:0 0 0 rgba(0,198,255,0.0); }
      50% { transform: scale(1.05); box-shadow:0 0 35px rgba(0,198,255,0.5); }
    }

    .dashboard-title {
      font-size: 2.2rem; /* Larger title */
      font-weight: 700;
      margin-bottom: 12px;
      letter-spacing: 0.5px;
      text-shadow: 0 2px 4px rgba(0,0,0,0.4);
    }

    .dashboard-desc {
      font-size: 1.1rem;
      color: var(--text-light);
      margin-bottom: 45px; /* More spacing */
      line-height: 1.6;
      font-weight: 400;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      padding-top: 15px; /* Added padding for separation */
    }

    /* Adjusted for single button style */
    .btn-dashboard {
      border: none;
      border-radius: 18px; /* Consistent rounding */
      padding: 16px 45px;
      font-weight: 600;
      font-size: 1.1rem; /* Slightly larger text */
      display: flex;
      align-items: center;
      gap: 10px;
      letter-spacing: 0.5px;
      transition: all 0.4s ease;
      text-decoration: none;
    }

    .btn-dashboard-primary {
      background: linear-gradient(135deg, #00c6ff, #0072ff); /* Brighter gradient for the button */
      color: #fff;
      box-shadow: 0 8px 25px rgba(0,114,255,0.4);
    }

    .btn-dashboard-primary:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 35px rgba(0,114,255,0.55);
      filter: brightness(1.1);
    }

    footer {
      margin-top: 75px; /* Increased margin */
      color: var(--text-light);
      font-size: 15px; /* Slightly larger text */
      font-weight: 300;
    }

    footer span {
      color: #fff;
      font-weight: 600;
      text-shadow: 0 0 5px rgba(255,255,255,0.2);
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(80px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 576px) {
      .dashboard-box {
        width: 100%;
        padding: 50px 30px;
      }
      .navbar {
        padding: 14px 4%;
      }
      .dashboard-title {
        font-size: 1.8rem;
      }
      .btn-dashboard {
        font-size: 1rem;
        padding: 14px 30px;
      }
    }
  </style>
</head>

<body>
  <div class="aurora"></div>

  <nav class="navbar navbar-dark">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="navbar-brand" href="#">
        <span class="icon-navbar"><i class="bi bi-box-seam"></i></span>
        Inventaris & Aset
      </a>
      <a href="/auth/login" class="btn-logout">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </a>
    </div>
  </nav>

  <section class="dashboard-container">
    <div class="dashboard-box">
      <div class="dashboard-icon">
        <i class="bi bi-box-seam"></i>
      </div>
      <h1 class="dashboard-title">Selamat Datang di Dashboard</h1>
      <p class="dashboard-desc">
      </p>

      <div class="action-buttons">
        <a href="/admin" class="btn-dashboard btn-dashboard-primary">
          <i class="bi bi-database"></i> Kelola Data Aset
        </a>
      </div>

      <footer>
        © 2025 <span>Sistem Inventaris & Aset</span> — Semua Hak Dilindungi
      </footer>
    </div>
  </section>
</body>
</html>