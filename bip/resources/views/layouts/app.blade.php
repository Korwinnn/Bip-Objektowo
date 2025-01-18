<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Biuletyn Informacji Publicznej</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script src="https://cdn.tiny.cloud/1/cnz8bjladd3d6xpxjdsc305h8oukukqwqcdswx4zxds5mp8a/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('js/category-sort.js') }}"></script>
</head>
<body>
    
    <x-institution-header />

    <div class="accessibility-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
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
                        <div id="searchResults" class="search-results"></div>
                    </div>
                </div>
                <div class="col-6 text-end">
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

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3 ps-4" style="max-width: 300px;">
                @include('partials.sidebar', ['categories' => \App\Models\Category::mainCategories()])
            </div>
            
            <div class="col-md-7 px-4">
                @yield('content')
            </div>
            
            <div class="col-md-2 pe-4" style="max-width: 250px;">
                <div class="card">
                    <div class="card-header bg-danger text-white py-2">
                        <h6 class="mb-0 text-center">
                            <i class="fas fa-bullhorn me-1"></i>
                            Aktualności
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($announcements ?? [] as $announcement)
                                <div class="list-group-item py-2 px-2">
                                    <h6 class="mb-1 small">{{ Str::limit($announcement->title, 40) }}</h6>
                                    <p class="mb-1 text-muted small">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $announcement->created_at->format('d.m.Y') }}
                                    </p>
                                    <a href="{{ route('announcements.show', $announcement) }}" 
                                    class="btn btn-sm btn-outline-danger w-100 mt-1" style="border-right:1px solid red">
                                        Czytaj więcej
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer p-2 text-center">
                            <a href="{{ route('announcements.index') }}" class="btn btn-sm btn-danger w-100">
                                Wszystkie aktualności
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase footer-header">Linki</h5>
                    <ul class="list-unstyled mb-0 footer-links">
                        <li>
                            <a href="https://dziennikustaw.gov.pl" class="footer-link" target="_blank">
                                <i class="fas fa-file-alt footer-icon"></i>
                                dziennikustaw.gov.pl
                            </a>
                        </li>
                        <li>
                            <a href="https://monitorpolski.gov.pl" class="footer-link" target="_blank">
                                <i class="fas fa-file-alt footer-icon"></i>
                                monitorpolski.gov.pl
                            </a>
                        </li>
                        <li>
                            <a href="https://bip.gov.pl" class="footer-link" target="_blank">
                                <i class="fas fa-external-link-alt footer-icon"></i>
                                bip.gov.pl
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase footer-header">Dodatki</h5>
                    <ul class="list-unstyled footer-links">
                        <li>
                            <a href="{{ route('statistics') }}" class="footer-link">
                                <i class="fas fa-chart-bar footer-icon"></i>
                                Statystyki
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rss.feed') }}" class="footer-link" target="_blank">
                                <i class="fas fa-rss footer-icon"></i>
                                RSS
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sitemap') }}" class="footer-link">
                                <i class="fas fa-sitemap footer-icon"></i>
                                Mapa strony
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            © {{ now()->year }} Biuletyn Informacji Publicznej
        </div>
    </footer>

    <!-- Floating Accessibility Button and Panel -->
    <button id="accessibility-toggle" class="floating-accessibility-btn" aria-expanded="false">
        <i class="fas fa-universal-access"></i>
    </button>

    <div id="accessibility-panel" class="accessibility-panel">
        <div class="accessibility-controls">
            <span accesskey="1" aria-label="włącz skala szarości" title="włącz skalę szarości" 
                style="color: black; background: white; border-right:1px solid black; padding: 4px 8px; white-space: nowrap; flex-shrink: 0;" 
                role="button" class="btn btn-outline" id="changeGray" onclick="changeThemeGray()">
                <i style="color: gray" aria-hidden="true" class="fa fa-adjust fa-lg"></i>
                <span class="hidden-xs hidden-sm">skala szarości</span>
            </span>

            <span accesskey="2" aria-label="wysoki kontrast, czarne litery na białym tle" 
                style="color: black; background: white; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="wysoki kontrast, czarne litery na białym tle" 
                data-contrast-mode="black-on-white" class="btn btn-outline switchContrast black-on-white" 
                onclick="changeThemeWhiteBlack()">
                <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
            </span>

            <span accesskey="3" aria-label="wysoki kontrast, białe litery na czarnym tle" 
                style="color: white; background: black; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="wysoki kontrast, białe litery na czarnym tle" 
                data-contrast-mode="white-on-black" class="btn btn-outline switchContrast white-on-black" 
                onclick="changeThemeBlackWhite()">
                <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
            </span>

            <span accesskey="4" aria-label="wysoki kontrast, czarne litery na białym tle" 
                style="color: black; background: yellow; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="wysoki kontrast, czarne litery na żółtym tle" 
                data-contrast-mode="black-on-yellow" class="btn btn-outline switchContrast black-on-yellow" 
                onclick="changeThemeYellowBlack()">
                <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
            </span>

            <span accesskey="5" aria-label="wysoki kontrast, żółte litery na czarny tle" 
                style="color: yellow; background: black; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="wysoki kontrast, żółte litery na czarnym tle" 
                data-contrast-mode="yellow-on-black" class="btn btn-outline switchContrast yellow-on-black" 
                onclick="changeThemeBlackYellow()">
                <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
            </span>

            <span accesskey="6" aria-label="przywróć domyślne kolory" 
                style="background-color:red; color:white; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="przywróć domyślne kolory" 
                data-contrast-mode="none" class="btn btn-outline offContrast pattern" 
                onclick="changeThemeNormal()">
                <i aria-hidden="true" class="fa fa-adjust fa-lg"></i>
            </span>

            <span accesskey="7" aria-label="zwiększ rozmiar czcionki" 
                style="color: black; background: white; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="zwiększ rozmiar czcionki" 
                class="btn btn-outline upFontSize" onclick="changeFontSizeUp()">
                <i aria-hidden="true" class="fa fa-font fa-lg"></i>++
            </span>

            <span accesskey="8" aria-label="zmniejsz rozmiar czcionki" 
                style="color: black; background: white; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="zmniejsz rozmiar czcionki" 
                class="btn btn-outline downFontSize" onclick="changeFontSizeDown()">
                <i aria-hidden="true" class="fa fa-font fa-lg"></i>--
            </span>

            <span accesskey="9" aria-label="przywróć domyślny rozmiar czcionki" 
                style="color: black; background: white; padding: 4px 8px; flex-shrink: 0;" 
                role="button" title="przywróć domyślny rozmiar czcionki" 
                class="btn btn-outline resetFontSize" onclick="standardFontSize()">
                <i aria-hidden="true" class="fa fa-font fa-lg"></i>
            </span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @stack('scripts')
</body>
</html>