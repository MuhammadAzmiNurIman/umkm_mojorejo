<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        if ($filter === 'favorites') {
            $products = Product::with('store')
                ->withCount('likes')
                ->having('likes_count', '>', 0)
                ->orderByDesc('likes_count')
                ->limit(6) // Ambil maksimal 6 produk
                ->get();
        } elseif (in_array($filter, ['makanan', 'minuman'])) {
            $products = Product::with('store')
                ->where('category', $filter)
                ->limit(6) // Ambil maksimal 6 produk
                ->get();
        } else {
            $products = Product::with('store')
                ->limit(6) // Ambil maksimal 6 produk
                ->get();
        }

        $stores = Store::all();
        $contacts = Contact::latest()->get();

        return view('user.dashboard', compact('stores', 'products', 'contacts'));
    }


}
