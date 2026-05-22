@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="head-title">
    <div class="left">
        <h1>Dashboard</h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#">Home</a>
            </li>
        </ul>
    </div>
    <a href="#" class="btn-download">
        <i class='bx bxs-cloud-download'></i>
        <span class="text">Download PDF</span>
    </a>
</div>

<ul class="box-info">
    <li>
        <i class='bx bxs-store'></i>
        <span class="text">
            <h3>{{ $storeCount }}</h3>
            <p>Total Store</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-package'></i>
        <span class="text">
            <h3>{{ $productCount }}</h3>
            <p>Total Produk</p>
        </span>
    </li>
    @isset($orderCount)
    <li>
        <i class='bx bxs-cart'></i>
        <span class="text">
            <h3>{{ $orderCount }}</h3>
            <p>Jumlah Pesanan</p>
        </span>
    </li>
    @endisset
</ul>
@endsection
