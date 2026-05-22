@extends('layouts.user')

@section('title', 'Paket Wisata')

@section('content')

<section class="section top-product py-10">
    <p class="section-subtitle"> -- Kuliner Rakyat Mojorejo --</p>

    <h2 class="h2 section-title">Paket Wisata Desa Mojorejo</h2>

    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach (['paket1', 'paket2', 'paket3', 'paket4', 'paket5'] as $paket)
        <div class="w-full bg-white shadow-lg rounded-lg p-5 flex flex-col items-center text-center relative">
          <figure class="w-full h-[400px] flex justify-center items-center relative">
            <img src="{{ asset("images/$paket.jpg") }}" class="w-full h-full object-cover rounded-md cursor-pointer" onclick="openImageModal('{{ asset("images/$paket.jpg") }}')" alt="Paket Wisata">
            <div class="absolute top-2 right-2 bg-gray-800 text-white p-3 rounded-full cursor-pointer text-2xl" onclick="openImageModal('{{ asset("images/$paket.jpg") }}')">
              👁️
            </div>
          </figure>

          <div class="mt-4">
            <h2 class="text-2xl font-bold text-gray-800">Paket Wisata</h2>
            <p class="text-gray-600 mt-2">Nikmati perjalanan wisata dengan fasilitas terbaik.</p>
          </div>

          <button onclick="openReservationForm()" class="mt-6 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
            Reservasi Sekarang
          </button>
        </div>
        @endforeach
      </div>
    </div>
</section>

<!-- Modal Gambar -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 hidden justify-center items-center">
  <div class="relative">
    <img id="fullImage" class="max-w-full max-h-screen rounded-lg">
    <button onclick="closeImageModal()" class="absolute top-3 right-3 bg-black text-white px-3 py-2 rounded-full">✖</button>
  </div>
</div>

<!-- Modal Form Reservasi -->
<div id="reservationModal" class="fixed inset-0 bg-black bg-opacity-80 hidden justify-center items-center">
    <div class="bg-white p-12 rounded-lg w-full max-w-4xl h-[90vh] overflow-y-auto relative shadow-lg border border-gray-300">
      <button onclick="closeReservationForm()" class="absolute top-6 right-6 text-4xl text-gray-600 hover:text-red-500">✖</button>
      <h2 class="text-4xl font-bold text-center text-gray-800 mb-10">Form Reservasi</h2>

      <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-gray-800 text-xl font-semibold mb-3">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="w-full border-2 border-gray-400 p-5 text-xl rounded-lg" required>
        </div>

        <div>
            <label class="block text-gray-800 text-xl font-semibold mb-3">Alamat</label>
            <input type="text" name="alamat" class="w-full border-2 border-gray-400 p-5 text-xl rounded-lg" required>
        </div>

        <div>
            <label class="block text-gray-800 text-xl font-semibold mb-3">Jam</label>
            <input type="time" name="jam" class="w-full border-2 border-gray-400 p-5 text-xl rounded-lg" required>
        </div>

        <div>
            <label class="block text-gray-800 text-xl font-semibold mb-3">Jenis Paket Wisata</label>
            <select name="jenis_paket" class="w-full border-2 border-gray-400 p-5 text-xl rounded-lg" required>
                <option value="Ketahanan Pangan">Ketahanan Pangan</option>
                <option value="Budidaya Ikan">Budidaya Ikan</option>
                <option value="Kampung UMKM">Kampung UMKM</option>
                <option value="Kampung Organik">Kampung Organik</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-800 text-xl font-semibold mb-3">Jumlah Orang</label>
            <input type="number" name="jumlah_orang" class="w-full border-2 border-gray-400 p-5 text-xl rounded-lg" min="1" required>
        </div>

        <div>
            <label class="block text-gray-800 text-xl font-semibold mb-3">Category</label>
            <select name="category" class="w-full border-2 border-gray-400 p-5 text-xl rounded-lg" required>
                <option value="Halfboard">Halfboard - Rp 75.000/pax</option>
                <option value="Fullboard">Fullboard - Rp 100.000/pax</option>
            </select>
        </div>

        <button type="submit" class="mt-10 w-full bg-blue-600 text-white py-5 text-2xl font-bold rounded-lg hover:bg-blue-700">
            Kirim Reservasi
        </button>
      </form>
    </div>
</div>

<!-- Tambahkan CDN SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script Modal -->
<script>
  function openImageModal(imageSrc) {
    document.getElementById('fullImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
  }

  function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
  }

  function openReservationForm() {
    document.getElementById('reservationModal').classList.remove('hidden');
    document.getElementById('reservationModal').classList.add('flex');
  }

  function closeReservationForm() {
    document.getElementById('reservationModal').classList.add('hidden');
  }
</script>

<!-- SweetAlert untuk Notifikasi Sukses -->
@if(session('success'))
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
@endif

@endsection
