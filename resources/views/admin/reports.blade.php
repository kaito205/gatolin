@extends('layouts.admin')

@section('styles')
<style>
    .card-report {
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
    }

    .best-seller-card {
        background: white;
        border: 1px solid #f1f5f9;
        padding: 1rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .product-thumb {
        width: 50px;
        height: 50px;
        border-radius: 0.5rem;
        object-fit: cover;
    }

    @media print {
        #sidebar, .mobile-header, .no-print { display: none !important; }
        #main-content { margin-left: 0 !important; padding: 0 !important; }
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 no-print">
    <div>
        <h3 class="fw-bold text-dark mb-1">Laporan Penjualan</h3>
        <p class="text-muted small mb-0">Analisis performa bisnis Anda</p>
    </div>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-printer me-2"></i> Cetak Laporan
        </button>
    </div>
</div>

<div class="mb-5">
    <h6 class="fw-bold text-dark mb-3 text-uppercase small" style="letter-spacing: 1px;">Produk Terlaris</h6>
    <div class="row g-3">
        @forelse($bestSellers as $item)
        <div class="col-md-4">
            <div class="best-seller-card shadow-sm">
                <img src="{{ asset('img/' . $item->product->foto_produk) }}" class="product-thumb" alt="Prod">
                <div>
                    <div class="fw-bold text-dark small">{{ $item->product->nama_produk ?? 'Produk' }}</div>
                    <div class="text-success fw-bold small">{{ $item->total_qty }} Terjual</div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-muted">Belum ada data penjualan.</div>
        @endforelse
    </div>
</div>

<div class="card card-report">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0" id="monthlyTable">
                <thead>
                    <tr>
                        <th class="ps-4">Periode Bulan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($monthlySales as $sale)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $sale->month }}</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-bold" style="font-size: 10px;">SELESAI</span></td>
                        <td class="pe-4 text-end fw-bold text-primary fs-5">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">Belum ada rekap bulanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
