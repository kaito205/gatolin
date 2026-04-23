@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Tambah Produk Baru</h5>
                        <p class="text-muted small mb-0">Masukkan informasi detail untuk produk baru Anda.</p>
                    </div>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light text-secondary rounded-3">
                    <i class="bi bi-x-lg"></i> Batal
                </a>
            </div>

            <div class="card-body p-4 mt-2">
                @if ($errors->any())
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-3" role="alert">
                        <div class="d-flex align-items-center gap-2 fw-bold mb-2">
                            <i class="bi bi-exclamation-triangle-fill"></i> Terdapat kesalahan:
                        </div>
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" class="form-control form-control-lg bg-light border-0" placeholder="Contoh: Cushion Glam" required>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 fw-bold">Rp</span>
                                <input type="number" name="harga_produk" class="form-control form-control-lg bg-light border-0" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small">Stok Awal <span class="text-danger">*</span></label>
                            <input type="number" name="stok_produk" class="form-control form-control-lg bg-light border-0" placeholder="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small">Kategori Produk <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-select form-select-lg bg-light border-0" required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id_kategori }}">{{ $cat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small">Foto Produk <span class="text-danger">*</span></label>
                        <input type="file" name="foto_produk" class="form-control form-control-lg bg-light border-0" accept="image/*" required>
                        <div class="form-text mt-2 small text-muted"><i class="bi bi-info-circle"></i> Format yang didukung: JPG, PNG, WEBP. Maksimal 2MB.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small">Video Produk (Opsional)</label>
                        <input type="file" name="video_produk" class="form-control form-control-lg bg-light border-0" accept="video/*">
                        <div class="form-text mt-2 small text-muted"><i class="bi bi-info-circle"></i> Muncul saat di-hover. Format: MP4. Maksimal 20MB.</div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold text-dark small">Deskripsi Singkat <span class="text-danger">*</span></label>
                        <textarea name="deskripsi_produk" rows="4" class="form-control bg-light border-0" placeholder="Tuliskan keunggulan produk ini..." required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-accent btn-lg py-3 rounded-3 d-flex justify-content-center align-items-center gap-2">
                            <i class="bi bi-floppy"></i> Simpan Produk ke Katalog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
