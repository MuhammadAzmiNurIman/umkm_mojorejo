@extends('layouts.user')

@section('styles')
<style>
.wave {
    position: absolute;
    top: 0;
    left: 15%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 800px;
    height: auto;
    z-index: -1;
}

.wave-right {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    max-width: 400px;
    height: auto;
    z-index: -1;
    transform: rotate(180deg);
}
</style>
@endsection

@section('content')

<img class="wave" src="{{ asset('images/wave.png') }}">
<img class="wave-right" src="{{ asset('images/wave.png') }}">

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl mt-12 border border-gray-200 mb-10">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Formulir Reservasi</h2>

    @if(session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nama Pemesan</label>
            <input type="text" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all" placeholder="Masukkan nama Anda" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Alamat</label>
            <input type="text" name="address" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all" placeholder="Masukkan alamat" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Jam</label>
            <input type="time" name="time" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Acara</label>
            <input type="text" name="event" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all" placeholder="Masukkan jenis acara" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Jumlah Orang</label>
            <input type="number" name="people" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all" placeholder="Masukkan jumlah orang" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Kategori</label>
            <select name="category" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all bg-white" required>
                <option value="Gathering">Gathering</option>
                <option value="Meeting">Meeting</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white py-3 rounded-lg font-semibold text-lg hover:shadow-md transition-all hover:scale-105">Submit Reservasi</button>
    </form>
</div>
@endsection
