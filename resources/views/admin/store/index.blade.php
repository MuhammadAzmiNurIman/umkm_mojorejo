@extends('layouts.admin')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Sertakan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
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
            background: #343a40;
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
    <h1>Tambah Store</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-store">
        <i class='bx bx-plus'></i> Add New
    </a>
    <br><br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Store</th>
                <th>Jam Buka</th>
                <th>Jam Tutup</th>
                <th>Phone Number</th>
                <th>Logo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($store as $index => $store)
            <tr id="store-{{ $store->id }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ $store->nama_toko }}</td>
                <td>{{ $store->jam_buka }}</td>
                <td>{{ $store->jam_tutup }}</td>
                <td>{{ $store->phone_number }}</td>
                <td><img src="{{ asset('storage/logo_toko/' . $store->logo_toko) }}" alt="Logo toko" width="100"></td>
                <td>
                    <button class="btn btn-warning edit-store" data-id="{{ $store->id }}">Edit</button>
                    <button class="btn btn-danger delete-store" data-id="{{ $store->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL -->
<div class="modal fade" id="ajax-store-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="storeModal"></h4>
            </div>
            <div class="modal-body">
                <form id="storeForm" name="storeForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="store_id" id="store_id">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Buka</label>
                        <input type="time" class="form-control" id="jam_buka" name="jam_buka" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Tutup</label>
                        <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telefon</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input id="logo_toko" type="file" name="logo_toko" accept="image/*">
                        <input type="hidden" name="hidden_logo" id="hidden_logo">
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
<script>
$(document).ready(function () {
    function updateRowNumbers() {
        $('table tbody tr').each(function (index) {
            $(this).find('td:first').text(index + 1);
        });
    }
    // Tampilkan modal tambah store
    $('#create-new-store').click(function () {
        $('#storeForm')[0].reset();
        $('#store_id').val('');
        $('#ajax-store-modal').modal('show');
    });

    // Fungsi untuk Store (Tambah Data)
    function storeData() {
        let formData = new FormData($('#storeForm')[0]);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            type: "POST",
            url: "{{ route('store.store') }}",
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
                    text: 'Store berhasil ditambahkan!',
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menambah data!',
                });
            }
        });
    }

    // Fungsi untuk Update (Edit Data)
    function updateData(store_id) {
        let formData = new FormData($('#storeForm')[0]);
        // Pastikan _method di-set sebagai PUT
        formData.append('_method', 'PUT');

        $.ajax({
            type: "POST", // Masih menggunakan POST dengan _method PUT
            url: "/admin/store/" + store_id,
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
                    text: 'Store berhasil diperbarui!',
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memperbarui data!',
                });
            }
        });
    }

    // Event submit form (Store atau Update)
    $('#storeForm').on('submit', function(e) {
        e.preventDefault();
        let store_id = $('#store_id').val();

        if (store_id) {
            updateData(store_id); // Jika ada ID, update
        } else {
            storeData(); // Jika tidak ada ID, tambah data baru
        }
    });

    // Event untuk Edit Store
    $(document).on('click', '.edit-store', function () {
        let store_id = $(this).data('id');

        $.get("/admin/store/" + store_id, function (data) {
            $('#store_id').val(data.id);
            $('#nama_toko').val(data.nama_toko);
            $('#jam_buka').val(data.jam_buka);
            $('#jam_tutup').val(data.jam_tutup);
            $('#phone_number').val(data.phone_number);
            $('#hidden_logo').val(data.logo_toko);
            $('#ajax-store-modal').modal('show');
        }).fail(function(xhr) {
            console.log("Error:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal mengambil data store!',
            });
        });
    });

    // Event untuk Delete Store
    $(document).on('click', '.delete-store', function () {
        let store_id = $(this).data('id');

        Swal.fire({
            title: 'Anda yakin?',
            text: "Store akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus store!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/store/" + store_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Store berhasil dihapus!',
                        }).then(() => {
                            $('#store-' + store_id).remove();
                            updateRowNumbers(); // Memperbarui nomor urut setelah penghapusan
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan!',
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
