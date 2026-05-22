@extends('layouts.admin')

@section('title', 'Daftar Reservasi')

@section('content')
<div style="max-width: 1200px; margin: 20px auto; padding: 20px; border-radius: 8px; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; color: #333;">Daftar Reservasi</h2>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background: #f8f9fa; text-align: left;">
                <th style="padding: 10px; border: 1px solid #ddd;">#</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Nama</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Alamat</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Waktu</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Event</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Jumlah Orang</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Kategori</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Tanggal Reservasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $index => $reservation)
            <tr style="background: {{ $index % 2 == 0 ? '#ffffff' : '#f2f2f2' }};">
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $index + 1 }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->name }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->address }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->time }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->event }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->people }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->category }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $reservation->created_at->format('d M Y, H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
