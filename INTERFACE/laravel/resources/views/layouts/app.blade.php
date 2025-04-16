<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Energy Analytics System")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />

    @stack('styles')
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .sidebar:before,
        .sidebar:after,
        .off-canvas-sidebar:before,
        .off-canvas-sidebar:after {
            content: none !important;
            display: none !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
            
        .sidebar:after,
        .off-canvas-sidebar:after {
            background: transparent !important;
        }

        sidebar:after,
        .off-canvas-sidebar:after {
            content: none !important; /* ini yang penting */
            display: none !important;
        }
        
        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa; /* Light gray background */
            color: #000; /* Hitam agar terbaca */
            padding-top: 60px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar a {
            color: #000;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .sidebar a:hover {
            background-color: #e2e6ea; /* Hover effect */
        }

        .content {
            margin-left: 220px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        footer.main-footer {
            margin-left: 220px;
        }

        .burger-btn {
            display: none;
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            color: #343a40;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
        }

        /* Tambahan untuk overlay ketika sidebar muncul di mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .sidebar.active + .sidebar-overlay {
            display: block;
        }

        /* Logo ukuran kecil di HP */
        @media (max-width: 768px) {
            .sidebar .logo img {
                width: 40px;
            }
            .sidebar .logo div {
                font-size: 0.9rem;
            }
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            footer.main-footer {
                margin-left: 0;
            }

            .burger-btn {
                display: block;
            }
        }
    </style>
    
</head>
<body>

    {{-- Burger menu button --}}
    <button class="burger-btn" id="toggleSidebar">&#9776;</button>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar" data-color="white" data-active-color="danger" style="width: 260px; height: 100vh; position: fixed; top: 0; left: 0;">
        <div class="logo text-center py-1">
            <a href="{{ route('home') }}" class="simple-text logo-normal">
                <img src="{{ asset('img/LogoEAS.png') }}" alt="Logo" class="rounded-circle mb-1"
                    style="max-width: 100%; height: auto; width: 250px;">
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('tabel') ? 'active' : '' }}">
                    <a href="{{ route('tabel') }}">
                        <i class="nc-icon nc-tile-56"></i>
                        <p>Tabel</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('grafik') ? 'active' : '' }}">
                    <a href="{{ route('grafik') }}">
                        <i class="nc-icon nc-chart-bar-32"></i>
                        <p>Trend</p>
                    </a>
                </li>
                <li class="active-pro d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                    <div class="flex-grow-5"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center" style="padding: 0.5rem 2.5rem; font-size: 0.85rem; width: 95%;">
                            <i class="nc-icon nc-button-power me-2" style="font-size: 1rem;"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- Content --}}
    <div class="content">
        @yield("content")
    </div>

    {{-- Footer --}}
    <footer class="main-footer bg-dark d-flex justify-content-center align-items-center" style="height: 50px;">
        <p class="text-white mb-0">&copy; EAS 2025</p>
    </footer>

    {{-- Toggle Sidebar Script --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('toggleSidebar');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('active');
            overlay.style.display = 'none';
        });
    </script>

    @stack('scripts')
</body>
</html>
