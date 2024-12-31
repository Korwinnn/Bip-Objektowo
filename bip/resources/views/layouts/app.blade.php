<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biuletyn Informacji Publicznej</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-3">
                    <img src="/images/logo-instytucji.png" alt="Logo instytucji" class="img-fluid">
                </div>
                <div class="col-6 text-left">
                    <h1 id = "tytul_strony">Biuletyn Informacji Publicznej</h1>
                    <h2 id = "nazwa_instytucji">PJ Agency</h2>
                </div>
                <div class="col-3 text-end">
                    <img src="/images/logo-bip.png" alt="Logo BIP" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

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
                <div class="col-6 text-center"> <!-- zmienione pozycjonowanie -->
                    <button class="btn btn-sm btn-secondary" id="font-size-up-btn" onclick="changeFontSizeUp()">A++</button>
                    <button class="btn btn-sm btn-secondary" id="font-size-down-btn" onclick="changeFontSizeDown()">A--</button>
                    <button class="btn btn-sm btn-secondary" onclick="standardFontSize()">A</button>
                    <button class="btn btn-sm btn-secondary" onclick="changeThemeGray()">Szary</button>
                    <button class="btn btn-sm btn-secondary" onclick="changeThemeYellowBlack()">Kontrast</button>
                </div>
                <div class="col-2 text-end"> <!-- dodana nowa kolumna -->
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary" id="login-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        Zaloguj
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-3">
                @include('partials.sidebar')
            </div>
            <div class="col-9">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src ="{{ asset('js/custom.js') }}"></script>
</body>
</html>