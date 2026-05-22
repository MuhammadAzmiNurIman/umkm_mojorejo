<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('store')->get(); // Ambil produk beserta toko
        $store = Store::all(); // Ambil daftar toko untuk dropdown
        return view('admin.produk.index', compact('products', 'store'));
    }

    public function show($id)
    {
        $product = Product::with('store')->find($id);
        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }
        return response()->json($product);
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id); // Ambil produk berdasarkan ID

        // Ambil informasi toko yang menjual produk ini (jika ada relasi)
        $store = Store::where('id', $product->store_id)->first();

        return view('user.product.productDetails', compact('product', 'store'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:store,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'category'    => 'required|in:makanan,minuman',
        ]);

        $product = Product::find($request->product_id) ?? new Product();
        $product->store_id = $request->store_id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category= $request->category;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = storage_path('app/public/product/' . $fileName);

            // Pastikan direktori ada
            if (!file_exists(dirname($filePath))) {
                mkdir(dirname($filePath), 0777, true);
            }

            // Hapus gambar lama jika ada
            if ($product->image && file_exists(storage_path('app/public/product/' . $product->image))) {
                unlink(storage_path('app/public/product/' . $product->image));
            }

            // Pindahkan file ke storage_path
            $file->move(dirname($filePath), $fileName);
            $product->image = $fileName;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil disimpan',
            'data' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'store_id' => 'nullable|exists:store,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'category'    => 'nullable|in:makanan,minuman',
        ]);

        $updateData = array_filter($validated, fn($value) => !is_null($value));

        // Jika tidak ada gambar baru, gunakan gambar lama
        if (!$request->hasFile('image')) {
            $updateData['image'] = $product->image;
        } else {
            // Hapus gambar lama jika ada
            if ($product->image && file_exists(storage_path('app/public/product/' . $product->image))) {
                unlink(storage_path('app/public/product/' . $product->image));
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/product/'), $fileName);
            $updateData['image'] = $fileName;
        }

        // Pastikan ada data yang diupdate
        if (!empty($updateData)) {
            $product->update($updateData);
        }

        return response()->json([
            'message' => 'Produk berhasil diperbarui!',
            'data' => $product,
        ], 200);
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image && Storage::exists('public/product/' . $product->image)) {
            Storage::delete('public/product/' . $product->image);
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
    }

        public function toggleLike(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user(); // asumsikan user sudah login

        if ($product->likes()->where('user_id', $user->id)->exists()) {
            $product->likes()->detach($user->id);
            $message = 'Like telah dihapus';
        } else {
            $product->likes()->attach($user->id);
            $message = 'Produk telah disukai';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'like_count' => $product->likes()->count()
        ]);
    }
}
