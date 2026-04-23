@extends('layouts.admin')

@section('styles')
<style>
    .stat-icon-wrapper {
        width: auto;
        height: auto;
        min-width: unset;
        background: transparent !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: all 0.3s ease;
    }
    
    .product-img {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
    }

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
    
    /* Pagination Overrides */
    .pagination { margin-bottom: 0; }
    .page-link { color: #64748b; border-radius: 8px; margin: 0 4px; border: 1px solid #f1f5f9; font-weight: 600; padding: 10px 16px; }
    .page-item.active .page-link { background-color: #db7093; border-color: #db7093; color: white; box-shadow: 0 4px 10px rgba(219,112,147,0.2); }
    .page-link:hover { color: #be185d; background-color: #fff1f2; border-color: #fff1f2; }
</style>
@endsection

@section('content')

<!-- Statistics Row -->
<div class="row g-3 mb-5">
    <!-- Total Products -->
    <div class="col-xl col-md-4">
        <div class="card border-0 custom-shadow rounded-4 h-100 overflow-hidden">
            <div class="card-body p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper text-primary">
                    <i class="bi bi-bag-heart-fill"></i>
                </div>
                <div>
                    <h6 class="text-secondary fw-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 1px;">Katalog</h6>
                    <h4 class="fw-bold text-dark mb-0">{{ $productCount }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-xl col-md-4">
        <div class="card border-0 custom-shadow rounded-4 h-100 overflow-hidden">
            <div class="card-body p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper text-info">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h6 class="text-secondary fw-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 1px;">Pesanan</h6>
                    <h4 class="fw-bold text-dark mb-0">{{ $orderCount }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Orders -->
    <div class="col-xl col-md-4">
        <div class="card border-0 custom-shadow rounded-4 h-100 overflow-hidden">
            <div class="card-body p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper text-success">
                    <i class="bi bi-check-all"></i>
                </div>
                <div>
                    <h6 class="text-secondary fw-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 1px;">Selesai</h6>
                    <h4 class="fw-bold text-dark mb-0 text-success">{{ $completedOrders }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancelled Orders -->
    <div class="col-xl col-md-4">
        <div class="card border-0 custom-shadow rounded-4 h-100 overflow-hidden">
            <div class="card-body p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper text-danger">
                    <i class="bi bi-x-lg"></i>
                </div>
                <div>
                    <h6 class="text-secondary fw-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 1px;">Batal</h6>
                    <h4 class="fw-bold text-dark mb-0 text-danger">{{ $cancelledOrders }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="col-xl col-md-8">
        <div class="card border-0 custom-shadow rounded-4 h-100 text-white" style="background: linear-gradient(135deg, #db7093 0%, #be185d 100%);">
            <div class="card-body p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper text-white">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <h6 class="text-white text-opacity-75 fw-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 1px;">Pendapatan</h6>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inventory Table -->
<div class="card border-0 custom-shadow rounded-4">
    <div class="card-header bg-white border-bottom-0 p-4 pb-0 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-dark mb-1">Inventaris Produk</h5>
            <p class="text-muted small mb-0">Kelola stok dan katalog Gantol.In Anda.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-accent px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Tambah Baru
        </a>
    </div>

    <div class="card-body p-0 mt-3">
        @if(session('success'))
            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success m-4 d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Produk & Gambar</th>
                        <th>Kategori</th>
                        <th>Harga Retail</th>
                        <th>Status Stok</th>
                        <th class="pe-4">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $prod)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('img/' . $prod->foto_produk) }}" class="product-img border" alt="Produk">
                                <span class="fw-bold text-dark">{{ $prod->nama_produk }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary fw-medium">{{ optional($prod->kategori)->nama_kategori ?? 'Umum' }}</span>
                        </td>
                        <td>
                            <span class="fw-bold text-dark">Rp {{ number_format($prod->harga_produk, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            @if($prod->stok_produk > 10)
                                <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                    {{ $prod->stok_produk }} Unit
                                </span>
                            @else
                                <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2">
                                    {{ $prod->stok_produk }} Unit
                                </span>
                            @endif
                        </td>
                        <td class="pe-4">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.products.edit', $prod->id_produk) }}" class="btn btn-sm btn-light text-primary border-0 bg-primary bg-opacity-10" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.products.delete', $prod->id_produk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger border-0 bg-danger bg-opacity-10" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center p-4 border-top">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
