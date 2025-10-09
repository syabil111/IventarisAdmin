<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Inventaris & Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { font-family: 'Poppins', sans-serif; }

        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            min-height: 100vh;
            width: 100vw;
            background: radial-gradient(circle at 25% 15%, #1e2a78, #0a1a3a 80%);
            color: #fff;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .aurora {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 180vw;
            height: 180vh;
            background: conic-gradient(from 180deg, #2B32B2, #1488CC, #00C9A7, #2B32B2);
            filter: blur(140px);
            opacity: 0.42;
            z-index: 1;
            animation: auroraMove 13s infinite linear;
        }
        @keyframes auroraMove {
            0% { transform: translate(-50%, -50%) rotate(0deg) scale(1); }
            50% { transform: translate(-50%, -50%) rotate(180deg) scale(1.08); }
            100% { transform: translate(-50%, -50%) rotate(360deg) scale(1); }
        }
        
        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 42px 37px;
            background: rgba(255, 255, 255, 0.10);
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,0.18);
            backdrop-filter: blur(18px);
            box-shadow: 0 15px 48px rgba(20,40,80,0.27);
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeUp 0.9s ease-out;
        }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(40px);}
            100%{opacity:1;transform:translateY(0);}
        }

        .icon-logo {
            font-size: 52px;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            box-shadow: 0 0 30px rgba(0,198,255,0.4);
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); box-shadow:0 0 0 rgba(0,198,255,0.3);}
            50% { transform: scale(1.07); box-shadow:0 0 25px rgba(0,198,255,0.7);}
            100%{transform:scale(1);box-shadow:0 0 0 rgba(0,198,255,0.3);}
        }
        .login-header { text-align:center; margin-bottom:27px;}
        .login-header h3 { font-weight: 600; color: #fff; }
        .login-header p { color: #cfd9ff; font-size: 0.96rem;}

        label {
            color: #dfe8ff;
            font-weight: 500;
            margin-bottom: 7px;
        }
        .form-control {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            height: 46px;
            border-radius: 11px;
            margin-bottom: 5px;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.68);}
        .form-control:focus {
            background: rgba(255,255,255,0.23);
            border-color: #00C9A7;
            box-shadow: 0 0 11px rgba(0,201,167,0.42);
        }

        .btn-login {
            margin-top: 8px;
            background: linear-gradient(135deg, #2B32B2, #1488CC);
            border: none;
            border-radius: 12px;
            padding: 12px 0;
            font-weight:600;
            color:#fff;
            width:100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 18px rgba(20,136,204,0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-login:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow:0 10px 30px rgba(20,136,204,0.47);
        }
        .footer-text {
            text-align: center;
            color: #cfd9ff;
            font-size: 13px;
            margin-top: 28px;
        }
        .footer-text span {
            color: #fff;
            font-weight: 600;
        }
        @media(max-width:575px){
            .login-container {
                max-width:95vw;
                padding:32px 8vw;
            }
        }
    </style>
</head>
<body>
    <div class="aurora"></div>
    <div class="login-container">
        <div class="login-header">
            <div class="icon-logo"><i class="bi bi-box-seam"></i></div>
            <h3>Inventaris & Aset</h3>
            <p>Kelola aset Anda dengan mudah dan elegan</p>
        </div>
        <form id="loginForm">
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Masukkan username" required autocomplete="off">
            </div>
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Masukkan password" required autocomplete="off">
            </div>
            <button type="submit" class="btn-login">
                <i class="bi bi-door-open me-1"></i>Masuk Sekarang
            </button>
        </form>
        <div class="footer-text">
            © <span id="year"></span> <span>Sistem Inventaris & Aset</span><br>Semua Hak Dilindungi
        </div>
    </div>
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
        function showPopup(type, title, html, anim){
            Swal.fire({
                icon: type,
                title: title,
                html: html,
                background: 'linear-gradient(135deg, rgba(30,40,90,0.92), rgba(0,150,200,0.85))',
                color: '#fff',
                width: 410,
                padding: '2.1em',
                confirmButtonColor: '#1488CC',
                customClass: {
                    popup: 'animate__animated ' + anim,
                    title: 'fw-bold',
                    confirmButton: 'rounded-pill px-4 py-2 fw-semibold'
                },
                backdrop: 'rgba(0,14,60,0.43) blur(8px)'
            });
        }
        function login() {
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();
            // Jika kosong
            if(!username || !password){
                showPopup(
                    'warning',
                    'Input Tidak Lengkap',
                    `<div style="color:#fff;font-size:0.97rem;margin-top:-9px;">Harap isi <b>username</b> dan <b>password</b> terlebih dahulu.</div>`,
                    'animate__fadeInDown animate__faster'
                );
                return;
            }
            // Validasi Password
            if(password.length < 3 || !(/[A-Z]/.test(password))){
                showPopup(
                    'error',
                    'Password Tidak Valid',
                    `<div style="color:#fff;font-size:0.97rem;margin-top:-9px;">
                        Password harus minimal <b>3 karakter</b> dan mengandung <b>huruf kapital</b>.
                    </div>`,
                    'animate__shakeX animate__faster'
                );
                return;
            }
            // Login Berhasil
            Swal.fire({
                html: `
                    <div style="display:flex;flex-direction:column;align-items:center;gap:18px;">
                        <div style="
                            position:relative;
                            width:100px;height:100px;
                            background:linear-gradient(135deg,#1488CC,#2B32B2);
                            border-radius:50%;
                            display:flex;align-items:center;justify-content:center;
                            box-shadow:0 0 35px rgba(20,136,204,0.23);
                            animation:floatIcon 2s infinite ease-in-out;">
                            <i class='bi bi-check2-all' style='font-size:48px;color:white;z-index:3;'></i>
                            <div style="
                                position:absolute;
                                width:140px;height:140px;
                                border:3px solid rgba(255,255,255,0.25);
                                border-radius:50%;
                                animation:spinLight 5s linear infinite;"></div>
                        </div>
                        <h2 style="color:#fff;font-weight:600;font-size:1.25rem;">Login Berhasil!</h2>
                        <div style="color:#d1eaff;font-size:0.98rem;margin-top:-5px;">Selamat datang di <b>Sistem Inventaris & Aset</b></div>
                    </div>
                `,
                background: 'linear-gradient(135deg, rgba(20,40,120,0.96), rgba(0,150,200,0.93))',
                width: 430,
                padding: '2.6em',
                showConfirmButton: false,
                timer: 2200,
                customClass: {
                    popup: 'animate__animated animate__fadeInUp animate__faster'
                },
                backdrop: 'rgba(10,20,45,0.77) blur(13px)',
                didOpen: () => {
                    const popup = document.querySelector('.swal2-popup');
                    popup.style.backdropFilter = 'blur(15px)';
                    popup.style.borderRadius = '26px';
                    popup.style.boxShadow = '0 0 44px rgba(0,200,255,0.22)';
                }
            });
            setTimeout(()=>{ window.location.href="/home"; },2200);
        }
        document.getElementById("loginForm").addEventListener("submit", function(e){
            e.preventDefault();
            login();
        });
    </script>
    <style>
        @keyframes spinLight { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes floatIcon { 0% { transform: translateY(0); } 50% { transform: translateY(-10px); } 100% { transform: translateY(0); } }
    </style>
</body>
</html>
