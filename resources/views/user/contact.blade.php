@extends('layouts.user')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .contact-container {
        position: relative;
        width: 100%;
        min-height: calc(100vh - 80px - 60px);
        padding: 6rem 2rem 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 60px;
    }

    .contact-form-wrapper {
        width: 90%;
        max-width: 900px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .contact-form-section {
        background-color: #1abc9c;
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .contact-info-section {
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-info-title {
        font-size: 2rem;
        color: #1abc9c;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .contact-info-text {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 1.2rem;
    }

    .contact-info-box {
        display: flex;
        align-items: center;
        color: #555;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .contact-icon {
        width: 24px;
        margin-right: 0.8rem;
    }

    .contact-social-media {
        margin-top: 1rem;
    }

    .contact-social-icons a {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        background: linear-gradient(45deg, #1abc9c, #149279);
        color: #fff;
        margin-right: 0.6rem;
        font-size: 1.2rem;
        transition: 0.3s;
    }

    .contact-social-icons a:hover {
        transform: scale(1.1);
    }

    .contact-form {
        width: 100%;
        padding: 2rem;
    }

    .contact-form-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #fff;
    }

    .contact-input-container {
        position: relative;
        margin-bottom: 1.2rem;
    }

    .contact-input {
        width: 100%;
        padding: 0.8rem 1.2rem;
        border: 2px solid #fafafa;
        border-radius: 30px;
        background: none;
        color: #fff;
        font-size: 1.5rem;
        outline: none;
    }

    .contact-input::placeholder {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 500;
    }

    .contact-textarea {
        min-height: 150px;
        resize: none;
    }

    .contact-btn {
        width: 100%;
        padding: 0.8rem 1.4rem;
        border: 2px solid #fafafa;
        background: #fff;
        color: #1abc9c;
        font-size: 1.5rem;
        font-weight: bold;
        border-radius: 30px;
        cursor: pointer;
        transition: 0.3s;
    }

    .contact-btn:hover {
        background: transparent;
        color: #fff;
    }

    .wave {
    position: absolute;
    top: 0;
    left: 15%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 800px;
    height: auto;
    z-index: -1;
}

.wave-right {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    max-width: 400px;
    height: auto;
    z-index: -1;
    transform: rotate(180deg);
}

    @media (max-width: 850px) {
        .contact-form-wrapper {
            grid-template-columns: 1fr;
            max-width: 95%;
        }
    }

    @media (max-width: 480px) {
        .contact-container {
            padding: 2rem;
        }

        .contact-form-wrapper {
            width: 100%;
        }

        .contact-info-title, .contact-form-title {
            font-size: 1.8rem;
        }

        .contact-input {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('title', 'Tentang Kami')

@section('content')
    <img class="wave" src="{{ asset('images/wave.png') }}">
    <img class="wave-right" src="{{ asset('images/wave.png') }}">
    <div class="contact-container">
        <div class="contact-form-wrapper">
            <!-- Contact Information -->
            <div class="contact-info-section">
                <h3 class="contact-info-title">Hubungi Kami</h3>

                <div class="contact-info-box">
                    <img src="{{ asset('images/location.png') }}" class="contact-icon" alt="Location">
                    <p>Kuliner Rakyat Mojorejo, 3HW7+Q7J, Jl. Ir. Soekarno, Mojorejo, Kec. Junrejo, Kota Batu, Jawa Timur</p>
                </div>
                <div class="contact-info-box">
                    <img src="{{ asset('images/email.png') }}" class="contact-icon" alt="Email">
                    <p>kulinerrakyatmojorejo@gmail.com</p>
                </div>
                <div class="contact-info-box">
                    <img src="{{ asset('images/phone.png') }}" class="contact-icon" alt="Phone">
                    <p>081252622284</p>
                </div>

                <div class="contact-social-media">
                    <p style="font-size: 1.4rem; font-weight: bold; margin-bottom:10px">Connect with us:</p>
                    <div class="contact-social-icons">
                        <a href="https://www.instagram.com/kulinerrakyat_mojorejo/#" class="social-link"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="https://kim-mojorejo23.kim.id/" class="social-link"><ion-icon name="globe-outline"></ion-icon></a>
                        <a href="https://www.youtube.com/@mojorejotv" class="social-link"><ion-icon name="logo-youtube"></ion-icon></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-section">
                <h3 class="contact-form-title">Kritik dan Saran</h3>
                @if(session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: "{{ session('success') }}",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        });
                    </script>
                @endif

                <form action="{{ route('contacts.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="contact-input-container">
                        <input type="text" name="name" class="contact-input" placeholder="Your Name" required>
                    </div>
                    <div class="contact-input-container">
                        <input type="email" name="email" class="contact-input" placeholder="Your Email" required>
                    </div>
                    <div class="contact-input-container">
                        <textarea name="message" class="contact-input contact-textarea" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="contact-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
@endsection
