@extends('layouts.admin')

@section('title', 'Daftar Reservasi Paket Wisata')

@section('content')
<div style="max-width: 1200px; margin: 20px auto; padding: 20px; border-radius: 8px; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; color: #333;">Daftar Reservasi Paket Wisata</h2>

    @if (session('success'))
        <div style="background: #28a745; color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background: #f8f9fa; text-align: left;">
                <th style="padding: 10px; border: 1px solid #ddd;">#</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Nama Pemesan</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Alamat</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Jam</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Jenis Paket</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Jumlah Orang</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Kategori</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Tanggal Reservasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $index => $reservation)
            <tr style="background: {{ $index % 2 == 0 ? '#ffffff' : '#f2f2f2' }};">
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $index + 1 }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->nama_pemesan }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->alamat }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->jam }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->jenis_paket }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->jumlah_orang }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->category }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->created_at->format('d M Y, H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
