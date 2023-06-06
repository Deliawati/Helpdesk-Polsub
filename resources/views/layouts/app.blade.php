<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | Helpdesk Politeknik Negeri Subang</title>
    @vite([])
    <link rel="stylesheet" href="{{ asset('marshmallow/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('marshmallow/vendors/owl.carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('marshmallow/vendors/owl.carousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('marshmallow/vendors/aos/css/aos.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('marshmallow/vendors/jquery-flipster/css/jquery.flipster.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('marshmallow/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('logoPOLSUB2-1.png') }}" />

    <style>
        textarea {
            resize:vertical;
        }

        .navbar {
            width: 100%;
            padding: 0.8rem 0.5rem;
        }

        .form-control {
            padding: 0.7rem;
        }

        .logo {
            width: 70px !important;
        }

        @media screen and (max-width: 768px) {
            .logo {
                width: 37px !important;
            }
        }

        @media screen and (min-width:576px) {
            footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }
        }
    </style>

    @yield('head')

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50" style="background-color: #fafafa;">
    <div id="mobile-menu-overlay"></div>

    <!-- Navbar -->
    @include('partials.pengguna.navbar')

    <div class="page-body-wrapper mb-5">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.pengguna.footer')

    <script src="{{ asset('marshmallow/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('marshmallow/vendors/owl.carousel/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('marshmallow/vendors/aos/js/aos.js') }}"></script>
    {{-- <script src="{{ asset('marshmallow/vendors/jquery-flipster/js/jquery.flipster.min.js') }}"></script> --}}
    <script src="{{ asset('marshmallow/js/template.js') }}"></script>

    @yield('script')
</body>

</html>
