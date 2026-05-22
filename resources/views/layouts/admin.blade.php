<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('styles')
     <!-- Load Bootstrap setelah jQuery -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">

    <title>@yield('title')</title>
</head>
<body>

    @include('admin.components.sidebar')

    <!-- CONTENT -->
    <section id="content">
        @include('admin.components.navbar')

        <main>
            @yield('content')
        </main>
    </section>

    <script src="{{ asset('js/admin/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
