<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biuletyn Informacji Publicznej</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tiny.cloud/1/cnz8bjladd3d6xpxjdsc305h8oukukqwqcdswx4zxds5mp8a/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    
    <x-institution-header />

    <div class="accessibility-bar">
        <div class="container">
            <div class="row align-items-center"> <!-- dodane align-items-center -->
                <div class="col-4"> <!-- zmienione z col-6 na col-4 -->
                    <div class="search-container">
                        <input type="text" 
                            class="form-control search-input" 
                            id="searchInput" 
                            placeholder="Szukaj..."
                            autocomplete="off">
                        <span class="search-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </span>
                    </div>
                    <div id="searchResults" class="search-results"></div>
                </div>
                <div class="col-6 text-center">
                    <div class="accessibility-controls">
                        <button id="gray-btn" class="btn theme-gray" onclick="changeThemeGray()">
                            <i aria-hidden="true" class="fa fa-adjust fa-lg"></i> Skala szarości
                        </button>
                        <button id="white-black-btn" class="btn theme-bw" onclick="changeThemeWhiteBlack()">
                            <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
                        </button>
                        <button id="black-white-btn" class="btn theme-wb" onclick="changeThemeBlackWhite()">
                            <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
                        </button>
                        <button id="yellow-black-btn" class="btn theme-yellow-black" onclick="changeThemeYellowBlack()">
                            <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
                        </button>
                        <button id="black-yellow-btn" class="btn theme-black-yellow" onclick="changeThemeBlackYellow()">
                            <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
                        </button>
                        <button id="normal-theme-btn" class="btn theme-red-white" onclick="changeThemeNormal()">
                            <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
                        </button>
                        <button id = "size-up-btn" class="btn font-size-up" id="font-size-up-btn" onclick="changeFontSizeUp()">
                            <i aria-hidden="true" class="fa fa-font fa-lg"></i>++
                        </button>
                        <button id = "size-down-btn" class="btn font-size-down" id="font-size-down-btn" onclick="changeFontSizeDown()">
                            <i aria-hidden="true" class="fa fa-font fa-lg"></i>--
                        </button>
                        <button id="standard-size-btn" class="btn standard-font" onclick="standardFontSize()">
                            <i aria-hidden="true" class="fa fa-font fa-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="col-2 text-end">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button id="logout-btn" type="submit" class="btn btn-sm btn-danger">
                                Wyloguj
                            </button>
                        </form>
                    @else
                        <a id="login-btn" href="{{ route('login') }}" class="btn btn-sm btn-danger">
                            Zaloguj
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif

    <div class="container mt-4">
        <div class="row">
            <div class="col-3">
                @include('partials.sidebar', ['categories' => \App\Models\Category::with('children')->whereNull('parent_id')->get()])
            </div>
            <div class="col-9">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src ="{{ asset('js/custom.js') }}"></script>
    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="container p-4">
            <div class="row">
                <!-- Sekcja linków -->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Linki</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="https://dziennikustaw.gov.pl" class="text-dark" target="_blank">dziennikustaw.gov.pl</a>
                        </li>
                        <li>
                            <a href="https://monitorpolski.gov.pl" class="text-dark" target="_blank">monitorpolski.gov.pl</a>
                        </li>
                        <li>
                            <a href="https://bip.gov.pl" class="text-dark" target="_blank">bip.gov.pl</a>
                        </li>
                    </ul>
                </div>
                <!-- Sekcja dodatkowych opcji -->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Dodatki</h5>
                    <ul class="list-unstyled">
                        <li>
                            <span class="text-dark">Statystyki</span>
                        </li>
                        <li>
                            <span class="text-dark">RSS</span>
                        </li>
                        <li>
                            <span class="text-dark">Mapa Strony</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3 bg-dark text-light">
            © {{ now()->year }} Biuletyn Informacji Publicznej
        </div>
    </footer>
</body>
</html>