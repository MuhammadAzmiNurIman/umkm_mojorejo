@extends('layouts.user')

@section('title', 'Daftar Store')

@section('content')
<section class="section product"  style="margin-top: 5rem">
    <div class="container">
        <div class="breadcumb-wrapper">

            <h2 class="page-title">Daftar Warung</h2>

            <ol class="breadcumb-list">
              <li class="breadcumb-item">
                <a href="{{ route('user.dashboard') }}" class="breadcumb-link">Beranda</a>
              </li>
              <li class="breadcumb-item">Warung</li>
            </ol>
          </div>
        <ul class="grid-list">
            @foreach($stores as $store)

            <li>
              <div class="product-card">

                <figure class="card-banner">
                  <img src="{{ asset('storage/logo_toko/' . $store->logo_toko) }}" width="189" height="189" loading="lazy" alt="{{ $store->nama_toko }}">
                </figure>

                <div class="rating-wrapper">
                    @for ($i = 0; $i < floor($store->rating); $i++)
                        <ion-icon name="star"></ion-icon>
                    @endfor
                    @if ($store->rating - floor($store->rating) >= 0.5)
                        <ion-icon name="star-half-outline"></ion-icon>
                    @endif
                </div>

                <h3 class="h4 card-title">
                  <a href="{{ url('/store/' . $store->id) }}">{{ $store->nama_toko }}</a>
                </h3>

                <div class="price-wrapper">
                    <strong>Jam Operasional:</strong> {{ $store->jam_buka }} - {{ $store->jam_tutup }}
                </div>

                <a href="{{ route('store.show', ['id' => $store->id]) }}" class="btn btn-primary">
                    Lihat Menu
                </a>

              </div>
            </li>
            @endforeach
          </ul>

        </div>
      </section>
@endsection
