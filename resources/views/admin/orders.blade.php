@extends('layouts.admin')

@section('styles')
<style>
    .card-order {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .table thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: #1e293b;
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .order-id-badge {
        font-family: monospace;
        background: #f1f5f9;
        color: #475569;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-weight: 700;
    }

    .badge-status {
        padding: 0.4rem 0.8rem;
        border-radius: 2rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pending { background: #fff7ed; color: #c2410c; }
    .status-dikemas { background: #f0f9ff; color: #0369a1; }
    .status-dikirim { background: #f5f3ff; color: #6d28d9; }
    .status-completed { background: #f0fdf4; color: #15803d; }
    .status-cancelled { background: #fef2f2; color: #b91c1c; }

    .payment-status-pill {
        font-size: 0.65rem;
        font-weight: 800;
        padding: 0.2rem 0.6rem;
        border-radius: 0.5rem;
        margin-top: 0.25rem;
        display: inline-block;
    }
</style>
@endsection

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-dark mb-1">Manajemen Pesanan</h3>
    <p class="text-muted small">Daftar transaksi dan status pengiriman pelanggan</p>
</div>

<div class="card card-order">
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3 border-0">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID Order</th>
                        <th>Pelanggan</th>
                        <th>Total & Pembayaran</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="order-id-badge">#{{ str_pad($order->id_order, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $order->nama_pembeli }}</div>
                            <div class="small text-muted">{{ $order->telepon_pembeli }}</div>
                        </td>
                        <td>
                            <div class="fw-bold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                            <div class="small text-secondary">{{ $order->metode_pembayaran }}</div>
                            @php
                                $pColor = 'bg-danger'; $pLabel = 'Belum Bayar';
                                if($order->status_pembayaran == 'menunggu_verifikasi') { $pColor = 'bg-warning text-dark'; $pLabel = 'Verifikasi'; }
                                elseif($order->status_pembayaran == 'lunas') { $pColor = 'bg-success'; $pLabel = 'Lunas'; }
                            @endphp
                            <span class="payment-status-pill {{ $pColor }} text-white">{{ $pLabel }}</span>
                        </td>
                        <td>
                            @php
                                $sClass = 'status-' . $order->status;
                                $sLabel = ucfirst($order->status);
                                if($order->status == 'pending') $sLabel = 'Menunggu';
                            @endphp
                            <span class="badge-status {{ $sClass }}">{{ $sLabel }}</span>
                        </td>
                        <td>
                            <div class="small fw-bold">{{ $order->created_at->format('d/m/Y') }}</div>
                            <div class="small text-muted">{{ $order->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-primary px-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id_order }}">
                                    Detail
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border rounded-pill dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown">
                                        Status
                                    </button>
                                    <ul class="dropdown-menu shadow border-0 rounded-3">
                                        <li><h6 class="dropdown-header small fw-bold">Update Pengiriman</h6></li>
                                        <li><form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">@csrf<input type="hidden" name="status" value="dikemas"><button type="submit" class="dropdown-item small">Dikemas</button></form></li>
                                        <li><form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">@csrf<input type="hidden" name="status" value="dikirim"><button type="submit" class="dropdown-item small">Dikirim</button></form></li>
                                        <li><form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">@csrf<input type="hidden" name="status" value="completed"><button type="submit" class="dropdown-item small text-success fw-bold">Selesai</button></form></li>
                                        
                                        @if($order->status_pembayaran == 'menunggu_verifikasi')
                                        <li><hr class="dropdown-divider"></li>
                                        <li><h6 class="dropdown-header small fw-bold text-primary">Pembayaran</h6></li>
                                        <li><form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">@csrf<input type="hidden" name="payment_status" value="lunas"><button type="submit" class="dropdown-item small fw-bold text-primary">Verifikasi Lunas</button></form></li>
                                        @endif
                                        
                                        <li><hr class="dropdown-divider"></li>
                                        <li><form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">@csrf<input type="hidden" name="status" value="cancelled"><button type="submit" class="dropdown-item small text-danger" onclick="return confirm('Batalkan?')">Batalkan</button></form></li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Detail (Sederhana & Padat) -->
                    <div class="modal fade" id="orderModal{{ $order->id_order }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title fw-bold">Rincian #{{ str_pad($order->id_order, 5, '0', STR_PAD_LEFT) }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pt-0">
                                    <div class="p-3 bg-light rounded-3 mb-3">
                                        <div class="small text-muted mb-1">Nama Pelanggan:</div>
                                        <div class="fw-bold text-dark">{{ $order->nama_pembeli }}</div>
                                        <div class="small text-muted mt-2">Alamat Pengiriman:</div>
                                        <div class="small text-dark">{{ $order->alamat_pembeli }}</div>
                                    </div>

                                    @if($order->bukti_pembayaran)
                                    <div class="mb-3">
                                        <div class="small text-muted mb-2">Bukti Pembayaran:</div>
                                        <a href="{{ asset('img/bukti_pembayaran/' . $order->bukti_pembayaran) }}" target="_blank">
                                            <img src="{{ asset('img/bukti_pembayaran/' . $order->bukti_pembayaran) }}" class="img-fluid rounded border w-100" style="max-height: 150px; object-fit: cover;">
                                        </a>
                                    </div>
                                    @endif

                                    <div class="fw-bold small text-uppercase text-muted border-bottom pb-2 mb-2">Item:</div>
                                    @foreach($order->items as $item)
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span>{{ $item->product->nama_produk ?? 'Produk' }} ({{ $item->quantity }}x)</span>
                                        <span class="fw-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                    </div>
                                    @endforeach
                                    
                                    <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                        <span class="fw-bold text-primary">TOTAL</span>
                                        <span class="fw-bold text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
