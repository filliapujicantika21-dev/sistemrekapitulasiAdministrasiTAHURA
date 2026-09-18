```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Rekapitulasi Administrasi Tahura</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        /* MAIN */
        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
        }

        /* LEFT */
        .left-side {
            width: 55%;
            height: 100vh;
            background:
                linear-gradient(120deg, rgba(0, 60, 35, .85), rgba(0, 0, 0, .35)),
                url('{{ asset('images/tahura.png') }}');
            background-size: cover;
            background-position: center;
        }

        .left-content {
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 70px;
            color: white;
            animation: leftShow .8s ease;
        }

        .badge-tahura {
            background: #159A68;
            padding: 7px 18px;
            border-radius: 30px;
            width: max-content;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .left-content h1 {
            font-size: 42px;
            line-height: 1.15;
            font-weight: 800;
            margin: 0;
        }

        .left-content p {
            font-size: 17px;
            max-width: 430px;
            margin-top: 20px;
        }

        /* SYSTEM MENU LEFT */
        .system-info {
            margin-top: 40px;
            width: 420px;
        }

        .system-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 14px;
            color: white;
        }

        .system-title span {
            width: 45px;
            height: 1px;
            background: rgba(255, 255, 255, .5);
        }

        .system-menu {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .system-item {
            text-align: center;
            font-size: 13px;
            color: white;
        }

        .system-item p {
            margin-top: 8px;
            margin-bottom: 0;
            font-weight: 500;
        }

        .system-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: white;
            color: #086B45;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 18px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .15);
        }

        /* RIGHT */
        .right-side {
            width: 45%;
            height: 100vh;
            background: linear-gradient(135deg, #06452F, #08784d);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* LOGIN CARD */
        .login-box {
            width: 100%;
            max-width: 380px;
            padding: 25px 32px 20px;
            background: rgba(255, 255, 255, .95);
            backdrop-filter: blur(15px);
            border-radius: 24px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
            position: relative;
            display: flex;
            flex-direction: column;
            animation: cardShow .8s ease;
        }

        @keyframes cardShow {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes leftShow {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* LOGO */
        .logo-login {
            display: block;
            width: 65px;
            height: 65px;
            object-fit: contain;
            margin: 0 auto 15px;
            background: white;
            border-radius: 50%;
            padding: 6px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .15);
        }

        /* TEXT */
        .login-box h3 {
            text-align: center;
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            color: #086B45;
        }

        /* INPUT */
        .form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .input-group-text {
            height: 45px;
            width: 42px;
            background: #f5f7f6;
            border: none;
            justify-content: center;
            color: #6c757d;
        }

        .form-control {
            height: 45px;
            border: none;
            background: #f5f7f6;
            font-size: 14px;
        }

        .form-control:focus {
            background: white;
            box-shadow: 0 0 0 3px rgba(21, 154, 104, .18);
        }

        .btn-eye {
            cursor: pointer;
        }

        /* BUTTON */
        .btn-login {
            height: 45px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            color: white;
            background: linear-gradient(90deg, #086B45, #159A68);
            transition: .3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(21, 154, 104, .35);
            color: white;
        }

        /* FOOTER */
        .footer-login {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            line-height: 1.5;
            color: #777;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            html,
            body {
                overflow: auto;
            }

            .login-container {
                display: block;
            }

            .left-side,
            .right-side {
                width: 100%;
                height: auto;
                min-height: 50vh;
            }

            .left-content {
                padding: 35px;
            }

            .left-content h1 {
                font-size: 30px;
            }

            .system-info {
                width: 100%;
            }

            .login-box {
                width: 100%;
                max-width: 380px;
                padding: 25px 32px 25px;
                background: rgba(255, 255, 255, .95);
                border-radius: 24px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">

        <!-- LEFT SIDE -->
        <div class="left-side">
            <div class="left-content">
                <span class="badge-tahura">TAHURA SULTAN ADAM</span>

                <h1>
                    Sistem Rekapitulasi<br>
                    Administrasi Tahura
                </h1>

                <p>
                    Kelola data Reservasi Vila, Retribusi,
                    dan Logistik secara Digital dan Terintegrasi.
                </p>

                <!-- SYSTEM INFO -->
                <div class="system-info">
                    <div class="system-title">
                        <span></span>
                        Sistem Informasi Tahura
                        <span></span>
                    </div>

                    <div class="system-menu">
                        <div class="system-item">
                            <div class="system-icon">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <p>Reservasi Vila</p>
                        </div>

                        <div class="system-item">
                            <div class="system-icon">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                            <p>Retribusi</p>
                        </div>

                        <div class="system-item">
                            <div class="system-icon">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            <p>Logistik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="right-side">
            <div class="login-box">

                <img
                    src="{{ asset('images/logo-tahura.png') }}"
                    class="logo-login"
                    alt="Logo Tahura"
                >

                <h3>Selamat Datang</h3>

                <p class="text-center mb-3">
                    Silakan login untuk melanjutkan
                </p>

                @if(session('error'))
                    <div class="alert alert-danger py-2">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf

                    <!-- USERNAME -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Masukkan username"
                                required
                            >
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </span>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required
                            >

                            <button
                                type="button"
                                class="input-group-text btn-eye"
                                onclick="lihatPassword()"
                            >
                                <i class="fa-solid fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- BUTTON LOGIN -->
                    <div class="mt-4">
                        <button
                            type="submit"
                            class="btn btn-login w-100"
                        >
                            <i class="fa-solid fa-right-to-bracket"></i>
                            &nbsp;
                            Masuk Sistem
                        </button>
                    </div>
                </form>

                <!-- COPYRIGHT -->
                <div class="footer-login">
                    © 2026 Sistem Rekapitulasi<br>
                    Administrasi Tahura
                </div>
            </div>
        </div>
    </div>

    <script>
        function lihatPassword() {
            const password = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
```
