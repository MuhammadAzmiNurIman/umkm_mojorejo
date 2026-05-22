@extends('layouts.user')


@section('title', 'Dashboard')

<style>
.grid-list {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Default: 3 kolom */
    gap: 20px;
}

/* Untuk tampilan HP & Tablet */
@media (max-width: 768px) {
    .grid-list {
        grid-template-columns: repeat(2, 1fr); /* Jadi 2 kolom */
    }
}

@media (max-width: 480px) {
    .grid-list {
        grid-template-columns: repeat(1, 1fr); /* Jadi 1 kolom */
    }
}

/* Styling untuk produk */
.product-card {
    text-align: center;
    padding: 15px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
}

/* Untuk gambar agar proporsional */
.product-card img {
    width: 100%;
    height: auto;
    max-width: 180px;
    object-fit: cover;
    border-radius: 10px;
}

/* Menyesuaikan tombol */
.btn {
    padding: 10px 15px;
    font-size: 14px;
}

/* Styling tambahan untuk toko */
.product-card .price-wrapper {
    font-size: 1.2rem;
    font-weight: bold;
    color: #00a05a;
}


</style>

@section('content')
<main>
    <article>

      <!-- #HERO -->
      <section class="hero" style="background-color: white;">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle">KKN MD UM 2025</p>

            <h2 class="h1 hero-title">
              Kuliner <span class="span">Rakyat</span>
              Mojorejo <span class="span">Kota Batu</span>
            </h2>

            <p class="hero-text">
              Pusat Kuliner Rakyat Mojorejo.
            </p>

            <a href="{{ route('store.list') }}" class="btn btn-primary">
              <span class="span">Pesan Sekarang</span>

              <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>
            </a>

          </div>

          <figure class="hero-banner">
            <img src="{{ asset('images/hero-banner.png') }}" width="603" height="634" loading="lazy" alt="Vegetables"
              class="w-100">
          </figure>

        </div>
      </section>

      <section class="section service" style="padding: 2rem 0;">
        <div class="container">
            <div style="background: #fff; padding: 1.5rem; border-radius: 8px;">
                <ul class="service-list" style="
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
                    list-style: none;
                    margin: 0;
                    padding: 0;
                ">
                    <li class="service-item" style="text-align: center; margin: 10px;">
                        <div class="item-icon" style="
                            background: #00a05a;
                            display: inline-block;
                            padding: 10px;
                            border-radius: 50%;
                        ">
                            <img src="{{ asset('images/Gathering Fix Icon.png') }}" width="40" height="40" loading="lazy" alt="Gathering icon">
                        </div>
                        <a href="{{ route('reservations.index') }}">
                            <h3 class="h3 item-title" style="margin-top: 0.5rem; color: #00a05a;">Gathering</h3>
                        </a>
                    </li>
                    <li class="service-item" style="text-align: center; margin: 10px;">
                        <div class="item-icon" style="
                            background: #00a05a;
                            display: inline-block;
                            padding: 10px;
                            border-radius: 50%;
                        ">
                            <img src="{{ asset('images/Meeting Fix.png') }}" width="40" height="40" loading="lazy" alt="Meeting icon">
                        </div>
                        <a href="{{ route('reservations.index') }}">
                            <h3 class="h3 item-title" style="margin-top: 0.5rem; color: #00a05a;">Meeting</h3>
                        </a>
                    </li>
                    <li class="service-item" style="text-align: center; margin: 10px;">
                        <div class="item-icon" style="
                            background: #00a05a;
                            display: inline-block;
                            padding: 10px;
                            border-radius: 50%;
                        ">
                            <img src="{{ asset('images/Entertainment Fix.png') }}" width="40" height="40" loading="lazy" alt="Entertainment icon">
                        </div>
                        <h3 class="h3 item-title" style="margin-top: 0.5rem; color: #00a05a;">Entertainment</h3>
                    </li>
                </ul>
            </div>
        </div>
    </section>

      <!--
        - #OFFERS
      -->

      <section class="section service" style="padding: 2rem 0; margin-top: 8rem; margin-bottom: 8rem; background: transparent;">
        <p class="section-subtitle"> -- Kuliner Rakyat Mojorejo --</p>

        <h2 class="h2 section-title">Berita dan Dokumentasi</h2>

        <div class="container">
            <div style="background: #fff; padding: 1.5rem; border-radius: 8px;">
                <ul class="service-list" style="
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
                    list-style: none;
                    margin: 0;
                    padding: 0;
                ">
                    <li class="service-item" style="text-align: center; margin: 10px;">
                        <div class="item-icon" style="
                            display: inline-block;
                            padding: 10px;
                            border-radius: 50%;
                        ">
                            <img src="{{ asset('images/icons8-news-50.png') }}" width="40" height="40" loading="lazy" alt="Gathering icon">
                        </div>
                        <a href="https://kim-mojorejo23.kim.id/berita/search?keyword=kuliner+" target="_blank">
                            <h3 class="h3 item-title" style="margin-top: 0.5rem; color: #000;">Berita Kuliner Rakyat Mojorejo</h3>
                        </a>
                    </li>
                    <li class="service-item" style="text-align: center; margin: 10px;">
                        <div class="item-icon" style="
                            display: inline-block;
                            padding: 10px;
                            border-radius: 50%;
                        ">
                            <img src="{{ asset('images/icons8-gallery-64.png') }}" width="40" height="40" loading="lazy" alt="Meeting icon">
                        </div>
                        <a href="https://kim-mojorejo23.kim.id/gallery" target="_blank">
                            <h3 class="h3 item-title" style="margin-top: 0.5rem; color: #000;">Lihat Galeri Kuliner Rakyat Mojorejo</h3>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>


      <!-- #PRODUCT -->
      <section class="section product">
        <div class="container">

          <p class="section-subtitle"> -- Kuliner Rakyat Mojorejo --</p>

          <h2 class="h2 section-title">Semua Produk</h2>
          <ul class="filter-list">
            <li>
                <a href="{{ route('user.dashboard', ['filter' => 'all']) }}" class="filter-btn {{ request('filter') == 'all' ? 'active' : '' }}">
                    <ion-icon name="storefront-outline" class="filter-icon"></ion-icon>
                    <p class="filter-text">Semua Produk</p>
                </a>
            </li>

            <li>
                <a href="{{ route('user.dashboard', ['filter' => 'favorites']) }}" class="filter-btn {{ request('filter') == 'favorites' ? 'active' : '' }}">
                    <ion-icon name="heart-outline" class="filter-icon"></ion-icon>
                    <p class="filter-text">Menu Favorit</p>
                </a>
            </li>

            <li>
                <a href="{{ route('user.dashboard', ['filter' => 'makanan']) }}" class="filter-btn {{ request('filter') == 'makanan' ? 'active' : '' }}">
                    <ion-icon name="fast-food-outline" class="filter-icon"></ion-icon>
                    <p class="filter-text">Makanan</p>
                </a>
            </li>

            <li>
                <a href="{{ route('user.dashboard', ['filter' => 'minuman']) }}" class="filter-btn {{ request('filter') == 'minuman' ? 'active' : '' }}">
                    <ion-icon name="cafe-outline" class="filter-icon"></ion-icon>
                    <p class="filter-text">Minuman</p>
                </a>
            </li>
        </ul>

        <ul class="grid-list" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @foreach ($products->take(6) as $product)
                <li class="top-product-item">
                    <div class="product-card top-product-card">
                        <figure class="card-banner">
                            <img src="{{ asset('storage/product/' . $product->image) }}" width="100" height="100" loading="lazy" alt="{{ $product->title }}">

                            <div class="btn-wrapper">
                                <button class="product-btn btn-like" data-id="{{ $product->id }}" aria-label="Add to Wishlist">
                                    <ion-icon class="like-icon" name="heart-outline" style="font-size: 24px;"></ion-icon>
                                    <span class="like-count" style="
                                        position: absolute;
                                        top: -15px;
                                        right: -10px;
                                        color:#333;
                                        background-color:hsl(152, 95%, 39%);
                                        font-size: 1.5rem;
                                        padding: 2px 5px;
                                        border-radius: 50%;
                                        min-width: 20px;
                                        text-align: center;
                                        line-height: 1;
                                    ">{{ $product->likes()->count() }}</span>
                                    <div class="tooltip" style="margin-top: 5px;">Beri Like</div>
                                </button>

                                <button class="product-btn" aria-label="Quick View" onclick="window.location.href='{{ route('product.details', ['id' => $product->id]) }}'">
                                    <ion-icon name="eye-outline"></ion-icon>
                                    <div class="tooltip">Quick View</div>
                                </button>
                            </div>
                        </figure>

                        <div class="card-content">
                            <h3 class="h4 card-title">
                                <a href="{{ route('product.details', ['id' => $product->id]) }}">{{ $product->title }}</a>
                            </h3>

                            <div class="price-wrapper">
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


      <!-- #TOP PRODUCT -->
      <section class="section top-product">
        <div class="container">

          <p class="section-subtitle"> -- Kuliner Rakyat Mojorejo --</p>

          <h2 class="h2 section-title">Warung Kuliner </h2>

          <ul class="top-product-list grid-list" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @foreach($stores->take(6) as $store)
                <li style="list-style: none;">
                    <div class="product-card" style="width: 100%; text-align: center;">
                        <figure class="card-banner">
                            <img src="{{ asset('storage/logo_toko/' . $store->logo_toko) }}" width="189" height="189" loading="lazy" alt="{{ $store->nama_toko }}">
                        </figure>
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

        <div style="text-align: right; margin-top: 20px;">
            <a href="{{ route('store.list', ['id' => 'all']) }}" class="btn btn-secondary" style="background-color: hsl(152, 95%, 39%);; color: #fff; padding: 10px 20px; border-radius: 5px;">See More</a>
        </div>

        </div>
      </section>

        <!-- #PARTNER -->
        <section class="section partner" style="padding: 2rem 0;">
                <!-- Judul & Subtitle -->
            <p class="section-subtitle">
                -- Kuliner Rakyat Mojorejo --
            </p>
            <h2 class="h2 section-title">
                Media Partners
            </h2>

                <!-- Wrapper putih untuk logo -->
            <div style="
                width: 100%;
                background: #fff;
                /* Tambahkan margin-top untuk jarak antara teks & bar putih */
                margin-top: 20px;
                padding: 20px 0;
                ">
                <ul style="
                    display: flex;
                    flex-wrap: nowrap;
                    justify-content: space-between;
                    align-items: center;
                    list-style: none;
                    margin: 0;
                    padding: 0 40px;
                    box-sizing: border-box;
                    width: 100%;
                ">
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/Lambang-UM.png') }}" alt="Partner UM" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/psdw.png') }}" alt="Partner PSDW" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/LOGO KKN FINAL.png') }}" alt="Partner KKN" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/Logo Inspiring.png') }}" alt="Partner Inspiring" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/LOGO Kota Batu.png') }}" alt="Partner Kota Batu" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/Logo Bumdes.png') }}" alt="Partner Kota Batu" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/Logo PKK.png') }}" alt="Partner PKK" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/Logo KIM.png') }}" alt="Partner KIM" style="height: 100px; object-fit: contain;">
                </li>
                <li style="margin: 0 10px;">
                    <img src="{{ asset('images/Logo Mojorejo TV.png') }}" alt="Partner Mojorejo TV" style="height: 100px; object-fit: contain;">
                </li>
                </ul>
                </div>
        </section>


        <!-- #TESTIMONIALS -->
        <section class="section testimonials">
            <div class="container">
                <p class="section-subtitle">-- Kuliner Rakyat Mojorejo --</p>
                <h2 class="h2 section-title">Testimoni</h2>

                <ul style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; list-style: none; padding: 0;">
                    @foreach ($contacts as $contact)
                        <li style="display: flex; justify-content: center;">
                            <div style="
                                background: #fff;
                                border-radius: 12px;
                                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                                padding: 20px;
                                text-align: center;
                                transition: transform 0.3s ease-in-out;
                                max-width: 350px;
                                width: 100%;
                            "
                            onmouseover="this.style.transform='translateY(-5px)'"
                            onmouseout="this.style.transform='translateY(0)'">

                                <div>
                                    <blockquote style="font-style: italic; color: #555; line-height: 1.6; margin-bottom: 15px;">
                                        "{{ $contact->message }}"
                                    </blockquote>

                                    <div>
                                        <h3 style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 5px;">
                                            {{ $contact->name }}
                                        </h3>
                                        <p style="font-size: 14px; color: #777; margin-bottom: 0;">
                                            {{ $contact->email }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

    </article>
  </main>

  <script>
    $(document).ready(function () {
        $('.btn-like').on('click', function () {
            let productId = $(this).data('id');
            let $btn = $(this);

            $.ajax({
                type: "POST",
                url: "/customer/produk/" + productId + "/toggle-like",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Ubah icon berdasarkan respons
                    if(response.message === 'Produk telah disukai'){
                        $btn.find('.like-icon').attr('name', 'heart');
                    } else {
                        $btn.find('.like-icon').attr('name', 'heart-outline');
                    }

                    // Update jumlah like
                    $btn.find('.like-count').text(response.like_count);
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    alert("Terjadi kesalahan saat melakukan like/unlike");
                }
            });
        });
    });
    </script>

@endsection
