@extends('layouts.user')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/product-details.css') }}">
@endsection

@section('title', 'Product Details')

@section('content')

<article>
    <section class="section product-details" style="margin-top: -30px;">
        <div class="container">
            <div class="breadcumb-wrapper">
                <h2 class="page-title">Detail Produk</h2>
                <ol class="breadcumb-list">
                    <li class="breadcumb-item">
                        <a href="{{ route('user.dashboard') }}" class="breadcumb-link">Beranda</a>
                    </li>
                    <li class="breadcumb-item">Detail Produk</li>
                </ol>
            </div>

            <div class="wrapper">
                <div class="product-details-img">
                    <figure class="product-display">
                        <img src="{{ asset('storage/product/' . $product->image) }}" width="700" height="700" loading="lazy"
                            alt="{{ $product->title }}" class="w-100" data-product-display>
                    </figure>
                </div>

                <div class="product-details-content">
                    <h3 class="product-title">{{ $product->title }}</h3>
                    <data class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</data>

                    <div class="rating-wrapper">
                        @for ($i = 0; $i < floor($store->rating); $i++)
                            <ion-icon name="star"></ion-icon>
                        @endfor
                        @if ($store->rating - floor($store->rating) >= 0.5)
                            <ion-icon name="star-half-outline"></ion-icon>
                        @endif
                    </div>

                    <p class="product-text">{{ $product->description }}</p>

                    <div class="product-weight-wrapper">
                        <p class="product-weight-title">Stock :</p>
                        <ul class="product-weight-list">
                            <li class="product-weight-item">
                                <label class="product-weight-label">{{ $product->stock }}</label>
                            </li>
                        </ul>
                    </div>

                    <div class="product-qty">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="product-qty-input" id="quantity">
                        <button class="btn btn-primary product-qty-btn"
                            data-id="{{ $product->id }}"
                            data-store-id="{{ $product->store_id }}">
                            Add To Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

<!-- SCRIPT AJAX UNTUK ADD TO CART -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addToCartButton = document.querySelector(".product-qty-btn");

        addToCartButton.addEventListener("click", function () {
            const productId = this.getAttribute("data-id");
            const storeId = this.getAttribute("data-store-id");
            const quantity = document.getElementById("quantity").value;

            axios.post("{{ route('cart.add') }}", {
                product_id: productId,
                store_id: storeId,
                quantity: quantity
            }, {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.data.message,
                    timer: 2000,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal2-popup-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                console.error("Terjadi kesalahan:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal menambahkan produk ke keranjang.',
                    customClass: {
                        popup: 'swal2-popup-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                });
            });
        });
    });
</script>

<style>
    .swal2-popup-custom {
        border-radius: 12px;
        padding: 20px;
        width: 380px;
    }
    .swal2-title-custom {
        font-size: 22px;
        font-weight: bold;
        color: #333;
    }
    .swal2-content-custom {
        font-size: 20px;
        color: #555;
    }
</style>

@endsection
