<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Menampilkan daftar kontak di halaman testimonial
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('user.dashboard', compact('contacts'));
    }




    // Menyimpan data kontak yang dikirim dari form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Your message has been sent!');
    }

    // Menghapus data kontak
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Testimonial deleted successfully!');
    }
}
