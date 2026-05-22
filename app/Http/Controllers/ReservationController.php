<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('user.reservasi.reservasi', compact('reservations'));
    }


    public function adminIndex()
    {
        $reservations = Reservation::all(); // Ambil semua data reservasi
        return view('admin.reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'time' => 'required',
            'event' => 'required|string',
            'people' => 'required|integer|min:1',
            'category' => 'required|in:Meeting,Gathering'
        ]);

        Log::info('Data reservasi diterima:', $request->all());

        Reservation::create([
            'name' => $request->name,
            'address' => $request->address,
            'time' => $request->time,
            'event' => $request->event,
            'people' => $request->people,
            'category' => $request->category
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil disimpan!');
    }
}
