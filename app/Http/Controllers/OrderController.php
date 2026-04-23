<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.product')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('pesanan.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::where('id_order', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($order->status != 'pending') {
            return redirect()->back()->with('error', 'Hanya pesanan dengan status pending yang dapat dibatalkan.');
        }

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // Restore stock
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->stok_produk += $item->quantity;
                    $item->product->save();
                }
            }

            $order->status = 'cancelled';
            $order->save();

            \Illuminate\Support\Facades\DB::commit();
            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan dan stok telah dikembalikan.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan pesanan.');
        }
    }

    public function destroy($id)
    {
        $order = Order::where('id_order', $id)->where('user_id', Auth::id())->firstOrFail();

        if (!in_array($order->status, ['completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Hanya pesanan yang sudah selesai atau dibatalkan yang dapat dihapus dari riwayat.');
        }

        $order->delete();
        return redirect()->back()->with('success', 'Riwayat pesanan berhasil dihapus.');
    }
}
