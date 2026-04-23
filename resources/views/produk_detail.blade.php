@extends('layouts.app')

@section('styles')
<style>
    .detail-container { max-width: 1200px; margin: 40px auto; padding: 0 25px; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start; }
    .image-gallery { background: white; border-radius: 25px; overflow: hidden; box-shadow: var(--shadow-lg); position: sticky; top: 120px; }
    .main-image { width: 100%; height: auto; display: block; }
    
    .product-details { padding: 10px 0; }
    .breadcrumb { font-size: 14px; color: var(--text-light); margin-bottom: 20px; display: flex; gap: 10px; }
    .breadcrumb a { color: var(--primary); text-decoration: none; font-weight: 600; }
    
    .p-title { font-family: 'Playfair Display', serif; font-size: 42px; color: var(--secondary); margin-bottom: 15px; line-height: 1.2; }
    .p-price { font-size: 32px; font-weight: 800; color: var(--primary); margin-bottom: 30px; }
    
    .p-meta { display: flex; gap: 30px; margin-bottom: 30px; padding-bottom: 25px; border-bottom: 1px solid #eee; }
    .meta-item { display: flex; flex-direction: column; gap: 5px; }
    .meta-label { font-size: 12px; font-weight: 700; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; }
    .meta-value { font-size: 16px; font-weight: 600; color: var(--secondary); }
    
    .p-desc { line-height: 1.8; color: var(--text-main); margin-bottom: 40px; font-size: 16px; }
    
    .purchase-actions { display: grid; grid-template-columns: 120px 1fr 1fr; gap: 15px; margin-bottom: 30px; }
    .qty-wrap { display: flex; align-items: center; border: 2px solid #eee; border-radius: 12px; overflow: hidden; height: 55px; }
    .qty-btn { border: none; background: #f9fafb; width: 40px; height: 100%; cursor: pointer; font-size: 18px; font-weight: 600; transition: 0.2s; }
    .qty-btn:hover { background: #f3f4f6; }
    .qty-num { width: 40px; border: none; text-align: center; font-weight: 700; font-size: 16px; background: white; }
    
    .btn-lg { height: 55px; border-radius: 12px; display: flex; align-items: center; justify-content: center; gap: 10px; font-weight: 700; font-size: 16px; text-decoration: none; cursor: pointer; transition: 0.3s; border: none; }
    .btn-p-primary { background: var(--primary); color: white; }
    .btn-p-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(219, 112, 147, 0.2); }
    .btn-p-outline { background: white; color: var(--primary); border: 2px solid var(--primary); }
    .btn-p-outline:hover { background: var(--primary-light); }

    /* Related Products */
    .related-section { max-width: 1200px; margin: 80px auto; padding: 0 25px; }
    .rel-title { font-family: 'Playfair Display', serif; font-size: 28px; margin-bottom: 40px; text-align: center; }
    .rel-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 30px; }

    .btn-lg:disabled { background: #ccc; cursor: not-allowed; transform: none; box-shadow: none; border-color: #ccc; color: #666; }
    .badge-sold-out { background: #ff4757; color: white; padding: 5px 12px; border-radius: 50px; font-size: 12px; font-weight: 700; text-transform: uppercase; }

    @media (max-width: 768px) {
        .detail-container { grid-template-columns: 1fr; }
        .image-gallery { position: static; }
        .purchase-actions { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="detail-container">
    <div class="image-gallery">
        <img src="{{ asset('img/' . $product->foto_produk) }}" class="main-image" alt="{{ $product->nama_produk }}">
    </div>

    <div class="product-details">
        <div class="breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> / 
            <a href="{{ route('produk', ['category' => $product->kategori_id]) }}">{{ optional($product->kategori)->nama_kategori ?? 'Umum' }}</a> /
            <span>{{ $product->nama_produk }}</span>
        </div>

        <h1 class="p-title">{{ $product->nama_produk }}</h1>
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 25px;">
            <div class="p-price" style="margin-bottom: 0;">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</div>
            <div style="display: flex; align-items: center; gap: 8px; padding-left: 20px; border-left: 2px solid #eee;">
                <div style="display: flex; align-items: center; color: #ffc107;">
                    @for($i=0; $i<5; $i++)
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                </div>
                <span style="font-weight: 700; color: var(--secondary); font-size: 16px;">4.9</span>
                <span style="color: var(--text-light); font-size: 14px;">(250+ Ulasan)</span>
                <span style="color: var(--text-light); margin: 0 5px;">|</span>
                <span style="color: var(--text-light); font-size: 14px;">{{ rand(500, 2000) }}+ Terjual</span>
            </div>
        </div>

        <div class="p-meta">
            <div class="meta-item">
                <span class="meta-label">Kategori</span>
                <span class="meta-value">{{ optional($product->kategori)->nama_kategori ?? 'Umum' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Kondisi</span>
                <span class="meta-value">Baru</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Stok</span>
                <span class="meta-value">
                    @if($product->stok_produk > 0)
                        {{ $product->stok_produk }} unit
                    @else
                        <span class="badge-sold-out">Stok Habis</span>
                    @endif
                </span>
            </div>
        </div>

        <div class="p-desc">
            <h4 style="margin-bottom: 10px; color: var(--secondary);">Deskripsi Produk</h4>
            {{ $product->deskripsi_produk }}
            <p style="margin-top: 20px; font-size: 14px; color: var(--text-light);">*Produk ini dijamin 100% original dan berkualitas premium dari Gantol.In.</p>
        </div>

        <div class="purchase-actions">
            <div class="qty-wrap">
                <button class="qty-btn" onclick="updateQty(-1)" {{ $product->stok_produk <= 0 ? 'disabled' : '' }}>-</button>
                <input type="number" value="{{ $product->stok_produk > 0 ? 1 : 0 }}" min="{{ $product->stok_produk > 0 ? 1 : 0 }}" max="{{ $product->stok_produk }}" id="main-qty" class="qty-num" {{ $product->stok_produk <= 0 ? 'readonly' : '' }}>
                <button class="qty-btn" onclick="updateQty(1)" {{ $product->stok_produk <= 0 ? 'disabled' : '' }}>+</button>
            </div>
            <button onclick="addToCartDetail({{ $product->id_produk }})" class="btn-lg btn-p-outline" {{ $product->stok_produk <= 0 ? 'disabled' : '' }}>
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                {{ $product->stok_produk <= 0 ? 'Stok Habis' : '+ Keranjang' }}
            </button>
            <button onclick="buyNowDetail({{ $product->id_produk }})" class="btn-lg btn-p-primary" {{ $product->stok_produk <= 0 ? 'disabled' : '' }}>
                {{ $product->stok_produk <= 0 ? 'Stok Habis' : 'Beli Sekarang' }}
            </button>
        </div>
    </div>
</div>

@if($relatedProducts->count() > 0)
<div class="related-section">
    <h3 class="rel-title">Produk Terkait</h3>
    <div class="rel-grid">
        @foreach($relatedProducts as $rel)
        <div class="product-card">
            <div class="product-media" onclick="window.location.href='{{ route('produk.show', $rel->id_produk) }}'">
                <img src="{{ asset('img/' . $rel->foto_produk) }}" alt="{{ $rel->nama_produk }}">
            </div>
            <div class="product-info">
                <div class="product-title">{{ $rel->nama_produk }}</div>
                <div class="product-price">Rp {{ number_format($rel->harga_produk, 0, ',', '.') }}</div>
                <a href="{{ route('produk.show', $rel->id_produk) }}" class="action-btn" style="text-decoration: none;">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    function updateQty(val) {
        let input = document.getElementById('main-qty');
        let current = parseInt(input.value);
        let max = parseInt(input.getAttribute('max'));
        if (current + val >= 1 && current + val <= max) {
            input.value = current + val;
        }
    }

    function addToCartDetail(id) {
        let qty = document.getElementById('main-qty').value;
        window.location.href = "{{ url('/add-to-cart') }}/" + id + "?quantity=" + qty;
    }

    function buyNowDetail(id) {
        let qty = document.getElementById('main-qty').value;
        window.location.href = "{{ url('/buy-now') }}/" + id + "?quantity=" + qty;
    }
</script>
@endsection
