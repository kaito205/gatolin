<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('keranjang', compact('cart'));
    }

    /**
     * Shared logic to handle adding items to the cart.
     */
    private function processAddToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = (int)$request->input('quantity', 1);

        // Check if stock is sufficient
        $currentInCart = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $requestedTotal = $currentInCart + $quantity;

        if ($product->stok_produk <= 0) {
            return "Maaf, stok produk ini sudah habis.";
        }

        if ($requestedTotal > $product->stok_produk) {
            return "Maaf, jumlah yang Anda pesan melebihi stok yang tersedia. (Stok sisa: " . $product->stok_produk . ")";
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $requestedTotal;
        } else {
            $cart[$id] = [
                "nama_produk" => $product->nama_produk,
                "quantity" => $quantity,
                "harga_produk" => $product->harga_produk,
                "foto_produk" => $product->foto_produk
            ];
        }

        session()->put('cart', $cart);
        return true;
    }

    public function add(Request $request, $id)
    {
        $result = $this->processAddToCart($request, $id);
        if ($result === true) {
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        }
        return redirect()->back()->with('error', $result);
    }

    public function buyNow(Request $request, $id)
    {
        $result = $this->processAddToCart($request, $id);
        if ($result === true) {
            return redirect()->route('keranjang');
        }
        return redirect()->back()->with('error', $result);
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $product = Product::find($request->id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.'], 404);
            }

            if ($request->quantity > $product->stok_produk) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Maaf, jumlah melebihi stok yang tersedia. (Maksimal: ' . $product->stok_produk . ')'
                ], 400);
            }

            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = (int)$request->quantity;
                session()->put('cart', $cart);
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false], 400);
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false], 400);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'email_pembeli' => 'required|email|max:255',
            'telepon_pembeli' => 'required|string|max:20',
            'alamat_pembeli' => 'required|string'
        ]);

        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        $totalHarga = 0;
        foreach ($cart as $details) {
            $totalHarga += $details['harga_produk'] * $details['quantity'];
        }

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // Create Order
            $order = \App\Models\Order::create([
                'user_id' => auth()->id(),
                'nama_pembeli' => $request->nama_pembeli,
                'email_pembeli' => $request->email_pembeli,
                'telepon_pembeli' => $request->telepon_pembeli,
                'alamat_pembeli' => $request->alamat_pembeli,
                'total_harga' => $totalHarga,
                'status' => 'pending'
            ]);

            // Create Order Items and Reduce Stock
            foreach ($cart as $id => $details) {
                $product = Product::find($id);
                
                // Final check for stock availability
                if (!$product || $product->stok_produk < $details['quantity']) {
                    $nama = $product ? $product->nama_produk : "Produk #$id";
                    $stok = $product ? $product->stok_produk : 0;
                    throw new \Exception("Stok tidak mencukupi untuk produk: $nama. (Stok sisa: $stok)");
                }

                \App\Models\OrderItem::create([
                    'order_id' => $order->id_order,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['harga_produk']
                ]);

                // Kurangi stok produk
                $product->stok_produk -= $details['quantity'];
                $product->save();
            }

            \Illuminate\Support\Facades\DB::commit();

            // Clear Cart
            session()->forget('cart');

            return redirect()->route('keranjang')->with('success', 'Checkout berhasil! Pesanan Anda sedang kami proses. Terima kasih telah berbelanja.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
