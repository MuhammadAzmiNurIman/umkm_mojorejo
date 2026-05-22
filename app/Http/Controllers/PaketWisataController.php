<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index()
    {
        return view('user.paketWisata.index');
    }

    public function adminIndex()
    {
        $reservations = PaketWisata::all(); // Mengambil semua data reservasi
        return view('admin.paketWisata.index', compact('reservations'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jam' => 'required',
            'jenis_paket' => 'required|string',
            'jumlah_orang' => 'required|integer|min:1',
            'category' => 'required|string',
        ]);

        PaketWisata::create([
            'nama_pemesan' => $request->nama_pemesan,
            'alamat' => $request->alamat,
            'jam' => $request->jam,
            'jenis_paket' => $request->jenis_paket,
            'jumlah_orang' => $request->jumlah_orang,
            'category' => $request->category,
        ]);

        return redirect()->route('user.paketWisata')->with('success', 'Reservasi berhasil disimpan!');
    }


}
