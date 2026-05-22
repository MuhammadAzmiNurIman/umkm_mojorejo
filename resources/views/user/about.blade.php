@extends('layouts.user')

@section('styles')
<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
<style>
.about-page {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: #f5f5f5;
}

.about-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px;
    max-width: 800px;
    margin: auto;
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-top: 50px;
    margin-bottom: 15rem;
}

.img img {
    width: 150px;
    height: auto;
    margin-bottom: 20px;
}

.about-content h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.about-content p {
    font-size: 16px;
    color: #666;
    line-height: 1.6;
    padding: 0 20px;
    text-align: left;
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




</style>
@endsection

@section('title', 'Tentang Kami')

@section('content')
<body class="about-page">
    <img class="wave" src="{{ asset('images/wave.png') }}">
    <img class="wave-right" src="{{ asset('images/wave.png') }}">
    <div class="about-container">
        <div class="img">
            <img src="{{ asset('images/hero-banner.png') }}" alt="Kuliner Rakyat Mojorejo">
        </div>
        <div class="about-content">
            <h2>Kuliner Rakyat Mojorejo</h2>
            <p>
                Kuliner Rakyat Mojorejo merupakan sebuah destinasi kuliner yang menghadirkan berbagai macam hidangan khas dari berbagai penjuru Nusantara, dengan cita rasa autentik yang diracik secara khusus oleh para ahli kuliner berbakat, menggunakan bahan-bahan berkualitas tinggi yang tetap mempertahankan keaslian rasa tradisional, sehingga setiap pelanggan dapat menikmati pengalaman kuliner yang tidak hanya menggugah selera tetapi juga memberikan kepuasan maksimal dalam setiap suapan, ditambah dengan harga yang terjangkau serta suasana yang hangat dan ramah, menjadikan tempat ini pilihan yang tepat bagi siapa saja yang ingin menikmati kelezatan masakan Indonesia dalam suasana yang nyaman dan penuh kebersamaan, baik untuk bersantap sendiri, bersama keluarga, maupun berkumpul dengan teman-teman, karena kami berkomitmen untuk selalu menyajikan hidangan terbaik yang tidak hanya memanjakan lidah tetapi juga menghadirkan kebahagiaan dalam setiap momen bersantap Anda.
            </p>
        </div>
    </div>
</body>
@endsection
