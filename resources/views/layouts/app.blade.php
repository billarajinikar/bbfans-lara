<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Telugu Bigg Boss</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo aligned to the left -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="BBFans.in Logo" class="img-fluid" style="width: 120px;">
        </a>

        <!-- Hamburger menu with custom styling -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <div></div>
            </span>
        </button>

        <!-- Menu items aligned to the right on desktop -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{ url('/blog') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ url('/vote') }}">Vote</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



        
    

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            &copy; {{ date('Y') }} Telugu Bigg Boss
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('#navbarNav');

            toggler.addEventListener('click', function () {
                toggler.classList.toggle('collapsed');
            });
        });
    </script>
    

</body>
</html>
