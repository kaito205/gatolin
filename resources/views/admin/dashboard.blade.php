@extends('layouts.admin')

@section('styles')
<style>
    :root {
        --admin-bg: #f8fafc;
        --admin-card: #ffffff;
    }

    .stat-card {
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
        background: #fff;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
    }

    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .product-img {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #f1f5f9;
    }

    .badge-stock {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
    }

    .table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        color: #1e293b;
    }
</style>
@endsection

@section('content')

<div class="mb-4">
    <h3 class="fw-bold text-dark mb-1">Ringkasan Bisnis</h3>
    <p class="text-muted small">Pantau performa toko Anda hari ini</p>
</div>

<!-- Statistics Row -->
<div class="row g-3 mb-5">
    <div class="col-xl col-md-4">
        <div class="card border-0 stat-card rounded-4 h-100 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-bag-heart-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Katalog</h6>
                    <h3 class="fw-bold text-dark mb-0">{{ $productCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-4">
        <div class="card border-0 stat-card rounded-4 h-100 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-info bg-opacity-10 text-info">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Pesanan</h6>
                    <h3 class="fw-bold text-dark mb-0">{{ $orderCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-4">
        <div class="card border-0 stat-card rounded-4 h-100 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-success bg-opacity-10 text-success">
                    <i class="bi bi-check-all"></i>
                </div>
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Selesai</h6>
                    <h3 class="fw-bold text-success mb-0">{{ $completedOrders }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-12">
        <div class="card border-0 stat-card rounded-4 h-100 text-white shadow-sm" style="background: linear-gradient(135deg, #db7093 0%, #be185d 100%);">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-white bg-opacity-20 text-white">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <h6 class="text-white text-opacity-75 fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Total Pendapatan</h6>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inventory Table -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold text-dark mb-0">Inventaris Produk</h5>
    <a href="{{ route('admin.products.create') }}" class="btn btn-accent px-4 py-2 rounded-pill d-flex align-items-center gap-2 shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $prod)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('img/' . $prod->foto_produk) }}" class="product-img" alt="Produk">
                            <span class="fw-bold">{{ $prod->nama_produk }}</span>
                        </div>
                    </td>
                    <td><span class="text-muted small fw-medium">{{ optional($prod->kategori)->nama_kategori ?? 'Umum' }}</span></td>
                    <td><span class="fw-bold">Rp {{ number_format($prod->harga_produk, 0, ',', '.') }}</span></td>
                    <td>
                        @php $sClass = $prod->stok_produk > 10 ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning'; @endphp
                        <span class="badge-stock {{ $sClass }}">{{ $prod->stok_produk }} Unit</span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.products.edit', $prod->id_produk) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">Edit</a>
                            <form action="{{ route('admin.products.delete', $prod->id_produk) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

@endsection
