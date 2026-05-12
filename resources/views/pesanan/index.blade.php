@extends('layouts.app')

@section('styles')
<style>
    .orders-container { max-width: 1000px; margin: 60px auto; padding: 0 25px; }
    .page-title { font-family: 'Playfair Display', serif; font-size: 36px; color: var(--secondary); margin-bottom: 40px; text-align: center; }
    
    .order-card { background: white; border-radius: 20px; box-shadow: var(--shadow-md); margin-bottom: 30px; overflow: hidden; border: 1px solid #f0f0f0; transition: 0.3s; }
    .order-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
    
    .order-header { padding: 20px 30px; background: #fafafa; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
    .order-id { font-weight: 700; color: var(--secondary); font-size: 16px; }
    .order-date { color: var(--text-light); font-size: 14px; }
    
    .status-badge { padding: 6px 16px; border-radius: 50px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    .status-pending { background: #fff7ed; color: #c2410c; border: 1px solid #fdba74; }
    .status-dikemas { background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd; }
    .status-dikirim { background: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe; }
    .status-selesai { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .status-dibatalkan { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    .order-body { padding: 30px; }
    .order-item { display: flex; align-items: center; gap: 20px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #f5f5f5; }
    .order-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    
    .item-img { width: 80px; height: 80px; object-fit: cover; border-radius: 12px; border: 1px solid #eee; }
    .item-info { flex: 1; }
    .item-name { font-weight: 700; color: var(--secondary); margin-bottom: 5px; font-size: 16px; }
    .item-meta { font-size: 14px; color: var(--text-light); }
    
    .order-footer { padding: 20px 30px; background: white; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    .total-price { font-size: 20px; font-weight: 800; color: var(--primary); }
    
    .empty-state { text-align: center; padding: 100px 20px; }
    .empty-icon { width: 80px; height: 80px; color: #ddd; margin-bottom: 20px; }

    @media (max-width: 600px) {
        .order-header { flex-direction: column; align-items: flex-start; }
        .order-footer { flex-direction: column; gap: 15px; align-items: flex-start; }
    }

    .payment-status { font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 5px; }
    .pay-belum { background: #fee2e2; color: #991b1b; }
    .pay-menunggu { background: #fef3c7; color: #92400e; }
    .pay-lunas { background: #dcfce7; color: #166534; }
</style>
@endsection

@section('content')
<div class="orders-container">
    <h1 class="page-title">Pesanan Saya</h1>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 30px; text-align: center; font-weight: 600;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 12px; margin-bottom: 30px; text-align: center; font-weight: 600;">
            {{ session('error') }}
        </div>
    @endif

    @forelse($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div>
                <div class="order-id">ID Pesanan: #{{ $order->id_order }}</div>
                <div class="order-date">Dipesan pada: {{ $order->created_at->format('d M Y, H:i') }}</div>
                <div style="font-size: 13px; color: var(--primary); font-weight: 600; margin-top: 5px;">
                    <i class="fas fa-credit-card"></i> {{ $order->metode_pembayaran ?? 'Belum memilih' }}
                </div>
                @php
                    $payStatusClass = 'pay-belum';
                    $payStatusLabel = 'Belum Bayar';
                    if($order->status_pembayaran == 'menunggu_verifikasi') {
                        $payStatusClass = 'pay-menunggu';
                        $payStatusLabel = 'Menunggu Verifikasi';
                    } elseif($order->status_pembayaran == 'lunas') {
                        $payStatusClass = 'pay-lunas';
                        $payStatusLabel = 'Pembayaran Lunas';
                    }
                @endphp
                <span class="payment-status {{ $payStatusClass }}">{{ $payStatusLabel }}</span>
            </div>
            @php
                $statusClass = 'status-' . strtolower($order->status);
                $statusLabel = ucfirst($order->status);
                if($order->status == 'pending') $statusLabel = 'Menunggu Konfirmasi';
                if($order->status == 'dikemas') $statusLabel = 'Sedang Dikemas';
                if($order->status == 'dikirim') $statusLabel = 'Dalam Pengiriman';
                if($order->status == 'completed') {
                    $statusLabel = 'Selesai';
                    $statusClass = 'status-selesai';
                }
                if($order->status == 'cancelled') {
                    $statusLabel = 'Dibatalkan';
                    $statusClass = 'status-dibatalkan';
                }
            @endphp
            <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
        </div>
        
        <div class="order-body">
            @foreach($order->items as $item)
            <div class="order-item">
                <img src="{{ asset('img/' . $item->product->foto_produk) }}" class="item-img" alt="{{ $item->product->nama_produk }}">
                <div class="item-info">
                    <div class="item-name">{{ $item->product->nama_produk }}</div>
                    <div class="item-meta">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                </div>
                <div style="font-weight: 700; color: var(--secondary);">
                    Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="order-footer">
            <div style="display: flex; align-items: center; gap: 15px;">
                @if($order->status == 'pending')
                <form action="{{ route('pesanan.cancel', $order->id_order) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                    @csrf
                    <button type="submit" style="background: none; border: 1px solid #ef4444; color: #ef4444; padding: 8px 15px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 13px;">Batalkan Pesanan</button>
                </form>
                @endif

                @if(in_array($order->status, ['completed', 'cancelled']))
                <form action="{{ route('pesanan.destroy', $order->id_order) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat pesanan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: 1px solid #94a3b8; color: #94a3b8; padding: 8px 15px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 13px;">Hapus Riwayat</button>
                </form>
                @endif
            </div>
            
            @if($order->status_pembayaran == 'menunggu_verifikasi')
            <div style="margin-top: 15px; padding: 10px 15px; background: #fffbeb; border-radius: 8px; color: #92400e; font-size: 13px; font-weight: 500;">
                <i class="fas fa-info-circle me-1"></i> Bukti pembayaran telah diunggah. Kami sedang memverifikasi pembayaran Anda.
            </div>
            @endif

            <div style="text-align: right;">
                <div style="color: var(--text-light); font-size: 14px;">Total Pesanan</div>
                <div class="total-price">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        <h3 style="color: var(--secondary); margin-bottom: 10px;">Belum ada pesanan</h3>
        <p style="color: var(--text-light); margin-bottom: 30px;">Sepertinya Anda belum melakukan pembelian apapun.</p>
        <a href="{{ route('produk') }}" class="action-btn" style="display: inline-block; width: auto; padding: 12px 40px; border-radius: 50px; text-decoration: none;">Mulai Belanja</a>
    </div>
    @endforelse
</div>
@endsection
