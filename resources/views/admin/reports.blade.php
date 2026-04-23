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

    .custom-shadow {
        box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
    }
    
    .product-img-sm {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 12px;
    }

    /* Print Styles */
    @media print {
        #sidebar, .top-bar, .btn-print, .btn-excel, .no-print { display: none !important; }
        #main-wrapper { margin-left: 0 !important; padding: 0 !important; width: 100% !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        body { background-color: white !important; }
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1 h3">Laporan Penjualan</h2>
        <p class="text-muted small mb-0">Ringkasan performa penjualan dan produk terlaris toko Anda.</p>
    </div>
    <div class="d-flex gap-2">
        <button onclick="exportTableToExcel('monthlyTable', 'Laporan_Penjualan_Bulanan_GantolIn')" class="btn btn-success px-4 py-2 rounded-pill d-flex align-items-center gap-2 btn-excel shadow-sm" style="background-color: #10b981; border: none;">
            <i class="bi bi-file-earmark-excel"></i> Ekspor Excel
        </button>
        <button onclick="window.print()" class="btn btn-accent px-4 py-2 rounded-pill d-flex align-items-center gap-2 btn-print shadow-sm">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Top Products -->
    <div class="col-12">
        <div class="card border-0 custom-shadow rounded-4">
            <div class="card-header bg-white border-bottom-0 p-4 pb-0 d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 text-danger rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-fire fs-5"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">Produk Terlaris (Top 5)</h5>
            </div>
            
            <div class="card-body p-4 pt-3">
                <div class="row g-3">
                    @forelse($bestSellers as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border-0 transition-hover">
                            <img src="{{ asset('img/' . $item->product->foto_produk) }}" class="product-img-sm border shadow-sm" alt="Produk">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">{{ $item->product->nama_produk ?? 'Produk Dihapus' }}</h6>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1 small">
                                    Terjual: {{ $item->total_qty }} Unit
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center py-4 text-muted bg-light rounded-4">
                            <i class="bi bi-bar-chart-x fs-2 d-block mb-2"></i>
                            Belum ada data penjualan yang cukup.
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Summary -->
<div class="card border-0 custom-shadow rounded-4 mb-5">
    <div class="card-header bg-white border-bottom-0 p-4 pb-0 d-flex align-items-center gap-3">
        <div class="bg-info bg-opacity-10 text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-calendar3 fs-5"></i>
        </div>
        <h5 class="fw-bold text-dark mb-0">Ringkasan Pendapatan Bulanan</h5>
    </div>

    <div class="card-body p-0 mt-3">
        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0" id="monthlyTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Bulan</th>
                        <th>Status Transaksi</th>
                        <th class="text-end pe-4">Total Pendapatan Bersih</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($monthlySales as $sale)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ $sale->month }}</td>
                        <td>
                            <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                Selesai (Completed)
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <span class="fw-bold text-primary fs-6">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                <span class="fw-medium">Belum ada rekap bulanan.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    
    // Create a clone of the table so we can strip out HTML/icons before exporting
    var tableClone = tableSelect.cloneNode(true);
    
    // Remove formatting inside total amount (like Rp and dots) if needed, but for visual excel, standard html is fine.
    var tableHTML = tableClone.outerHTML.replace(/ /g, '%20');
    
    filename = filename ? filename + '.xls' : 'excel_data.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>
@endsection
