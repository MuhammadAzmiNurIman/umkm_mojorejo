<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Pasar Rakyat Mojorejo')</title>

  <!--favicon-->
  <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>


  <!-- custom css link -->
  <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/home.css') }}">

  @yield('styles')

  <!-- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body id="top">

    @include('user.components.navbar')

    @include('user.components.aside')

    <main>
        @yield('content')
    </main>

    @include('user.components.footer')

    <!-- custom js link-->
    <script src="{{ asset('js/user/script.js') }}"></script>

    <!-- ionicon link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    @yield('scripts')

</body>
</html>
