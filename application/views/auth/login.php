<!doctype html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/') ?>" data-template="vertical-menu-template">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login - SunSmart SPK</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fontawesome.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/tabler-icons.css') ?>" />
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/core.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/theme-default.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #7367F0 0%, #9E95F5 100%);
            --secondary-gradient: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            --card-shadow: 0 20px 40px rgba(115, 103, 240, 0.1);
        }
        
        body {
            font-family: 'Inter', 'Public Sans', sans-serif;
            background: linear-gradient(135deg, #f5f7ff 0%, #f0f2ff 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 300px;
            background: var(--primary-gradient);
            clip-path: ellipse(100% 80% at 50% 0%);
            z-index: -1;
        }
        
        .authentication-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
        }
        
        .authentication-inner {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            border: none;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(115, 103, 240, 0.15);
        }
        
        .card-header {
            background: var(--primary-gradient);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            border-radius: 24px 24px 0 0;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            opacity: 0.1;
            animation: float 20s linear infinite;
        }
        
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-50px, -50px) rotate(360deg); }
        }
        
        .app-brand {
            margin-bottom: 1.5rem;
        }
        
        .app-brand-logo {
            background: white;
            border-radius: 16px;
            padding: 12px;
            box-shadow: 0 10px 20px rgba(115, 103, 240, 0.2);
            display: inline-block;
            transition: transform 0.3s ease;
        }
        
        .app-brand-logo:hover {
            transform: rotate(15deg) scale(1.1);
        }
        
        .app-brand-text {
            font-size: 1.75rem;
            font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.9) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .welcome-text {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            font-weight: 400;
        }
        
        .card-body {
            padding: 2.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #2a3042;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .form-control {
            border: 2px solid #e6e6f2;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-control:focus {
            border-color: #7367F0;
            box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.15);
            background: white;
        }
        
        .form-control::placeholder {
            color: #a8a9c5;
        }
        
        .input-group {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .input-group-text {
            background: #f8f9ff;
            border: 2px solid #e6e6f2;
            border-left: none;
            color: #7367F0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .input-group-text:hover {
            background: #7367F0;
            color: white;
        }
        
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(115, 103, 240, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(115, 103, 240, 0.4);
            background: linear-gradient(135deg, #6a59e6 0%, #8a7ff2 100%);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .alert-message {
            animation: slideIn 0.5s ease;
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .additional-links {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .additional-links a {
            color: #7367F0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .additional-links a:hover {
            color: #5a52d5;
            text-decoration: underline;
        }
        
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }
        
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(115, 103, 240, 0.1) 0%, rgba(115, 103, 240, 0.05) 100%);
            animation: floatElement 15s infinite ease-in-out;
        }
        
        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            bottom: 15%;
            right: 10%;
            animation-delay: -5s;
        }
        
        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 50%;
            left: 10%;
            animation-delay: -10s;
        }
        
        @keyframes floatElement {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
        
        @media (max-width: 768px) {
            .authentication-inner {
                padding: 1rem;
            }
            
            .card-body {
                padding: 2rem;
            }
            
            body::before {
                height: 200px;
            }
        }
        
        @media (max-width: 480px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .card-header {
                padding: 2rem 1.5rem 1.5rem;
            }
            
            .welcome-text {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body>
    <!-- Floating background elements -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                
                <div class="card login-card">
                    <div class="card-header">
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="<?= base_url() ?>" class="app-brand-link gap-2 d-flex align-items-center">
                                <span class="app-brand-logo demo">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="url(#paint0_linear)" fill-opacity="0.2"/>
                                        <path d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18Z" fill="#FFFFFF"/>
                                        <path d="M12 4V2M12 22V20M4 12H2M22 12H20M6.34 6.34L4.93 4.93M19.07 19.07L17.66 17.66M6.34 17.66L4.93 19.07M19.07 4.93L17.66 6.34" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="12" y1="2" x2="12" y2="22" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFFFFF"/>
                                                <stop offset="1" stop-color="#FFFFFF" stop-opacity="0"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </span>
                                <span class="app-brand-text demo fw-bold ms-2">SunSmart SPK</span>
                            </a>
                        </div>
                        <h4 class="welcome-text mb-2">Selamat Datang! 👋</h4>
                        <p class="subtitle mb-0">Silakan login untuk mengelola sistem pendukung keputusan.</p>
                    </div>
                    
                    <div class="card-body">
                        <?php if($this->session->flashdata('message')): ?>
                        <div class="alert alert-info alert-message mb-4">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <?php endif; ?>

                        <form id="formAuthentication" class="mb-3" action="<?= base_url('auth/process') ?>" method="POST">
                            <div class="mb-4">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="ti ti-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" autofocus required />
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label" for="password">Password</label>
                                    <!--
                                    <a href="<?= base_url('auth/forgot-password') ?>" class="text-decoration-none small" style="color: #7367F0;">
                                        Lupa password?
                                    </a>
                                    -->
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan password" aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer password-toggle"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            
                            <!--
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember-me">
                                <label class="form-check-label" for="remember-me">Ingat saya</label>
                            </div>
                            -->
                            
                            <div class="mb-4">
                                <button class="btn btn-primary d-grid w-100" type="submit">
                                    <span class="d-flex align-items-center justify-content-center">
                                        <i class="ti ti-login me-2"></i>
                                        <span>Masuk ke Sistem</span>
                                    </span>
                                </button>
                            </div>
                        </form>

                        <!--
                        <div class="additional-links">
                            <p class="mb-0">Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar sekarang</a></p>
                        </div>
                        -->
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-muted small">© 2024 SunSmart SPK. Sistem Pendukung Keputusan</p>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
    
    <script>
        $(document).ready(function() {
            // Password toggle functionality
            $('.password-toggle').on('click', function() {
                const passwordInput = $(this).siblings('input');
                const icon = $(this).find('i');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('ti-eye-off').addClass('ti-eye');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('ti-eye').addClass('ti-eye-off');
                }
            });
            
            // Form validation and animation
            $('#formAuthentication').on('submit', function(e) {
                const username = $('#username').val();
                const password = $('#password').val();
                
                if (!username.trim() || !password.trim()) {
                    e.preventDefault();
                    
                    // Add shake animation to empty fields
                    if (!username.trim()) {
                        $('#username').addClass('is-invalid');
                        $('#username').css('animation', 'shake 0.5s');
                    }
                    
                    if (!password.trim()) {
                        $('#password').addClass('is-invalid');
                        $('#password').css('animation', 'shake 0.5s');
                    }
                    
                    // Remove animation after it completes
                    setTimeout(() => {
                        $('.form-control').css('animation', '');
                    }, 500);
                    
                    return false;
                }
                
                // Add loading state to button
                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span>Memproses...');
                submitBtn.prop('disabled', true);
            });
            
            // Remove invalid state when user starts typing
            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid');
            });
            
            // Add shake animation CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }
                
                .is-invalid {
                    border-color: #ff3e1d !important;
                    background-color: rgba(255, 62, 29, 0.05) !important;
                }
                
                .form-control:focus.is-invalid {
                    box-shadow: 0 0 0 3px rgba(255, 62, 29, 0.15) !important;
                }
            `;
            document.head.appendChild(style);
            
            // Auto focus username field with animation
            setTimeout(() => {
                $('#username').focus();
                $('#username').parent().addClass('input-focused');
            }, 500);
        });
    </script>
</body>
</html>