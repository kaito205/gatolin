@extends('layouts.app')

@section('styles')
<style>
    /* Slider Styles (Keep local to home) */
    .hero-slider { height: 600px; position: relative; overflow: hidden; }
    .slide { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; transition: opacity 0.8s ease; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; }
    .slide.active { opacity: 1; z-index: 1; }
    .hero-text { text-align: center; color: white; transform: translateY(30px); transition: 0.8s ease; max-width: 800px; padding: 0 20px; }
    .slide.active .hero-text { transform: translateY(0); }
    .hero-text h1 { font-family: 'Playfair Display', serif; font-size: 56px; margin-bottom: 20px; text-shadow: 0 4px 10px rgba(0,0,0,0.3); }
    .hero-text p { font-size: 18px; margin-bottom: 35px; text-shadow: 0 2px 5px rgba(0,0,0,0.3); }
    
    .slider-dots { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 10; display: flex; gap: 12px; }
    .dot { width: 12px; height: 12px; border-radius: 50%; background: rgba(255,255,255,0.4); cursor: pointer; transition: 0.3s; }
    .dot.active { background: white; width: 30px; border-radius: 10px; }

    .section-title { text-align: center; margin-bottom: 50px; }
    .section-title h2 { font-family: 'Playfair Display', serif; font-size: 36px; color: var(--secondary); }
    
    .category-item:hover div { transform: scale(1.05); border-color: var(--primary) !important; }

    /* Video Hover Styles */
    .product-media video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
    }
    .product-card:hover .product-media video {
        opacity: 1;
    }
</style>
@endsection

@section('content')
<!-- Hero Slider -->
<div class="hero-slider">
    <div class="slide active" style="background-image: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)), url('{{ asset('img/utama.png') }}')">
        <div class="hero-text">
            <p>WELCOME TO GANTOL.IN</p>
            <h1>Gantungan Cantik & Aesthetic</h1>
            <p>Lengkapi gayamu dengan koleksi gantungan kunci paling gemas dan unik tahun ini.</p>
            <a href="{{ route('produk') }}" class="action-btn" style="width: auto; padding: 15px 40px; border-radius: 50px; display: inline-block;">Lihat Semua</a>
        </div>
    </div>
    <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)), url('{{ asset('img/1776879473.webp') }}')">
        <div class="hero-text">
            <p>BEAUTY & MAKEUP</p>
            <h1>Tampil Cantik Setiap Hari</h1>
            <p>Koleksi makeup lengkap untuk hasil yang flawless dan mempesona sepanjang waktu.</p>
            <a href="{{ route('produk') }}" class="action-btn" style="width: auto; padding: 15px 40px; border-radius: 50px; display: inline-block;">Cek Makeup</a>
        </div>
    </div>
    <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.15)), url('{{ asset('img/fce.jpeg') }}')">
        <div class="hero-text">
            <p>SKINCARE & CARE</p>
            <h1>Rawat Cantik Alamimu</h1>
            <p>Dapatkan kulit sehat dan cerah dengan rangkaian skincare premium pilihan kami.</p>
            <a href="{{ route('produk') }}" class="action-btn" style="width: auto; padding: 15px 40px; border-radius: 50px; display: inline-block;">Mulai Rawat Kulit</a>
        </div>
    </div>

    <div class="slider-dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>

<!-- Categories Section -->
<div class="section-title" style="margin-top: 80px;">
    <p style="color: var(--primary); font-weight: 700; font-size: 14px; letter-spacing: 2px; margin-bottom: 10px;">SHOP BY CATEGORY</p>
    <h2>Koleksi Pilihan</h2>
</div>

<div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; margin-bottom: 100px; padding: 0 5%;">
    @foreach($categories as $cat)
    <a href="{{ route('produk', ['category' => $cat->id_kategori]) }}" style="text-decoration: none; text-align: center; transition: 0.3s;" class="category-item">
        <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; box-shadow: var(--shadow-sm); border: 1px solid #eee; overflow: hidden; transition: 0.3s;">
            @php
                $catImgs = [
                    1 => 'eyeshadow.jpeg',
                    2 => 'cushion.jpeg',
                    3 => 'lip.jpeg',
                    4 => 'fce.jpeg',
                    5 => 'utama.png'
                ];
                $img = $catImgs[$cat->id_kategori] ?? 'logo.png';
            @endphp
            <img src="{{ asset('img/' . $img) }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
        </div>
        <span style="font-weight: 600; color: var(--text-light); font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">{{ $cat->nama_kategori }}</span>
    </a>
    @endforeach
</div>

<!-- Products Section -->
<div class="section-title">
    <p style="color: var(--primary); font-weight: 700; font-size: 14px; letter-spacing: 2px; margin-bottom: 10px;">DISCOVER MORE</p>
    <h2>Rekomendasi Untuk Anda</h2>
</div>

<div class="products-grid" style="padding: 0 25px; gap: 25px; margin-bottom: 50px;">
    @foreach($products as $product)
    <div class="product-card" style="border-radius: 15px; border: none; background: transparent;">
        <div class="product-media" onclick="window.location.href='{{ route('produk.show', $product->id_produk) }}'" style="border-radius: 15px; border: 1px solid #f3f4f6; position: relative;">
            <img src="{{ asset('img/' . $product->foto_produk) }}" alt="{{ $product->nama_produk }}">
            
            @if($product->video_produk)
                <video muted loop playsinline onmouseover="this.play()" onmouseout="this.pause(); this.currentTime=0;">
                    <source src="{{ asset('img/' . $product->video_produk) }}" type="video/mp4">
                </video>
            @endif

            @if($product->stok_produk <= 0)
                <div style="position: absolute; top: 10px; right: 10px; background: #ff4757; color: white; padding: 4px 10px; border-radius: 5px; font-size: 10px; font-weight: 700; text-transform: uppercase; z-index: 3;">Habis</div>
            @endif
        </div>
        <div class="product-info" style="padding: 15px 5px;">
            <div class="product-title" style="font-size: 16px; font-weight: 700; height: auto; min-height: 44px; margin-bottom: 5px;">{{ $product->nama_produk }}</div>
            <div class="product-price" style="font-size: 18px; color: var(--secondary); margin-bottom: 5px;">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</div>
            
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; font-size: 12px; color: var(--text-light);">
                <div style="display: flex; align-items: center; color: #ffc107;">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span style="margin-left: 3px; font-weight: 700;">4.9</span>
                </div>
                <span>|</span>
                <span>{{ rand(50, 500) }}+ terjual</span>
            </div>
            
            <a href="{{ route('produk.show', $product->id_produk) }}" class="action-btn" style="border-radius: 50px; background: var(--secondary); font-size: 12px;">Detail Produk</a>
        </div>
    </div>
    @endforeach
</div>

<div style="text-align: center; margin-bottom: 80px;">
    <a href="{{ route('produk') }}" class="action-btn btn-outline" style="display: inline-block; padding: 15px 40px; border-radius: 50px; text-decoration: none;">Lihat Semua Produk</a>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let currentSlide = 0;
        const slides = $('.slide');
        const dots = $('.dot');

        function showSlide(index) {
            slides.removeClass('active');
            dots.removeClass('active');
            slides.eq(index).addClass('active');
            dots.eq(index).addClass('active');
            currentSlide = index;
        }

        function nextSlide() {
            let next = (currentSlide + 1) % slides.length;
            showSlide(next);
        }

        let slideInterval = setInterval(nextSlide, 5000);

        dots.click(function() {
            clearInterval(slideInterval);
            showSlide($(this).index());
            slideInterval = setInterval(nextSlide, 5000);
        });
    });
</script>
@endsection
