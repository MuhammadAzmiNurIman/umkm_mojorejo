<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Keranjang Anda kosong.'], 400);
        }

        $storeId = $cartItems->first()->store_id;
        if ($cartItems->pluck('store_id')->unique()->count() > 1) {
            return response()->json(['message' => 'Hanya bisa checkout dari satu store.'], 400);
        }

        $orderDetails = [];
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if (!$product || $item->quantity > $product->stock) {
                return response()->json(['message' => "Stok untuk {$product->title} tidak mencukupi."], 400);
            }
            $subtotal = $item->quantity * $product->price;
            $orderDetails[] = [
                'product_name' => $product->title,
                'quantity' => $item->quantity,
                'price' => $product->price,
                'subtotal' => $subtotal
            ];
            $totalPrice += $subtotal;
        }

        // Gunakan UUID untuk order_id agar unik
        $orderId = 'ORDER-' . uniqid();

        $order = Order::create([
            'user_id' => $user->id,
            'store_id' => $storeId,
            'order_id' => $orderId, // Simpan order_id ke database
            'order_details' => json_encode($orderDetails),
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId, // Gunakan UUID sebagai order_id
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone_number,
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->snap_token = $snapToken;
            $order->save();

            // **Hapus cart setelah checkout berhasil**
            Cart::where('user_id', $user->id)->delete();

            return response()->json([
                'snap_token' => $snapToken,
                'message' => 'Silakan selesaikan pembayaran melalui Midtrans'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memproses pembayaran', 'error' => $e->getMessage()], 500);
        }
    }




    public function addToCart(Request $request)
{
    $user = Auth::user();

    // Cek apakah produk sudah ada di cart
    $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $request->product_id)
                    ->first();

    if ($cartItem) {
        // Jika sudah ada, update jumlahnya
        $cartItem->quantity += $request->quantity;
        $cartItem->save();
    } else {
        // Jika belum ada, tambahkan ke cart
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'store_id' => $request->store_id,
            'quantity' => $request->quantity
        ]);
    }

    return response()->json(['message' => 'Produk ditambahkan ke keranjang']);
}

public function getCartData()
{
    $user = Auth::user();

    // Ambil data cart beserta relasi produk
    $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

    return response()->json($cartItems);
}

public function removeFromCart(Request $request)
{
    $cartItem = Cart::find($request->cart_id);

    if ($cartItem) {
        $cartItem->delete();
        return response()->json(['message' => 'Produk dihapus dari keranjang']);
    }

    return response()->json(['message' => 'Produk tidak ditemukan'], 404);
}

public function history()
{
    $orders = Order::with('user', 'store')->orderBy('created_at', 'desc')->get();

    return view('admin.orders.history', compact('orders'));
}

}

