<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio & BookStore')</title>

    <!-- Memanggil CSS Murni Lokal -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="custom-navbar">
        <div class="nav-container">
            <a href="/" class="logo">MyPortoBook</a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/about">Tentang</a>
                <a href="/contact">Contact</a>
                <a href="/login" class="btn-login">Login</a>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="custom-footer">
        <p>&copy; {{ date('Y') }} Raevan Fadhillah. All rights reserved.</p>
    </footer>

</body>

</html>