@extends('layouts.admin')

@section('title', 'Histori Pemesanan')

@section('content')
<div style="max-width: 1200px; margin: 20px auto; padding: 20px; border-radius: 8px; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; color: #333;">Histori Pemesanan</h2>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background: #f8f9fa; text-align: left;">
                <th style="padding: 10px; border: 1px solid #ddd;">#</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Pemesan</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Store</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Produk</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Total Harga</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Waktu Pemesanan</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Status</th> <!-- Tambahan kolom status -->
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
            <tr style="background: {{ $index % 2 == 0 ? '#ffffff' : '#f2f2f2' }};">
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $index + 1 }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $order->user->name }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $order->store->nama_toko }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    @php
                        $orderDetails = json_decode($order->order_details, true);
                    @endphp
                    @foreach ($orderDetails as $detail)
                        <div>
                            🍽️ {{ $detail['product_name'] }} - {{ $detail['quantity'] }}x
                        </div>
                    @endforeach
                </td>
                <td style="padding: 10px; border: 1px solid #ddd;">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $order->created_at->format('d M Y, H:i') }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    @php
                        $statusClasses = [
                            'pending' => 'background: #ffcc00; color: black; padding: 5px 10px; border-radius: 4px;',
                            'processing' => 'background: #007bff; color: white; padding: 5px 10px; border-radius: 4px;',
                            'completed' => 'background: #28a745; color: white; padding: 5px 10px; border-radius: 4px;',
                            'cancelled' => 'background: #dc3545; color: white; padding: 5px 10px; border-radius: 4px;',
                        ];
                        $statusText = [
                            'pending' => 'Menunggu Pembayaran',
                            'processing' => 'Sedang Diproses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                        ];
                    @endphp
                    <span style="{{ $statusClasses[$order->status] ?? 'background: #6c757d; color: white; padding: 5px 10px; border-radius: 4px;' }}">
                        {{ $statusText[$order->status] ?? 'Tidak Diketahui' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
