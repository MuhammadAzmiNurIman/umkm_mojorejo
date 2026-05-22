<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Order; // Pastikan model Order ada. Jika tidak, hapus atau sesuaikan.
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $storeCount = Store::count();
        $productCount = Product::count();
        $orderCount = Order::count();

        return view('admin.dashboard', compact('storeCount', 'productCount', 'orderCount'));
    }
}
