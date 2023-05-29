<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('logoPOLSUB2-1.png') }}" class="img-fluid logo"
                alt="Marshmallow"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="mdi mdi-menu"> </i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="d-lg-none d-flex justify-content-between px-4 py-3 align-items-center">
                <img src="{{ asset('marshmallow/images/logo-dark.svg') }}" class="logo-mobile-menu" alt="logo">
                <a href="javascript:;" class="close-menu"><i class="mdi mdi-close"></i></a>
            </div>
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') . '/' }}">Home</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:;" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Info</a>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('kalender-akademik')}}">Kalender Akademik</a>
                            <a class="dropdown-item" href="{{route('layanan-akademik')}}">Layanan Akademik</a>
                            <a class="dropdown-item" href="{{route('peraturan-akademik')}}">Peraturan Akademik</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pertanyaan')}}">Pertanyaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('chatbot')}}">Chatbot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-success" href="{{route('login')}}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
