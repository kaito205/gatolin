@extends('layouts.app')

@section('styles')
<style>
    .page-header { background: var(--primary-light); padding: 80px 5%; text-align: center; margin-bottom: 60px; }
    .page-header h1 { font-family: 'Playfair Display', serif; font-size: 48px; color: var(--secondary); margin-bottom: 15px; }
    .page-header p { color: var(--text-light); font-weight: 500; font-size: 18px; max-width: 600px; margin: 0 auto; line-height: 1.6; }

    /* Pagination Styles */
    .pagination { display: flex; justify-content: center; gap: 8px; margin: 40px 0 60px; list-style: none; padding: 0; }
    .pagination li a, .pagination li span { padding: 12px 20px; border-radius: 12px; background: white; border: 1px solid #eee; color: var(--text-main); text-decoration: none; font-weight: 700; transition: 0.3s; font-size: 14px; box-shadow: var(--shadow-sm); }
    .pagination li.active span { background: var(--primary); color: white; border-color: var(--primary); }
    .pagination li a:hover { transform: translateY(-3px); border-color: var(--primary); color: var(--primary); box-shadow: var(--shadow-md); }
    .action-btn:disabled { background: #ccc; border-color: #ccc; cursor: not-allowed; }

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
<div class="page-header">
    <h1>Koleksi Terlengkap</h1>
    <p>Temukan perpaduan sempurna antara kecantikan wajah dan aksesoris aesthetic dalam setiap pilihan kami.</p>
</div>

<div style="max-width: 1200px; margin: 0 auto;">
    <div class="products-grid">
        @forelse($products as $product)
        <div class="product-card">
            <div class="product-media" onclick="window.location.href='{{ route('produk.show', $product->id_produk) }}'" style="cursor: pointer; position: relative;">
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
            <div class="product-info">
                <div class="product-title" onclick="window.location.href='{{ route('produk.show', $product->id_produk) }}'" style="cursor: pointer;">{{ $product->nama_produk }}</div>
                <div class="product-price">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</div>
                
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px; font-size: 11px; color: var(--text-light);">
                    <div style="display: flex; align-items: center; color: #ffc107;">
                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span style="margin-left: 2px; font-weight: 700;">4.9</span>
                    </div>
                    <span>•</span>
                    <span>{{ rand(100, 1000) }}+ Terjual</span>
                </div>

                <div class="qty-container" style="margin-bottom: 10px;">
                    <span class="qty-label" style="font-size: 12px;">Qty:</span>
                    <input type="number" value="{{ $product->stok_produk > 0 ? 1 : 0 }}" min="{{ $product->stok_produk > 0 ? 1 : 0 }}" max="{{ $product->stok_produk }}" class="qty-selector" style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; width: 50px;" {{ $product->stok_produk <= 0 ? 'readonly' : '' }}>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                    <button onclick="addToCart({{ $product->id_produk }}, this)" class="action-btn btn-outline" style="font-size: 11px; padding: 8px;" {{ $product->stok_produk <= 0 ? 'disabled' : '' }}>{{ $product->stok_produk <= 0 ? 'Habis' : '+ Keranjang' }}</button>
                    <button onclick="buyNow({{ $product->id_produk }}, this)" class="action-btn btn-primary" style="font-size: 11px; padding: 8px;" {{ $product->stok_produk <= 0 ? 'disabled' : '' }}>{{ $product->stok_produk <= 0 ? 'Habis' : 'Beli' }}</button>
                </div>

                <div style="text-align: center; font-size: 12px; color: {{ $product->stok_produk > 0 ? 'var(--text-light)' : '#ff4757' }}; margin-top: 15px; font-weight: {{ $product->stok_produk > 0 ? 'normal' : '700' }};">
                    {{ $product->stok_produk > 0 ? 'Tersedia: ' . $product->stok_produk . ' unit' : 'Stok Habis' }}
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 50px;">
            <h3 style="color: var(--text-light);">Maaf, produk tidak ditemukan.</h3>
            <p>Coba kata kunci lain atau <a href="{{ route('produk') }}" style="color: var(--primary);">tampilkan semua produk</a>.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
    function addToCart(id, btn) {
        let qtyInput = btn.closest('.product-info').querySelector('.qty-selector');
        let qty = qtyInput.value;
        window.location.href = "{{ url('/add-to-cart') }}/" + id + "?quantity=" + qty;
    }

    function buyNow(id, btn) {
        let qtyInput = btn.closest('.product-info').querySelector('.qty-selector');
        let qty = qtyInput.value;
        window.location.href = "{{ url('/buy-now') }}/" + id + "?quantity=" + qty;
    }
</script>
@endsection
