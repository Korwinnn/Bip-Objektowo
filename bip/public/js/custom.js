        var domyslny_rozmiar = 16;
        var wysoki_kontrast = false;
        var max_rozmiar = domyslny_rozmiar * 2;
        function changeFontSizeUp() {
            var zmiana_na_liczbe = parseFloat(window.getComputedStyle(document.body, null).getPropertyValue('font-size'));
            document.documentElement.style.fontSize = (zmiana_na_liczbe * 1.2) + 'px';
            var nowa_wielkosc = zmiana_na_liczbe * 1.2;
            if(nowa_wielkosc >= max_rozmiar){
                document.getElementById('font-size-up-btn').disabled = true;
            }
            document.getElementById('font-size-down-btn').disabled = false;
        }

        function changeFontSizeDown() {
            var zmiana_na_liczbe = parseFloat(window.getComputedStyle(document.body, null).getPropertyValue('font-size'));
            document.documentElement.style.fontSize = (zmiana_na_liczbe * 0.8) + 'px';
            var nowa_wielkosc_m = zmiana_na_liczbe * 0.8;
            if(nowa_wielkosc_m <= domyslny_rozmiar){
              document.getElementById('font-size-down-btn').disabled = true;
            }

            document.getElementById('font-size-up-btn').disabled = false;
        }

        function standardFontSize() {
            document.documentElement.style.fontSize = domyslny_rozmiar + 'px';
            document.getElementById('font-size-up-btn').disabled = false;
            document.getElementById('font-size-down-btn').disabled = false;
        }

        var daltonisciEnabled = false;
        function changeThemeGray() {
            if (!daltonisciEnabled) {
                document.documentElement.style.filter = 'grayscale(100%)';
                daltonisciEnabled = true;
            } else {
                document.documentElement.style.filter = '';
                daltonisciEnabled = false;
            }
        }

        var kontrastEnabled = false;

function changeThemeYellowBlack() {
    if (!kontrastEnabled) {
        // Aktywacja trybu wysokiego kontrastu
        document.documentElement.style.filter = 'none';
        document.documentElement.style.backgroundColor = 'black';
        document.body.style.color = 'yellow';
        
        var elements = document.querySelectorAll('*');
        elements.forEach(function(element) {
            element.style.backgroundColor = 'black';
            element.style.borderColor = 'yellow';
            element.style.color = 'yellow';
            element.classList.add('kontrast-hover');
        });
        
        document.getElementById('wypisywanie_contentu').style.color = 'yellow';
        document.getElementById('wypisywanie_contentu').addEventListener('DOMNodeInserted', changeTextColor);
        
        kontrastEnabled = true;
    } else {
        // Przywrócenie normalnego wyglądu
        document.documentElement.style.filter = '';
        document.documentElement.style.backgroundColor = '';
        document.body.style.color = '';
        
        var elements = document.querySelectorAll('*');
        elements.forEach(function(element) {
            element.style.backgroundColor = '';
            element.style.borderColor = '';
            element.style.color = '';
            element.classList.remove('kontrast-hover');
        });
        
        document.getElementById('wypisywanie_contentu').style.color = '';
        document.getElementById('wypisywanie_contentu').removeEventListener('DOMNodeInserted', changeTextColor);
        
        kontrastEnabled = false;
    }
}

function changeTextColor(event) {
    if (kontrastEnabled) {
        var target = event.target;
        target.style.color = 'yellow';
    }
}
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

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

        // Zamykanie wyników przy kliknięciu poza wyszukiwarką
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });