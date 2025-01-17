// Stałe
const DEFAULT_FONT_SIZE = 16;
const MAX_FONT_SIZE = DEFAULT_FONT_SIZE * 2;

// Aplikuj zapisane ustawienia przy starcie
document.addEventListener('DOMContentLoaded', function() {
    const savedFontSize = localStorage.getItem('userFontSize');
    if (savedFontSize) {
        document.documentElement.style.fontSize = savedFontSize + 'px';
        updateFontSizeButtons();
    }

    const savedTheme = localStorage.getItem('userTheme');
    if (savedTheme) {
        applyTheme(savedTheme);
    }
});

// Obsługa rozmiaru czcionki
function updateFontSizeButtons() {
    const currentSize = parseFloat(window.getComputedStyle(document.documentElement).fontSize);
    const sizeUpBtn = document.getElementById('size-up-btn');
    const sizeDownBtn = document.getElementById('size-down-btn');
    
    if (sizeUpBtn) {
        sizeUpBtn.disabled = currentSize >= MAX_FONT_SIZE;
        if (currentSize >= MAX_FONT_SIZE) {
            sizeUpBtn.style.setProperty('color', 'currentColor', 'important');
            sizeUpBtn.style.setProperty('opacity', '0.5', 'important');
            sizeUpBtn.style.setProperty('background', 'none', 'important');
        } else {
            sizeUpBtn.style.removeProperty('color');
            sizeUpBtn.style.removeProperty('opacity');
            sizeUpBtn.style.removeProperty('background');
        }
    }
    if (sizeDownBtn) {
        sizeDownBtn.disabled = currentSize <= DEFAULT_FONT_SIZE;
        if (currentSize <= DEFAULT_FONT_SIZE) {
            sizeDownBtn.style.setProperty('color', 'currentColor', 'important');
            sizeDownBtn.style.setProperty('opacity', '0.5', 'important');
            sizeDownBtn.style.setProperty('background', 'none', 'important');
        } else {
            sizeDownBtn.style.removeProperty('color');
            sizeDownBtn.style.removeProperty('opacity');
            sizeDownBtn.style.removeProperty('background');
        }
    }
}   

function changeFontSizeUp() {
    const currentSize = parseFloat(window.getComputedStyle(document.documentElement).fontSize);
    const newSize = currentSize * 1.2;
    
    if (newSize <= MAX_FONT_SIZE) {
        document.documentElement.style.fontSize = newSize + 'px';
        localStorage.setItem('userFontSize', newSize + 'px');
        updateFontSizeButtons();
    }
}

function changeFontSizeDown() {
    const currentSize = parseFloat(window.getComputedStyle(document.documentElement).fontSize);
    const newSize = currentSize * 0.8;
    
    if (newSize >= DEFAULT_FONT_SIZE) {
        document.documentElement.style.fontSize = newSize + 'px';
        localStorage.setItem('userFontSize', newSize + 'px');
        updateFontSizeButtons();
    }
}

function standardFontSize() {
    document.documentElement.style.fontSize = DEFAULT_FONT_SIZE + 'px';
    localStorage.setItem('userFontSize', DEFAULT_FONT_SIZE + 'px');
    updateFontSizeButtons();
}

// Funkcje zmiany kontrastu
function resetStyles() {
    document.documentElement.style.filter = 'none';
    document.documentElement.style.backgroundColor = '';
    document.documentElement.style.color = '';
    
    const insLogo = document.getElementById('ins-logo');
    const bipLogo = document.getElementById('bip-logo');
    if (insLogo) insLogo.style.display = 'block';
    if (bipLogo) bipLogo.style.display = 'block';

    // Reset wszystkich elementów poza kontrolkami dostępności
    const elements = document.querySelectorAll('*:not(.accessibility-controls):not(.accessibility-controls > *)');
    elements.forEach(function(element) {
        // Sprawdź, czy element nie jest wewnątrz .accessibility-controls
        if (!element.closest('.accessibility-controls')) {
            element.style.backgroundColor = '';
            element.style.borderColor = '';
            element.style.color = '';
        }
    });

    // Reset kart
    document.querySelectorAll('.card').forEach(card => {
        card.style.removeProperty('background-color');
        let header = card.querySelector('.card-header');
        if (header) {
            header.style.removeProperty('background-color');
        }
    });

    // Reset elementów bg-light
    document.querySelectorAll('.bg-light').forEach(element => {
        element.style.removeProperty('background-color');
    });

    // Reset linków w stopce
    const footerLinks = document.querySelectorAll('.footer-link');
    footerLinks.forEach(link => {
        link.style.removeProperty('color');
    });

    // Reset tabel
    document.querySelectorAll('table, td, th').forEach(element => {
        element.style.backgroundColor = '';
        element.style.color = '';
        element.style.borderColor = '';
    });

    // Reset paska bocznego
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.style.setProperty('--before-color', 'red');
    }

    localStorage.removeItem('userTheme');
}

function applyTheme(theme) {
    resetStyles();
    
    switch (theme) {
        case 'gray':
            document.documentElement.style.filter = 'grayscale(100%)';
            break;
            
        case 'yellow-black':
            applyContrastMode('black', 'yellow', 'yellow');
            break;
            
        case 'black-yellow':
            applyContrastMode('yellow', 'black', 'black');
            break;
            
        case 'white-black':
            applyContrastMode('white', 'black', 'black');
            break;
            
        case 'black-white':
            applyContrastMode('black', 'white', 'white');
            break;
    }
    
    localStorage.setItem('userTheme', theme);
}

function applyContrastMode(bgColor, textColor, borderColor) {
    const insLogo = document.getElementById('ins-logo');
    const bipLogo = document.getElementById('bip-logo');
    if (insLogo) insLogo.style.display = 'none';
    if (bipLogo) bipLogo.style.display = 'none';

    document.documentElement.style.backgroundColor = bgColor;
    document.documentElement.style.color = textColor;

    // Zastosuj style do wszystkich elementów poza kontrolkami dostępności
    const elements = document.querySelectorAll('*:not(.accessibility-controls):not(.accessibility-controls > *)');
    elements.forEach(function(element) {
        // Sprawdź, czy element nie jest wewnątrz .accessibility-controls
        if (!element.closest('.accessibility-controls')) {
            element.style.backgroundColor = bgColor;
            element.style.borderColor = borderColor;
            element.style.color = textColor;
        }
    });

    // Specjalna obsługa kart (metryka dokumentu i statystyki)
    document.querySelectorAll('.card').forEach(card => {
        card.style.setProperty('background-color', bgColor, 'important');
        let header = card.querySelector('.card-header');
        if (header) {
            header.style.setProperty('background-color', bgColor, 'important');
        }
    });

    // Specjalna obsługa tła elementów z klasą bg-light
    document.querySelectorAll('.bg-light').forEach(element => {
        element.style.setProperty('background-color', bgColor, 'important');
    });

    // Zastosuj style do linków w stopce
    document.querySelectorAll('.footer-link').forEach(link => {
        link.style.setProperty('color', textColor, 'important');
    });

    // Zastosuj style do tabel
    document.querySelectorAll('table, td, th').forEach(element => {
        element.style.setProperty('background-color', bgColor, 'important');
        element.style.setProperty('color', textColor, 'important');
        element.style.setProperty('border-color', borderColor, 'important');
    });

    // Ustaw kolor paska bocznego
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.style.setProperty('--before-color', borderColor);
    }
}

// Funkcje zmiany motywów
function changeThemeGray() {
    const currentTheme = localStorage.getItem('userTheme');
    if (currentTheme === 'gray') {
        resetStyles();
    } else {
        applyTheme('gray');
    }
}

function changeThemeYellowBlack() {
    const currentTheme = localStorage.getItem('userTheme');
    if (currentTheme === 'yellow-black') {
        resetStyles();
    } else {
        applyTheme('yellow-black');
    }
}

function changeThemeBlackYellow() {
    const currentTheme = localStorage.getItem('userTheme');
    if (currentTheme === 'black-yellow') {
        resetStyles();
    } else {
        applyTheme('black-yellow');
    }
}

function changeThemeWhiteBlack() {
    const currentTheme = localStorage.getItem('userTheme');
    if (currentTheme === 'white-black') {
        resetStyles();
    } else {
        applyTheme('white-black');
    }
}

function changeThemeBlackWhite() {
    const currentTheme = localStorage.getItem('userTheme');
    if (currentTheme === 'black-white') {
        resetStyles();
    } else {
        applyTheme('black-white');
    }
}

function changeThemeNormal() {
    resetStyles();
}

// Obsługa wyszukiwarki
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');

if (searchInput && searchResults) {
    searchInput.addEventListener('input', debounce(function(e) {
        const searchTerm = e.target.value.trim();
        
        if (searchTerm.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        fetch(`/search?q=${encodeURIComponent(searchTerm)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    displayResults(data, searchTerm);
                } else {
                    searchResults.innerHTML = '<div class="search-result-item">Brak wyników</div>';
                }
                searchResults.style.display = 'block';
            });
    }, 300));

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });
}

function displayResults(results, searchTerm) {
    searchResults.innerHTML = results.map(result => `
        <div class="search-result-item" onclick="window.location.href='/categories/${result.id}'">
            <strong>${highlightText(result.name, searchTerm)}</strong>
            ${result.content ? `<br><small>${highlightText(truncateText(result.content, 100), searchTerm)}</small>` : ''}
        </div>
    `).join('');
}

function highlightText(text, searchTerm) {
    if (!text) return '';
    const regex = new RegExp(`(${searchTerm})`, 'gi');
    return text.replace(regex, '<span class="highlight">$1</span>');
}

function truncateText(text, length) {
    if (!text) return '';
    return text.length > length ? text.substring(0, length) + '...' : text;
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

document.addEventListener('DOMContentLoaded', function() {
    const cookieConsent = localStorage.getItem('cookieConsent');
    
    if (!cookieConsent) {
        const cookieBar = document.createElement('div');
        cookieBar.innerHTML = `
            <div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; right: 0; background-color: white; border-top: 1px solid #dee2e6; box-shadow: 0 -2px 10px rgba(0,0,0,0.1); z-index: 1000;">
                <div class="container">
                    <div class="row align-items-center py-3">
                        <div class="col-md-9">
                            <p class="mb-0">Ta strona używa plików cookie w celu zapewnienia najlepszej jakości korzystania z naszej witryny. 
                            Korzystając z tej strony, wyrażasz zgodę na używanie przez nas plików cookie zgodnie z naszą polityką prywatności.</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <button id="accept-cookies" class="btn btn-danger">Akceptuję</button>
                            <button id="close-cookie-banner" class="btn btn-link text-secondary">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(cookieBar);
        
        // Obsługa przycisków
        document.getElementById('accept-cookies').addEventListener('click', acceptCookies);
        document.getElementById('close-cookie-banner').addEventListener('click', acceptCookies);
    }
});

function acceptCookies() {
    localStorage.setItem('cookieConsent', 'accepted');
    const banner = document.getElementById('cookie-banner');
    if (banner) {
        banner.style.animation = 'fadeOut 0.3s';
        setTimeout(() => {
            banner.remove();
        }, 300);
    }
}

// Obsługa menu mobilnego
document.addEventListener('DOMContentLoaded', function() {
    // Dodaj przycisk do przełączania menu
    const toggleButton = document.createElement('button');
    toggleButton.className = 'sidebar-toggle d-md-none';
    toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
    document.body.appendChild(toggleButton);

    // Dodaj overlay
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    document.body.appendChild(overlay);

    // Pobierz sidebar
    const sidebar = document.querySelector('.sidebar');

    // Funkcja przełączająca menu
    function toggleSidebar() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
    }

    // Dodaj obsługę kliknięć
    toggleButton.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    // Zamykaj menu po kliknięciu w link
    sidebar.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (sidebar.classList.contains('active')) {
                toggleSidebar();
            }
        });
    });

    // Obsługa gestów dotykowych
    let touchStartX = 0;
    let touchEndX = 0;

    document.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    }, false);

    document.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, false);

    function handleSwipe() {
        const swipeThreshold = 100;
        if (touchEndX - touchStartX > swipeThreshold) {
            // Przesunięcie w prawo - otwórz menu
            if (!sidebar.classList.contains('active')) {
                toggleSidebar();
            }
        } else if (touchStartX - touchEndX > swipeThreshold) {
            // Przesunięcie w lewo - zamknij menu
            if (sidebar.classList.contains('active')) {
                toggleSidebar();
            }
        }
    }
});

// Dostosowanie wykresów do ekranu mobilnego
window.addEventListener('resize', function() {
    if (typeof ApexCharts !== 'undefined') {
        ApexCharts.exec('visitsChart', 'updateOptions', {
            chart: {
                height: window.innerWidth < 768 ? 250 : 300
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const categoryList = document.getElementById('sortable-categories');
    
    if (categoryList) {
        // Dla głównych kategorii
        new Sortable(categoryList, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const item = evt.item;
                const newIndex = Array.from(evt.to.children).indexOf(item);
                const parentList = evt.to;
                const parentId = parentList.getAttribute('data-parent');
                
                fetch('/admin/categories/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        categoryId: item.getAttribute('data-id'),
                        newPosition: newIndex,
                        parentId: parentId || null
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('✅ Kolejność zaktualizowana pomyślnie');
                    } else {
                        console.error('❌ Błąd podczas aktualizacji:', data.error);
                    }
                })
                .catch(error => {
                    console.error('❌ Błąd podczas wysyłania żądania:', error);
                });
            }
        });

        // Dla podkategorii
        document.querySelectorAll('.subcategory-list').forEach(list => {
            new Sortable(list, {
                handle: '.drag-handle',
                animation: 150,
                group: 'nested',
                ghostClass: 'sortable-ghost',
                dragClass: 'sortable-drag',
                onEnd: function(evt) {
                    const item = evt.item;
                    const newIndex = Array.from(evt.to.children).indexOf(item);
                    const parentList = evt.to;
                    const parentId = parentList.getAttribute('data-parent');

                    fetch('/admin/categories/reorder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            categoryId: item.getAttribute('data-id'),
                            newPosition: newIndex,
                            parentId: parentId || null
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('✅ Kolejność zaktualizowana pomyślnie');
                        } else {
                            console.error('❌ Błąd podczas aktualizacji:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('❌ Błąd podczas wysyłania żądania:', error);
                    });
                }
            });
        });
    }
});