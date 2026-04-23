<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gantol.In - Beauty & Accessories</title>

    <!-- Fonts & Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap"
        rel="stylesheet">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('styles')
</head>

<body>

    <header>
        <div class="nav-container">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Gantol.In">
            </a>

            <form action="{{ route('produk') }}" method="GET" class="search-wrap">
                <input type="text" name="search" class="search-input" placeholder="Cari makeup, aksesoris..."
                    value="{{ request('search') }}">
                <button type="submit" class="search-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>

            <nav class="nav-menu">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                <a href="{{ route('produk') }}" class="nav-link">Koleksi</a>
                <a href="{{ route('pesanan.index') }}" class="nav-link">Pesanan Saya</a>
            </nav>

            <div class="nav-actions">
                <a href="{{ route('keranjang') }}" class="icon-btn">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                    <span class="badge">{{ count(session('cart')) }}</span>
                    @endif
                </a>

                <div class="auth-links" style="display: flex; align-items: center; gap: 10px;">
                    @auth
                    <span class="nav-link" style="color: var(--secondary); font-weight: 700;">Halo, {{
                        Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        style="color: #ef4444; font-weight: 600;">Keluar</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                    <span style="color: #eee;">|</span>
                    <a href="{{ route('register') }}" class="nav-link"
                        style="background: var(--primary); color: white; padding: 8px 20px; border-radius: 50px;">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-grid">
            <div>
                <h3 class="footer-title" style="font-family: 'Playfair Display', serif;">Gantol.In</h3>
                <p style="line-height: 1.6; font-size: 14px;">Your ultimate destination for premium beauty products and
                    aesthetic accessories. Curated with love for your inner glow.</p>
            </div>
            <div>
                <h4 class="footer-title">Kategori</h4>
                <ul class="footer-list">
                    <li class="footer-item">Face Makeup</li>
                    <li class="footer-item">Eyeshadow</li>
                    <li class="footer-item">Lip Products</li>
                    <li class="footer-item">Accessories</li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Layanan</h4>
                <ul class="footer-list">
                    <li class="footer-item">Hubungi Kami</li>
                    <li class="footer-item">Cara Belanja</li>
                    <li class="footer-item">Informasi Pengiriman</li>
                    <li class="footer-item">Kebijakan Privasi</li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Ikuti Kami</h4>
                <div style="display: flex; gap: 15px;">
                    <a href="https://twitter.com/" style="color: white;"><svg width="20" height="20" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg></a>
                    <a href="https://www.instagram.com/dzakiyahh_22/" style="color: white;"><svg width="20" height="20"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg></a>
                    <a href="https://www.facebook.com/dzakiyahh.22" style="color: white;"><svg width="20" height="20"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.675 0h-21.35c-.733 0-1.325.593-1.325 1.326v21.348c0 .733.593 1.326 1.325 1.326h11.495v-9.294h-3.128v-3.622h3.128v-2.672c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.464.099 2.794.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.312h3.591l-.467 3.622h-3.124v9.294h6.116c.73 0 1.323-.593 1.323-1.326v-21.348c0-.733-.593-1.326-1.324-1.326z" />
                        </svg></a>
                    <a href="https://wa.me/6285861930794" style="color: white;" target="_blank">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 001.333 4.993L2 22l5.135-1.347a9.946 9.946 0 004.877 1.279h.005c5.505 0 9.987-4.478 9.988-9.984 0-2.669-1.038-5.176-2.925-7.062a9.916 9.916 0 00-7.068-2.925zm5.129 14.511c-.224.63-.764 1.154-1.397 1.408-.54.218-1.243.39-3.528-.551-2.92-1.202-4.81-4.179-4.955-4.373-.145-.195-1.183-1.571-1.183-2.992 0-1.421.745-2.119 1.011-2.41.266-.29.58-.363.774-.363h.556c.174 0 .408-.065.638.49.23.556.79 1.924.858 2.063.068.14.113.301.02.487-.093.185-.14.301-.278.462-.139.161-.293.36-.419.483-.14.135-.286.282-.123.563.163.281.724 1.196 1.554 1.936.83.74 1.53 1.127 1.838 1.281.309.155.489.13.673-.082.185-.213.79-.92 1.002-1.233.212-.312.424-.26.713-.155.29.106 1.838.867 2.155 1.024.317.157.528.23.605.361.077.13.077.756-.147 1.386z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2026 Gantol.In Beauty & Accessories. Crafted with ❤️ for Dida Nurwahidah.
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>