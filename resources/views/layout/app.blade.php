```php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Informasi TAHURA')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #198754;
            color: white;
            overflow-y: auto;
            padding: 20px;
            z-index: 1000;
        }

        /* BRAND */
        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .brand h4 {
            margin: 0;
            font-weight: bold;
        }

        .brand small {
            opacity: .8;
        }

        /* MENU TITLE */
        .menu-title {
            font-size: 12px;
            color: #dcdcdc;
            text-transform: uppercase;
            margin: 20px 0 10px;
        }

        /* SIDEBAR LINK */
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 6px;
            transition: .3s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, .18);
        }

        .sidebar a.active {
            background: white;
            color: #198754;
            font-weight: bold;
        }

        .menu-icon {
            width: 25px;
            display: inline-block;
        }

        /* SUBMENU */
        .submenu {
            display: none;
            margin-left: 20px;
        }

        .submenu a {
            font-size: 14px;
            padding: 10px;
        }

        .arrow {
            float: right;
            transition: .3s;
        }

        /* CONTENT */
        .content {
            margin-left: 260px;
            padding: 25px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        .topbar h5 {
            margin: 0;
            font-weight: 600;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            font-size: 20px;
            font-weight: bold;
        }

        /* TABLE */
        .table th {
            text-align: center;
        }

        .table td {
            vertical-align: middle;
        }

        /* BUTTON */
        .btn {
            border-radius: 10px;
        }

        /* FOOTER */
        footer {
            margin-top: 40px;
            padding: 20px;
            background: #198754;
            color: white;
            text-align: center;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <!-- BRAND -->
        <div class="brand">
            <img src="{{ asset('images/logo-tahura.png') }}" class="logo" alt="Logo TAHURA">
            <h4>TAHURA</h4>
            <small>Sistem Informasi TAHURA</small>
        </div>

        <!-- MENU UTAMA -->
        <div class="menu-title">Menu Utama</div>

        <!-- DASHBOARD -->
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <i class="fa-solid fa-house"></i>
            </span>
            Dashboard
        </a>

        <!-- RESERVASI -->
        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'reservasi')
            <a href="{{ route('reservasi.index') }}"
               class="{{ request()->routeIs('reservasi.*') ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i>
                Reservasi Villa
            </a>
        @endif

        <!-- RETRIBUSI -->
        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'retribusi')
            <a href="{{ route('retribusi.index') }}"
               class="{{ request()->routeIs('retribusi.*') ? 'active' : '' }}">
                <i class="fa-solid fa-money-bill"></i>
                Retribusi
            </a>
        @endif

        <!-- SEWA FASILITAS -->
        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'sewa')
            <a href="{{ route('sewa-fasilitas.index') }}"
               class="{{ request()->routeIs('sewa-fasilitas.*') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                Sewa Fasilitas
            </a>
        @endif

        <!-- LOGISTIK -->
        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'logistik')
            <a href="javascript:void(0)" onclick="toggleLogistik()">
                <span class="menu-icon">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </span>
                Logistik
                <i id="arrowLogistik" class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div id="submenuLogistik" class="submenu">
                <!-- KATEGORI -->
                <a href="{{ route('kategori.index') }}"
                   class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i>
                    Kategori
                </a>

                <!-- BARANG MASUK -->
                <a href="{{ route('barang-masuk.index') }}"
                   class="{{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-arrow-down"></i>
                    Barang Masuk
                </a>

                <!-- BARANG KELUAR -->
                <a href="{{ route('barang-keluar.index') }}"
                   class="{{ request()->routeIs('barang-keluar.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-arrow-up"></i>
                    Barang Keluar
                </a>

                <!-- DATA PERSEDIAAN -->
                <a href="{{ route('persediaan.index') }}"
                   class="{{ request()->routeIs('persediaan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-clipboard-list"></i>
                    Data Persediaan
                </a>
            </div>
        @endif
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <h5>@yield('page_title', 'Dashboard')</h5>
                <small class="text-muted">Sistem Informasi TAHURA</small>
            </div>

            <!-- USER -->
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown">
                    <i class="fa-solid fa-user"></i>
                    {{ Auth::user()->name ?? 'User' }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="javascript:void(0)"
                           class="dropdown-item text-danger"
                           onclick="logoutConfirm()">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- FLASH SUCCESS -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: @json(session('success')),
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        <!-- FLASH ERROR -->
        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: @json(session('error'))
                    });
                });
            </script>
        @endif

        <!-- CONTENT HALAMAN -->
        @yield('content')

        <!-- FOOTER -->
        <footer>
            <h5>TAHURA</h5>
            <p class="mb-0">
                © {{ date('Y') }} Sistem Informasi TAHURA
            </p>
        </footer>
    </div>

    <!-- LOGOUT FORM -->
    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display:none">
        @csrf
    </form>

    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* TOGGLE LOGISTIK */
        function toggleLogistik() {
            let menu = document.getElementById('submenuLogistik');
            let arrow = document.getElementById('arrowLogistik');

            if (menu.style.display === "block") {
                menu.style.display = "none";
                arrow.style.transform = "rotate(0deg)";
            } else {
                menu.style.display = "block";
                arrow.style.transform = "rotate(180deg)";
            }
        }

        /* AUTO OPEN LOGISTIK */
        document.addEventListener("DOMContentLoaded", function () {
            let isLogistik = false;

            @if(
                request()->routeIs('kategori.*') ||
                request()->routeIs('barang-masuk.*') ||
                request()->routeIs('barang-keluar.*') ||
                request()->routeIs('persediaan.*')
            )
                isLogistik = true;
            @endif

            if (isLogistik) {
                document.getElementById('submenuLogistik').style.display = 'block';
                document.getElementById('arrowLogistik').style.transform = 'rotate(180deg)';
            }
        });

        /* LOGOUT CONFIRM */
        function logoutConfirm() {
            Swal.fire({
                title: 'Logout?',
                text: 'Anda akan keluar dari sistem.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

</body>
</html>
