@extends('layouts.admin')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            color: #333;
            font-weight: bold;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .table {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background: black;
            color: white;
        }

        .table tbody tr:nth-child(even) {
            background: #f2f2f2;
        }

        .table td, .table th {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .btn-warning, .btn-danger {
            padding: 5px 10px;
            font-size: 14px;
        }

        img {
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
            max-width: 100px;
            height: auto;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background: #007bff;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: #007bff;
            border-color: #007bff;
            padding: 8px 15px;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-close {
            color: white;
            font-size: 18px;
        }
    </style>
@endsection

@section('title', 'Dashboard')

@section('content')

<div class="container">
    <h1>Tambah Produk</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product">
        <i class='bx bx-plus'></i> Add New
    </a>
    <br><br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Store</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th> {{-- Menampilkan kategori --}}
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->store->nama_toko }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category }}</td> {{-- Tampilkan kategori produk --}}
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/product/'.$product->image) }}" alt="Product Image" width="100">
                        @else
                            No image
                        @endif
                    </td>
                    <td>
                        <a href="javascript:void(0)" data-id="{{ $product->id }}" class="btn btn-warning btn-edit">Edit</a>
                        <a href="javascript:void(0)" data-id="{{ $product->id }}" class="btn btn-danger btn-delete">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL -->
<div class="modal fade" id="ajax-product-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productModal"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label>Store</label>
                        <select class="form-control" id="store_id" name="store_id" required>
                            <option value="">-- Pilih Toko --</option>
                            @foreach($store as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_toko }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>

                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input id="image" type="file" name="image" accept="image/*">
                        <input type="hidden" name="hidden_image" id="hidden_image">
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    // Tampilkan modal tambah produk
    $('#create-new-product').click(function () {
        $('#productForm')[0].reset();
        $('#product_id').val('');
        $('#ajax-product-modal').modal('show');
    });

    // Fungsi untuk Store (Tambah Data)
    function storeData() {
        let formData = new FormData($('#productForm')[0]);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            type: "POST",
            url: "{{ route('products.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "Produk berhasil ditambahkan!",
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Terjadi kesalahan saat menambah produk!",
                });
            }
        });
    }

    // Fungsi untuk Update Produk
    function updateData(product_id) {
        let formData = new FormData($('#productForm')[0]);
        // Kirim _method sebagai PUT untuk update
        formData.append('_method', 'PUT');

        $.ajax({
            type: "POST", // Menggunakan POST dengan _method PUT
            url: "/admin/produk/" + product_id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "Produk berhasil diperbarui!",
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Terjadi kesalahan saat memperbarui produk!",
                });
            }
        });
    }

    // Event submit form (Store atau Update)
    $('#productForm').on('submit', function(e) {
        e.preventDefault();
        let product_id = $('#product_id').val();

        if (product_id) {
            updateData(product_id); // Jika ada ID, update
        } else {
            storeData(); // Jika tidak ada ID, tambah data baru
        }
    });

    // Event untuk Edit Produk
    $(document).on('click', '.btn-edit', function () {
        let product_id = $(this).data('id');

        $.get("/admin/produk/" + product_id)
            .done(function (data) {
                // Isi form dengan data produk yang diterima
                $('#product_id').val(data.id);
                $('#store_id').val(data.store_id);
                $('#title').val(data.title);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#stock').val(data.stock);
                $('#category').val(data.category);
                $('#hidden_image').val(data.image);
                $('#ajax-product-modal').modal('show');
            })
            .fail(function(xhr) {
                console.log("Error:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Gagal mengambil data produk!",
                });
            });
    });

    // Event untuk Delete Produk
    $(document).on('click', '.btn-delete', function () {
        let product_id = $(this).data('id');

        Swal.fire({
            title: 'Anda yakin?',
            text: "Produk akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus produk!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/produk/" + product_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: "Produk berhasil dihapus!",
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Terjadi kesalahan!",
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush


@endsection
