<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Sistem Inventaris & Aset')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  @include('layouts.admin.css')

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Sidebar agar fix di kiri */
    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: #fff;
      min-height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 20px;
      transition: all 0.3s ease;
    }

    .main-content {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 20px;
      transition: all 0.3s ease;
    }

    /* Animasi fade-in */
    .fade-in {
      animation: fadeIn 0.4s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(5px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsif */
    @media (max-width: 992px) {
      .sidebar {
        width: 100%;
        position: relative;
      }
      .main-content {
        margin-left: 0;
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <!-- SIDEBAR -->
  @include('layouts.admin.sidebar')

  <!-- MAIN CONTENT -->
  <div class="main-content fade-in">
    @yield('content')
  </div>

  <!-- FOOTER -->
  @include('layouts.admin.footer')

  <!-- JS -->

  @include('layouts.admin.scripts')

</body>
</html>
