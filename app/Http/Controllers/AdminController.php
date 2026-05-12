<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productCount = \App\Models\Product::count();
        $products = \App\Models\Product::with('kategori')->paginate(5);
        
        $orderCount = \App\Models\Order::withTrashed()->count();
        $totalRevenue = \App\Models\Order::withTrashed()->where('status', '!=', 'cancelled')->sum('total_harga');
        
        $completedOrders = \App\Models\Order::withTrashed()->where('status', 'completed')->count();
        $cancelledOrders = \App\Models\Order::withTrashed()->where('status', 'cancelled')->count();
        
        return view('admin.dashboard', compact('productCount', 'products', 'orderCount', 'totalRevenue', 'completedOrders', 'cancelledOrders'));
    }

    public function orders()
    {
        $orders = \App\Models\Order::with('items.product')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function reports()
    {
        // Statistik Produk Terlaris
        $bestSellers = \App\Models\OrderItem::select('product_id', \DB::raw('SUM(quantity) as total_qty'))
            ->with('product')
            ->groupBy('product_id')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        // Total Penjualan Per Bulan (Sederhana)
        $monthlySales = \App\Models\Order::withTrashed()->select(\DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'), \DB::raw('SUM(total_harga) as total'))
            ->where('status', 'completed')
            ->groupBy('month')
            ->get();

        return view('admin.reports', compact('bestSellers', 'monthlySales'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required|numeric',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'video_produk' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer',
            'kategori_id' => 'required'
        ]);

        $imageName = time().'.'.$request->foto_produk->extension();  
        $request->foto_produk->move(public_path('img'), $imageName);

        $videoName = null;
        if ($request->hasFile('video_produk')) {
            $videoName = 'v_'.time().'.'.$request->video_produk->extension();
            $request->video_produk->move(public_path('img'), $videoName);
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'foto_produk' => $imageName,
            'video_produk' => $videoName,
            'deskripsi_produk' => $request->deskripsi_produk,
            'stok_produk' => $request->stok_produk,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit_product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required|numeric',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer',
            'kategori_id' => 'required'
        ]);

        if ($request->hasFile('foto_produk')) {
            $imageName = time().'.'.$request->foto_produk->extension();  
            $request->foto_produk->move(public_path('img'), $imageName);
            $product->foto_produk = $imageName;
        }

        if ($request->hasFile('video_produk')) {
            $videoName = 'v_'.time().'.'.$request->video_produk->extension();
            $request->video_produk->move(public_path('img'), $videoName);
            $product->video_produk = $videoName;
        }

        $product->nama_produk = $request->nama_produk;
        $product->harga_produk = $request->harga_produk;
        $product->deskripsi_produk = $request->deskripsi_produk;
        $product->stok_produk = $request->stok_produk;
        $product->kategori_id = $request->kategori_id;
        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus!');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|in:pending,dikemas,dikirim,completed,cancelled',
            'payment_status' => 'nullable|in:belum_bayar,menunggu_verifikasi,lunas'
        ]);

        $order = \App\Models\Order::findOrFail($id);
        
        if ($request->has('status')) {
            $order->status = $request->status;
        }

        if ($request->has('payment_status')) {
            $order->status_pembayaran = $request->payment_status;
        }
        
        $order->save();

        return redirect()->back()->with('success', 'Data pesanan berhasil diperbarui!');
    }

    public function deleteOrder($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        // Optional: restriction to only delete completed or cancelled
        if (!in_array($order->status, ['completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Hanya pesanan yang sudah selesai atau dibatalkan yang dapat dihapus.');
        }

        $order->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dihapus dari sistem.');
    }
}
