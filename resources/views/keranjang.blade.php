@extends('layouts.app')

@section('styles')
<style>
    .cart-container { max-width: 1000px; margin: 40px auto; padding: 20px; }
    .cart-table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .cart-table th { background: #f8f9fa; padding: 15px; text-align: left; color: #666; font-size: 14px; border-bottom: 1px solid #eee; }
    .cart-table td { padding: 20px 15px; border-bottom: 1px solid #eee; vertical-align: middle; }
    .item-img { width: 70px; height: 70px; object-fit: cover; border-radius: 5px; margin-right: 15px; }
    .qty-input { width: 60px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; text-align: center; }
    .btn-remove { background: none; border: none; color: #ef4444; cursor: pointer; font-size: 14px; font-weight: 500; }
    .cart-summary { margin-top: 30px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
    .total-label { font-size: 18px; color: #444; }
    .total-amount { font-size: 24px; font-weight: bold; color: var(--primary); }
    .btn-checkout { background: var(--primary); color: white; padding: 15px 40px; border-radius: 5px; text-decoration: none; font-weight: bold; font-size: 16px; border: none; cursor: pointer; }
    
    .payment-methods { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px; }
    .payment-option { border: 2px solid #eee; border-radius: 8px; padding: 12px; cursor: pointer; transition: all 0.3s; position: relative; display: flex; align-items: center; gap: 10px; }
    .payment-option:hover { border-color: var(--primary); background: #fdf2f2; }
    .payment-option input { display: none; }
    .payment-option.active { border-color: var(--primary); background: #fdf2f2; }
    .payment-option.active::after { content: '✓'; position: absolute; top: 5px; right: 8px; color: var(--primary); font-weight: bold; font-size: 12px; }
    .payment-icon { width: 24px; height: 24px; object-fit: contain; }
</style>
@endsection

@section('content')
<div class="cart-container">
    <h2 style="margin-bottom: 25px; color: var(--primary);">Keranjang Belanja Anda</h2>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="cart-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @if(count($cart) > 0)
                @foreach($cart as $id => $details)
                    @php 
                        $subtotal = $details['harga_produk'] * $details['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr data-id="{{ $id }}">
                        <td style="display: flex; align-items: center;">
                            <img src="{{ asset('img/' . $details['foto_produk']) }}" class="item-img">
                            <span style="font-weight: 500;">{{ $details['nama_produk'] }}</span>
                        </td>
                        <td>Rp {{ number_format($details['harga_produk'], 0, ',', '.') }}</td>
                        <td>
                            <input type="number" value="{{ $details['quantity'] }}" class="qty-input update-cart" min="1">
                        </td>
                        <td style="font-weight: bold; color: var(--primary);">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <button class="btn-remove remove-from-cart">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #999;">Keranjang belanja Anda kosong. <a href="{{ route('produk') }}" style="color: var(--primary);">Belanja sekarang!</a></td>
                </tr>
            @endif
        </tbody>
    </table>

    @if(count($cart) > 0)
    <div class="cart-summary">
        <div>
            <span class="total-label">Total Pembayaran:</span><br>
            <span class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
        <button class="btn-checkout" onclick="document.getElementById('checkoutModal').style.display='flex'">Checkout Sekarang</button>
    </div>
    @endif
</div>

<!-- Modal Checkout Sederhana (Non-Bootstrap, mengikuti style yg ada) -->
<div id="checkoutModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 30px; border-radius: 10px; width: 100%; max-width: 500px; position: relative;">
        <button onclick="document.getElementById('checkoutModal').style.display='none'" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
        <h3 style="margin-top: 0; margin-bottom: 20px; color: var(--primary);">Data Pengiriman</h3>
        
        <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Nama Lengkap</label>
                <input type="text" name="nama_pembeli" value="{{ auth()->user()->name ?? '' }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Masukkan nama lengkap">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email</label>
                <input type="email" name="email_pembeli" value="{{ auth()->user()->email ?? '' }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="email@contoh.com">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Nomor WhatsApp / Telepon</label>
                <input type="text" name="telepon_pembeli" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="08123456789">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Alamat Pengiriman Lengkap</label>
                <textarea name="alamat_pembeli" required rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Nama jalan, RT/RW, kelurahan, kecamatan, kota..."></textarea>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 500;">Metode Pembayaran</label>
                <div class="payment-methods">
                    <label class="payment-option active" onclick="selectPayment(this)">
                        <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked>
                        <span style="font-size: 14px;">Transfer Bank</span>
                    </label>
                    <label class="payment-option" onclick="selectPayment(this)">
                        <input type="radio" name="metode_pembayaran" value="E-Wallet">
                        <span style="font-size: 14px;">E-Wallet (OVO/DANA)</span>
                    </label>
                    <label class="payment-option" onclick="selectPayment(this)">
                        <input type="radio" name="metode_pembayaran" value="COD">
                        <span style="font-size: 14px;">Bayar di Tempat (COD)</span>
                    </label>
                </div>
            </div>
            <div id="bukti_container" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Unggah Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" id="bukti_input" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <small style="color: #666; font-size: 11px;">(Wajib untuk Transfer/E-Wallet. Format: JPG/PNG, Max 2MB)</small>
            </div>
            <button type="submit" class="btn-checkout" style="width: 100%;">Proses Pesanan (Rp {{ number_format($total ?? 0, 0, ',', '.') }})</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.val()
            },
            success: function (response) {
               window.location.reload();
            },
            error: function (xhr) {
                var message = "Terjadi kesalahan.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                alert(message);
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Yakin ingin menghapus produk ini dari keranjang?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    function selectPayment(element) {
        document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
        element.classList.add('active');
        const radio = element.querySelector('input');
        radio.checked = true;

        const buktiContainer = document.getElementById('bukti_container');
        const buktiInput = document.getElementById('bukti_input');
        
        if (radio.value === 'COD') {
            buktiContainer.style.display = 'none';
            buktiInput.required = false;
        } else {
            buktiContainer.style.display = 'block';
            buktiInput.required = true;
        }
    }

    // Initialize state
    document.addEventListener('DOMContentLoaded', function() {
        const activeRadio = document.querySelector('input[name="metode_pembayaran"]:checked');
        if (activeRadio) {
            selectPayment(activeRadio.parentElement);
        }
    });
</script>
@endsection
