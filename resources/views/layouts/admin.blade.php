<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gantol.In</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            -webkit-font-smoothing: antialiased;
        }
        
        /* Sidebar Styling */
        #sidebar {
            width: 270px;
            background-color: #ffffff;
            border-right: 1px solid #f1f5f9;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 30px 24px;
            display: flex;
            flex-direction: column;
        }
        
        .brand-logo {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 26px;
            color: #0f172a;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 50px;
        }
        
        .brand-logo:hover {
            color: #db7093;
        }
        
        .brand-badge {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 10px;
            background-color: #db7093;
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .nav-heading {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
            padding-left: 12px;
        }

        .sidebar-nav-item {
            padding: 12px 16px;
            color: #64748b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            margin-bottom: 6px;
        }

        .sidebar-nav-item:hover {
            background-color: #f8fafc;
            color: #0f172a;
            transform: translateX(4px);
        }

        .sidebar-nav-item.active {
            background-color: #fff1f2;
            color: #db7093;
            font-weight: 700;
        }

        .sidebar-nav-item i {
            font-size: 20px;
        }

        /* Main Content Styling */
        #main-wrapper {
            margin-left: 270px;
            padding: 30px 50px;
        }

        /* Top Bar */
        .top-bar {
            margin-bottom: 45px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            padding: 15px 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            border: 1px solid #ffffff;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background-color: #fff1f2;
            color: #db7093;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 15px;
        }

        /* Helpers */
        .text-accent { color: #db7093; }
        .bg-accent { background-color: #db7093; }
        .btn-accent { 
            background-color: #db7093; 
            color: white; 
            font-weight: 600;
            border: none;
            transition: 0.2s;
        }
        .btn-accent:hover {
            background-color: #be185d;
            color: white;
            transform: translateY(-2px);
        }

        @yield('styles')
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <a href="#" class="brand-logo">
            Gantol.In <span class="brand-badge">PRO</span>
        </a>

        <div class="mb-4">
            <div class="nav-heading">Katalog</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Semua Produk
            </a>
            <a href="{{ route('admin.products.create') }}" class="sidebar-nav-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <i class="bi bi-plus-square"></i> Tambah Produk
            </a>
        </div>

        <div class="mb-4">
            <div class="nav-heading">Transaksi</div>
            <a href="{{ route('admin.orders') }}" class="sidebar-nav-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                <i class="bi bi-cart3"></i> Pesanan Masuk
            </a>
            <a href="{{ route('admin.reports') }}" class="sidebar-nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i> Laporan Jualan
            </a>
        </div>

        <div class="mt-auto">
            <a href="{{ url('/') }}" class="sidebar-nav-item text-danger">
                <i class="bi bi-box-arrow-left"></i> Keluar Panel
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="main-wrapper">
        <header class="top-bar">
            <div>
                <h1 class="h4 fw-bold text-dark mb-1">Dashboard Administrator</h1>
                <p class="text-secondary small mb-0">Selamat bekerja kembali, Admin!</p>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold fs-6 text-dark">Dida Nurwahidah</div>
                    <div class="text-secondary small">Owner & Founder</div>
                </div>
                <div class="user-avatar">DN</div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
