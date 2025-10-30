<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventaris & Aset - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @include('layouts.css')
</head>

<body>
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
    </div>

    <div class="auth-container">
        <div class="auth-card">
            <!-- Left Side - Branding -->
            <div class="auth-left">
                <div class="auth-logo">
                    <i class="bi bi-building-gear"></i>
                </div>
                <div class="auth-content">
                    <h1>Inventaris & Aset</h1>
                    <h1> PT. BESMINDO </h1>
                    <ul class="features-list">
                        
                           
                      
                    </ul>
                </div>
            </div>

            <!-- Right Side - Forms -->
            <div class="auth-right">
                <div class="form-container">
                    <!-- Toggle Buttons -->
                    <div class="form-toggle">
                        <button class="toggle-btn active" data-form="login">Masuk</button>
                        <button class="toggle-btn" data-form="register">Daftar</button>
                    </div>

                    <!-- Login Form -->
                    <div class="form-panel active" id="login-form">
                        <h2 class="form-title">Masuk ke Akun</h2>
                        <p class="form-subtitle">Selamat datang kembali! Masuk untuk melanjutkan.</p>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="login_email" class="form-label">Email</label>
                                <input type="email" name="email" id="login_email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       class="form-control"
                                       placeholder="Masukkan email Anda">
                            </div>

                            <div class="form-group">
                                <label for="login_password" class="form-label">Password</label>
                                <input type="password" name="password" id="login_password" 
                                       required 
                                       class="form-control"
                                       placeholder="Masukkan password Anda">
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Ingat saya
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn-auth">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                            </button>
                        </form>

                        <div class="auth-switch">
                            Belum punya akun? <a href="#" class="switch-to-register">Daftar Sekarang</a>
                        </div>
                    </div>

                    <!-- Register Form -->
                    <div class="form-panel" id="register-form">
                        <h2 class="form-title">Buat Akun Baru</h2>
                        <p class="form-subtitle">Daftar untuk mulai mengelola inventaris Anda.</p>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" 
                                       placeholder="Masukkan nama lengkap" 
                                       required 
                                       value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" 
                                       placeholder="Masukkan email Anda" 
                                       required 
                                       value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" 
                                       placeholder="Buat password (minimal 8 karakter)" 
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" 
                                       placeholder="Ulangi password" 
                                       required>
                            </div>
                            <button type="submit" class="btn-auth btn-register">
                                <i class="bi bi-person-plus me-2"></i>Daftar
                            </button>
                        </form>

                        <div class="auth-switch">
                            Sudah punya akun? <a href="#" class="switch-to-login">Masuk Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtns = document.querySelectorAll('.toggle-btn');
            const formPanels = document.querySelectorAll('.form-panel');
            const switchToRegister = document.querySelector('.switch-to-register');
            const switchToLogin = document.querySelector('.switch-to-login');

            // Toggle between forms
            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetForm = this.getAttribute('data-form');
                    
                    // Update active toggle button
                    toggleBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show target form
                    formPanels.forEach(panel => {
                        panel.classList.remove('active');
                        if (panel.id === `${targetForm}-form`) {
                            setTimeout(() => panel.classList.add('active'), 50);
                        }
                    });
                });
            });

            // Switch from login to register
            switchToRegister.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('.toggle-btn[data-form="register"]').click();
            });

            // Switch from register to login
            switchToLogin.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('.toggle-btn[data-form="login"]').click();
            });

            // Add input animations
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Debug form submission
            const loginForm = document.querySelector('#login-form form');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    console.log('Login form submitted');
                    console.log('Email:', document.querySelector('#login_email').value);
                    console.log('Form action:', this.action);
                });
            }
        });
    </script>
</body>
</html>