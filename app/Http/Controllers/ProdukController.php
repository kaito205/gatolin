<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi_produk', 'like', "%{$search}%");
            });
        }

        // Filter by Category
        if ($request->filled('category')) {
            $query->where('kategori_id', $request->input('category'));
        }

        $products = $query->get();
        $categories = Category::all();

        return view('produk', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $relatedProducts = Product::where('kategori_id', $product->kategori_id)
                                  ->where('id_produk', '!=', $id)
                                  ->take(4)
                                  ->get();

        return view('produk_detail', compact('product', 'categories', 'relatedProducts'));
    }
}
