<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <title>DevTunes - @yield('title') </title>

        <style>
            .action-column {
                width: 150px;
            }

            .offline-column {
                width: 150px;
            }
        </style>

        @yield('custom-css')
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="/home">DevTunes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/playlist">Playlist</a>
                        </li>

                        @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/playlist">Dashboard</a>
                        </li>

                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        <footer>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
                integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
                crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

            <script>
                $(document).ready(function() {
                var currentPath = window.location.pathname;

                $('.navbar-nav .nav-link').each(function() {
                    var linkPath = $(this).attr('href');
                    linkPath = linkPath.replace(/^.*\/\/[^\/]+/, '');

                    if (currentPath.startsWith(linkPath)) {
                        $(this).addClass('active');
                    }
                });
            });
            </script>

            @yield('custom-js')

        </footer>
    </body>

</html>
