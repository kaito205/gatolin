@extends('layouts.admin')

@section('styles')
<style>
    .table-custom th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #94a3b8;
        font-weight: 800;
        border-bottom: 2px solid #f1f5f9;
        padding: 20px 16px;
    }

    .table-custom td {
        vertical-align: middle;
        padding: 20px 16px;
        color: #334155;
        border-bottom: 1px solid #f8fafc;
    }

    .table-hover tbody tr:hover {
        background-color: #f8fafc;
        transition: 0.2s;
    }

    .custom-shadow {
        box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
    }
    
    .badge-soft {
        padding: 8px 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
</style>
@endsection

@section('content')
<div class="card border-0 custom-shadow rounded-4 mb-4">
    <div class="card-header bg-white border-bottom-0 p-4 pb-0 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="bi bi-receipt-cutoff fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark mb-1">Daftar Pesanan Masuk</h5>
                <p class="text-muted small mb-0">Pantau dan kelola pesanan dari pelanggan Anda.</p>
            </div>
        </div>
    </div>

    <div class="card-body p-0 mt-3">
        @if(session('success'))
            <div class="mx-4 mb-3 alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID Order</th>
                        <th>Pelanggan</th>
                        <th>Total Belanja</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-primary">#ORD-{{ str_pad($order->id_order, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $order->nama_pembeli }}</div>
                            <div class="small text-muted"><i class="bi bi-envelope"></i> {{ $order->email_pembeli }}</div>
                        </td>
                        <td>
                            <span class="fw-bold text-dark">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 badge-soft">
                                    <i class="bi bi-clock-history"></i> Pending
                                </span>
                            @elseif($order->status == 'dikemas')
                                <span class="badge rounded-pill bg-info bg-opacity-10 text-info border border-info border-opacity-25 badge-soft">
                                    <i class="bi bi-box-seam"></i> Dikemas
                                </span>
                            @elseif($order->status == 'dikirim')
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 badge-soft">
                                    <i class="bi bi-truck"></i> Dikirim
                                </span>
                            @elseif($order->status == 'completed')
                                <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 badge-soft">
                                    <i class="bi bi-check2-circle"></i> Selesai
                                </span>
                            @else
                                <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 badge-soft">
                                    <i class="bi bi-x-circle"></i> {{ ucfirst($order->status) }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="small text-muted fw-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </td>
                        <td class="pe-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary fw-bold px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id_order }}">
                                    Detail
                                </button>
                                
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border dropdown-toggle fw-bold rounded-pill px-3" type="button" data-bs-toggle="dropdown">
                                        Update Status
                                    </button>
                                    <ul class="dropdown-menu shadow-sm border-0 rounded-3">
                                        <li>
                                            <form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="dikemas">
                                                <button type="submit" class="dropdown-item py-2"><i class="bi bi-box-seam me-2 text-info"></i> Dikemas</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="dikirim">
                                                <button type="submit" class="dropdown-item py-2"><i class="bi bi-truck me-2 text-primary"></i> Dikirim</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="dropdown-item py-2"><i class="bi bi-check-circle me-2 text-success"></i> Selesai</button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.orders.updateStatus', $order->id_order) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="dropdown-item py-2 text-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"><i class="bi bi-x-circle me-2"></i> Batalkan</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                                @if(in_array($order->status, ['completed', 'cancelled']))
                                <form action="{{ route('admin.orders.delete', $order->id_order) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="return confirm('Yakin ingin menghapus pesanan ini secara permanen?')">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Detail Order -->
                    <div class="modal fade" id="orderModal{{ $order->id_order }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h5 class="modal-title fw-bold">Rincian Pesanan #ORD-{{ str_pad($order->id_order, 5, '0', STR_PAD_LEFT) }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pt-3">
                                    <div class="bg-light rounded-3 p-3 mb-4">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <p class="text-muted mb-1 small text-uppercase fw-bold">Informasi Pelanggan</p>
                                                    <h6 class="fw-bold text-dark mb-0 fs-5">{{ $order->nama_pembeli }}</h6>
                                                    <div class="text-muted small mt-1">
                                                        <i class="bi bi-envelope me-1"></i> {{ $order->email_pembeli }} | 
                                                        <i class="bi bi-whatsapp me-1 text-success"></i> {{ $order->telepon_pembeli }}
                                                    </div>
                                                </div>
                                                
                                                <div class="p-3 bg-white rounded-3 border">
                                                    <p class="text-muted mb-1 small text-uppercase fw-bold">Alamat Pengiriman Lengkap:</p>
                                                    <p class="text-dark mb-0" style="line-height: 1.5;">{{ $order->alamat_pembeli }}</p>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <div>
                                                    <p class="text-muted mb-0 small">Tanggal Pemesanan:</p>
                                                    <p class="fw-bold text-dark small mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                                </div>
                                                <div class="text-end">
                                                    <p class="text-muted mb-0 small">Status Saat Ini:</p>
                                                    <span class="fw-bold small text-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'danger') }}">
                                                        {{ strtoupper($order->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="fw-bold mb-3 small text-uppercase text-muted border-bottom pb-2">Item Pesanan:</h6>
                                    <ul class="list-group list-group-flush mb-4">
                                        @foreach($order->items as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-bottom">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-primary bg-opacity-10 rounded-2 d-flex justify-content-center align-items-center" style="width: 45px; height: 45px;">
                                                    <i class="bi bi-bag-heart text-primary fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold fs-6">{{ $item->product->nama_produk ?? 'Produk Dihapus' }}</h6>
                                                    <small class="text-muted">{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                                </div>
                                            </div>
                                            <span class="fw-bold text-dark">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-primary bg-opacity-10 rounded-3">
                                        <span class="fw-bold text-primary">Total Pembayaran:</span>
                                        <h4 class="fw-bold text-primary mb-0">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 pt-0 pb-4 justify-content-center">
                                    <button type="button" class="btn btn-secondary rounded-pill px-5 fw-bold" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <span class="fw-medium">Belum ada pesanan yang masuk.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center p-4 border-top">
            @if(method_exists($orders, 'links'))
                {{ $orders->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
</div>
@endsection
