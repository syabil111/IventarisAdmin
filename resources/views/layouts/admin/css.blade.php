 <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">
 <style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .sidebar {
    width: 240px;
    background: linear-gradient(180deg, #1b3c53, #456882);
    color: white;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    z-index: 1000;
  }

  .sidebar-header {
    font-size: 1.3rem;
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
  }

  .nav-link {
    color: #cfd8dc;
    padding: 12px 20px;
    transition: all 0.3s ease;
  }

  .nav-link:hover,
  .nav-link.active {
    background-color: rgba(255, 255, 255, 0.15);
    color: #fff;
    padding-left: 25px;
  }

  .nav-link i {
    margin-right: 8px;
  }

  .logout-section {
    text-align: center;
    padding: 15px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }

  .logout-btn {
    background-color: #dc3545;
    border: none;
    color: #fff;
    font-weight: 500;
    border-radius: 8px;
    padding: 8px 15px;
    transition: background 0.3s ease;
  }

  .logout-btn:hover {
    background-color: #bb2d3b;
  }

  .main-content {
    margin-left: 240px;
    flex: 1;
    padding: 25px;
    transition: all 0.3s ease;
  }

  .fade-in {
    animation: fadeIn 0.5s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  footer {
    background: #ffffff;
    border-top: 1px solid #e9ecef;
    text-align: center;
    padding: 12px 0;
    color: #6c757d;
    font-size: 14px;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.03);
  }

  @media (max-width: 992px) {
    .sidebar {
      transform: translateX(-100%);
    }

    .sidebar.show {
      transform: translateX(0);
    }

    .main-content {
      margin-left: 0;
    }
  }
</style>
