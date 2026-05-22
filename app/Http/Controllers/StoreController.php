<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    public function index()
    {
        $store = DB::table('store')->get();
        return view('admin.store.index', ['store' => $store]);
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);
        $products = Product::where('store_id', $id)->get(); // Ambil produk dari store ini

        return view('user.store.show', compact('store', 'products'));
    }


    public function listStore()
    {
        $stores =  Store::paginate(12);
        $products = Product::all(); // Ambil semua produk

        return view('user.store.index', compact('stores', 'products'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_toko' => 'required|string|max:255',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'phone_number' => 'required|numeric',
            'logo_toko' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        if ($request->hasFile('logo_toko')) {
            $file = $request->file('logo_toko');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Simpan langsung ke storage_path
            $file->move(storage_path('app/public/logo_toko/'), $fileName);

            if (!file_exists(storage_path('app/public/logo_toko/' . $fileName))) {
                return response()->json(['error' => 'File gagal disimpan'], 500);
            }

            $validated['logo_toko'] = $fileName;
        } else {
            return response()->json(['error' => 'File tidak ditemukan'], 400);
        }

        // Simpan ke database
        $store = Store::create($validated);

        return response()->json([
            'message' => 'Store berhasil ditambahkan!',
            'data' => $store,
        ], 201);
    }


    public function update(Request $request, $id)
{
    $store = Store::find($id);
    if (!$store) {
        return response()->json(['error' => 'Store tidak ditemukan'], 404);
    }

    $validated = $request->validate([
        'nama_toko' => 'nullable|string|max:255',
        'jam_buka' => 'nullable',
        'jam_tutup' => 'nullable',
        'phone_number' => 'nullable|numeric',
        'logo_toko' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $updateData = array_filter($validated, fn($value) => !is_null($value));

    // Jika tidak ada logo baru, gunakan logo lama
    if (!$request->hasFile('logo_toko')) {
        $updateData['logo_toko'] = $store->logo_toko;
    } else {
        // Hapus logo lama jika ada
        if ($store->logo_toko && file_exists(storage_path('app/public/logo_toko/' . $store->logo_toko))) {
            unlink(storage_path('app/public/logo_toko/' . $store->logo_toko));
        }

        // Simpan logo baru
        $file = $request->file('logo_toko');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(storage_path('app/public/logo_toko/'), $fileName);
        $updateData['logo_toko'] = $fileName;
    }

    // Pastikan ada data yang diupdate
    if (!empty($updateData)) {
        $store->update($updateData);
    }

    return response()->json([
        'message' => 'Store berhasil diperbarui!',
        'data' => $store,
    ], 200);
}

    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

            return response()->json([
                'message' => 'Store deleted successfully',
            ]);
        }

function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

}
