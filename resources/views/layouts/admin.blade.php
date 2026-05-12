<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gantol.In</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
        }
        
        #sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #fff;
            border-right: 1px solid #e2e8f0;
            padding: 2rem 1.5rem;
            z-index: 1000;
            overflow-y: auto;
        }
        
        #main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2.5rem;
        }

        .nav-link-admin {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 0.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }

        .nav-link-admin:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .nav-link-admin.active {
            background: #fff1f2;
            color: #db7093;
        }

        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            font-weight: 700;
            color: #94a3b8;
            margin: 1.5rem 0 0.75rem 1rem;
        }

        @media (max-width: 992px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            #sidebar.show {
                transform: translateX(0);
            }
            #main-content {
                margin-left: 0;
            }
            .mobile-header {
                display: flex !important;
            }
        }

        .mobile-header {
            display: none;
            background: #fff;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 900;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Mobile Header -->
    <div class="mobile-header d-flex justify-content-between align-items-center">
        <a href="#" class="fw-bold text-dark text-decoration-none">Gantol.In</a>
        <button class="btn btn-light" type="button" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <nav id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <i class="bi bi-bag-heart-fill text-danger"></i> Gantol.In
        </a>

        <div class="nav-section-title">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        
        <div class="nav-section-title">Transaksi</div>
        <a href="{{ route('admin.orders') }}" class="nav-link-admin {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> Pesanan Masuk
        </a>
        <a href="{{ route('admin.reports') }}" class="nav-link-admin {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Laporan
        </a>

        <div class="nav-section-title">Katalog</div>
        <a href="{{ route('admin.products.create') }}" class="nav-link-admin {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>

        <div style="margin-top: auto; padding-top: 2rem;">
            <a href="{{ url('/') }}" class="nav-link-admin text-danger">
                <i class="bi bi-box-arrow-left"></i> Keluar Panel
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
