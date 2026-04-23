@extends('layouts.app')

@section('styles')
<style>
    .about-hero { background: var(--primary-light); padding: 100px 5%; text-align: center; position: relative; overflow: hidden; }
    .about-hero h1 { font-family: 'Playfair Display', serif; font-size: 56px; color: var(--secondary); margin-bottom: 20px; }
    .about-hero p { font-size: 18px; color: var(--text-light); max-width: 700px; margin: 0 auto; line-height: 1.8; }
    
    .about-content { max-width: 1100px; margin: 100px auto; padding: 0 25px; display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
    .about-image { border-radius: 30px; overflow: hidden; box-shadow: var(--shadow-lg); position: relative; }
    .about-image img { width: 100%; height: auto; display: block; transition: 0.5s; }
    .about-image:hover img { transform: scale(1.05); }

    .about-text h2 { font-family: 'Playfair Display', serif; font-size: 36px; color: var(--secondary); margin-bottom: 25px; position: relative; }
    .about-text h2::after { content: ''; position: absolute; left: 0; bottom: -10px; width: 60px; height: 3px; background: var(--primary); }
    .about-text p { line-height: 1.8; color: var(--text-main); margin-bottom: 20px; font-size: 16px; }

    .values-section { background: white; padding: 100px 5%; text-align: center; }
    .values-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; max-width: 1200px; margin: 60px auto 0; }
    .value-card { padding: 40px; border-radius: 20px; background: #fffbfb; border: 1px solid #fce7f3; transition: 0.3s; }
    .value-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-md); border-color: var(--primary); }
    .value-icon { font-size: 40px; margin-bottom: 20px; display: block; }
    .value-card h3 { font-size: 20px; color: var(--secondary); margin-bottom: 15px; }
    .value-card p { font-size: 14px; color: var(--text-light); line-height: 1.6; }

    @media (max-width: 768px) {
        .about-content { grid-template-columns: 1fr; gap: 40px; text-align: center; }
        .about-text h2::after { left: 50%; transform: translateX(-50%); }
    }
</style>
@endsection

@section('content')
<div class="about-hero">
    <h1>Tentang Gantol.In</h1>
    <p>Membawa kecantikan dan kebahagiaan melalui setiap detail aksesoris dan produk kecantikan pilihan.</p>
</div>

<div class="about-content">
    <div class="about-image">
        <img src="{{ asset('img/utama.png') }}" alt="Our Story">
    </div>
    <div class="about-text">
        <h2>Cerita Kami</h2>
        <p>Berawal dari kecintaan terhadap detail-detail kecil yang membuat hari seseorang menjadi lebih cerah, **Gantol.In** hadir sebagai destinasi utama bagi Anda yang mencari perpaduan antara kecantikan wajah dan aksesoris aesthetic.</p>
        <p>Kami percaya bahwa setiap orang berhak merasa percaya diri dan unik. Itulah mengapa setiap produk yang kami tawarkan, mulai dari *lip tint* hingga *gantungan kunci custom*, dipilih dengan kurasi yang sangat ketat untuk memastikan kualitas terbaik sampai ke tangan Anda.</p>
        <p>Nama **Gantol.In** sendiri melambangkan harapan kami agar produk-produk kami bisa "menyangkut" di hati pelanggan dan menjadi bagian tak terpisahkan dari keseharian Anda.</p>
    </div>
</div>

<div class="values-section">
    <p style="color: var(--primary); font-weight: 700; font-size: 14px; letter-spacing: 2px;">OUR CORE VALUES</p>
    <h2 style="font-family: 'Playfair Display', serif; font-size: 36px; margin-top: 10px;">Mengapa Memilih Kami?</h2>
    
    <div class="values-grid">
        <div class="value-card">
            <span class="value-icon">✨</span>
            <h3>Kualitas Premium</h3>
            <p>Semua produk kami dijamin original dan telah melalui proses kontrol kualitas yang ketat sebelum dikirim.</p>
        </div>
        <div class="value-card">
            <span class="value-icon">💖</span>
            <h3>Kurasi Dengan Cinta</h3>
            <p>Setiap item dipilih dengan mempertimbangkan tren terbaru dan nilai estetika yang tinggi.</p>
        </div>
        <div class="value-card">
            <span class="value-icon">🚀</span>
            <h3>Pengiriman Cepat</h3>
            <p>Kami memahami antusiasme Anda. Pesanan diproses dan dikirim secepat kilat dengan kemasan yang aman.</p>
        </div>
        <div class="value-card">
            <span class="value-icon">😊</span>
            <h3>Pelayanan Ramah</h3>
            <p>Kepuasan Anda adalah prioritas kami. Tim kami siap membantu kebutuhan belanja Anda kapan saja.</p>
        </div>
    </div>
</div>

<div style="background: var(--secondary); padding: 80px 5%; text-align: center; color: white; margin-top: 50px;">
    <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; margin-bottom: 20px;">Siap Untuk Tampil Lebih Aesthetic?</h2>
    <p style="margin-bottom: 35px; opacity: 0.8;">Jelajahi koleksi terbaru kami sekarang juga.</p>
    <a href="{{ route('produk') }}" class="action-btn" style="display: inline-block; width: auto; padding: 15px 40px; border-radius: 50px; background: var(--primary); color: white;">Mulai Belanja</a>
</div>
@endsection
