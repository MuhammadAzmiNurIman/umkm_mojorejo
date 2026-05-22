@extends('layouts.user')

@section('title', 'Daftar Menu')

@section('content')

<!-- #TOP PRODUCT -->
<section class="section top-product">
    <div class="container">
        <div class="breadcumb-wrapper" style="margin-top: -25px;">
            <h2 class="page-title">Produk</h2>

            <ol class="breadcumb-list">
              <li class="breadcumb-item">
                <a href="{{ route('store.list') }}" class="breadcumb-link">Store</a>
              </li>
              <li class="breadcumb-item">Daftar Menu</li>
            </ol>
          </div>

      <p class="section-subtitle"> -- Pasar Rakyat Mojorejo --</p>

      <h2 class="h2 section-title">Daftar Makanan Di {{ $store->nama_toko }}</h2>

      <ul class="top-product-list grid-list">

        <li class="top-product-item">
            @foreach ($products as $product)
          <div class="product-card top-product-card">

            <figure class="card-banner">
              <img src="{{ asset('storage/product/' . $product->image) }}" width="100" height="100" loading="lazy"
              alt="{{ $product->title }}">

              <div class="btn-wrapper">
                <button class="product-btn" aria-label="Add to Whishlist">
                  <ion-icon name="heart-outline"></ion-icon>

                  <div class="tooltip">Add to Whishlist</div>
                </button>

                <button class="product-btn" aria-label="Quick View" onclick="window.location.href='{{ route('product.details', ['id' => $product->id]) }}'">
                  <ion-icon name="eye-outline"></ion-icon>

                  <div class="tooltip">Quick View</div>
                </button>
              </div>
            </figure>

            <div class="card-content">

              <div class="rating-wrapper">
                @for ($i = 0; $i < floor($store->rating); $i++)
                    <ion-icon name="star"></ion-icon>
                @endfor
                @if ($store->rating - floor($store->rating) >= 0.5)
                    <ion-icon name="star-half-outline"></ion-icon>
                @endif
              </div>

              <h3 class="h4 card-title">
                <a href="./product-details.html">{{ $product->title }}</a>
              </h3>

              <div class="price-wrapper">
                {{-- <del class="del">$75.00</del> --}}

                Rp{{ number_format($product->price, 0, ',', '.') }}
              </div>

              <button class="btn btn-primary" onclick="window.location.href='{{ route('product.details', ['id' => $product->id]) }}'">Lihat Details</button>

            </div>

          </div>
        </li>
        @endforeach
      </ul>

    </div>
  </section>

  @endsection
