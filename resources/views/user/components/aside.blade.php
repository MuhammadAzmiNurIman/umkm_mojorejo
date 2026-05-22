<style>
    .payment-options {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
}

.payment-options label {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.payment-options label:hover {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.payment-options input[type="radio"] {
    appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #ccc;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: relative;
}

.payment-options input[type="radio"]:checked {
    border-color: #007bff;
    background-color: #007bff;
}

.payment-options input[type="radio"]::after {
    content: "";
    width: 10px;
    height: 10px;
    background: white;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
}

.payment-options input[type="radio"]:checked::after {
    display: block;
}

</style>
<aside class="aside">
    <div class="side-panel" data-side-panel="cart">
        <!-- Tombol close -->
        <button class="panel-close-btn" aria-label="Close cart" data-panel-btn="cart">
            <ion-icon name="close-outline"></ion-icon>
        </button>

        <!-- List Produk dalam Cart -->
        <ul class="panel-list"></ul> <!-- Data dari JavaScript -->

        <!-- Subtotal -->
        <div class="subtotal">
            <p class="subtotal-text">Subtotal:</p>
            <data class="subtotal-value" value="0">Rp 0</data> <!-- Akan di-update oleh JS -->
        </div>

        <!-- Pilihan Metode Pembayaran -->
        <div class="payment-options">
            <label>
                <input type="radio" name="payment_method" value="cash" checked>
                Tunai
            </label>
            <label>
                <input type="radio" name="payment_method" value="midtrans">
                Virtual Payment
            </label>
        </div>


        <!-- Tombol Checkout -->
        <button id="checkout-btn" class="panel-btn">CheckOut</button>
    </div>
</aside>

<!-- SCRIPT MIDTRANS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<!-- SCRIPT UNTUK MENAMPILKAN & MENGELOLA CART -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const panelList = document.querySelector(".panel-list");
        const subtotalValue = document.querySelector(".subtotal-value");
        const checkoutBtn = document.getElementById("checkout-btn");
        const paymentMethods = document.getElementsByName("payment_method");

        function getSelectedPaymentMethod() {
            const selected = [...paymentMethods].find(radio => radio.checked);
            return selected ? selected.value : null;
        }

        function loadCartData() {
            axios.get("{{ route('cart.data') }}")
                .then(response => {
                    panelList.innerHTML = "";
                    let subtotal = 0;
                    response.data.forEach(item => {
                        const listItem = document.createElement("li");
                        listItem.classList.add("panel-item");
                        const itemTotalPrice = item.product.price * item.quantity;
                        subtotal += itemTotalPrice;
                        listItem.innerHTML = `
                            <a href="#" class="panel-card">
                                <figure class="item-banner">
                                    <img src="{{ asset('storage/product/') }}/${item.product.image}" width="46" height="46" loading="lazy"
                                        alt="${item.product.title}">
                                </figure>
                                <div>
                                    <p class="item-title">${item.product.title}</p>
                                    <p class="item-value">Rp ${item.product.price.toLocaleString('id-ID')} x ${item.quantity}</p>
                                </div>
                                <button class="delete-cart-item" data-id="${item.id}">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </a>
                        `;
                        panelList.appendChild(listItem);
                    });
                    subtotalValue.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                    subtotalValue.setAttribute("value", subtotal);
                })
                .catch(error => console.error("Gagal mengambil data cart:", error));
        }

        loadCartData();

        checkoutBtn.addEventListener("click", function () {
            const paymentMethod = getSelectedPaymentMethod();
            if (!paymentMethod) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Metode Pembayaran',
                    text: 'Silakan pilih metode pembayaran terlebih dahulu!'
                });
                return;
            }

            axios.post("{{ route('checkout.process') }}", { payment_method: paymentMethod }, {
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
            })
            .then(response => {
                if (paymentMethod === "cash") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Checkout Berhasil',
                        text: 'Pesanan Anda telah dikonfirmasi!',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => location.reload());
                } else if (response.data.snap_token) {
                    snap.pay(response.data.snap_token, {
                        onSuccess: function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil',
                                text: 'Pesanan Anda telah dikonfirmasi!',
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => location.reload());
                        },
                        onPending: function() {
                            Swal.fire({
                                icon: 'info',
                                title: 'Pembayaran Pending',
                                text: 'Silakan selesaikan pembayaran Anda.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        },
                        onError: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: 'Terjadi kesalahan dalam pembayaran.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Checkout Gagal',
                        text: "Tidak ada token pembayaran yang diterima."
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Checkout',
                    text: error.response?.data?.message || "Terjadi kesalahan saat checkout."
                });
            });
        });
    });
</script>
