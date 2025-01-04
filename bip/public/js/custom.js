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
        var kontrastEnabled = false;
        var kontrast1Enabled = false;
        var kontrast2Enabled = false;
        var kontrast3Enabled = false;
        var kontrast4Enabled = false;

        function resetStyles() {
            document.documentElement.style.filter = 'none';
            document.documentElement.style.backgroundColor = '';
            document.body.style.color = '';
            document.getElementById('ins-logo').style.display = 'block';
            document.getElementById('bip-logo').style.display = 'block';
        
            const elements = document.querySelectorAll('*:not(.accessibility-controls):not(.accessibility-controls *)');
            elements.forEach(function (element) {
                element.style.backgroundColor = '';
                element.style.borderColor = '';
                element.style.color = '';
                element.classList.remove('kontrast-hover');
            });
        
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                sidebar.style.setProperty('--before-color', 'red');
            }
        
            // Wyłącz wszystkie motywy
            daltonisciEnabled = false;
            kontrastEnabled = false;
            kontrast1Enabled = false;
            kontrast2Enabled = false;
            kontrast3Enabled = false;
            kontrast4Enabled = false;
        }

        function changeThemeGray() {
            // Resetujemy style
            resetStyles();
            
            // Ustawiamy filtr szarości
            document.documentElement.style.filter = 'grayscale(100%)';
            
            
            // Przywracamy obrazki logo
            document.getElementById('ins-logo').style.display = 'block';
            document.getElementById('bip-logo').style.display = 'block';
            
            // Ustawiamy flagę
            daltonisciEnabled = true;
        }


function changeThemeYellowBlack() {
    if (!kontrastEnabled) {
        document.documentElement.style.filter = 'none';
        document.documentElement.style.backgroundColor = 'black';
        document.body.style.color = 'yellow';
        document.getElementById('ins-logo').style.display = 'none' ;
        document.getElementById('bip-logo').style.display = 'none' ;
        const stylesheet = document.styleSheets[0];
    

        const elements = document.querySelectorAll('*:not(.accessibility-controls):not(.accessibility-controls *)');
        elements.forEach(function(element) {
            element.style.backgroundColor = 'black';
            element.style.borderColor = 'yellow';
            element.style.color = 'yellow';
        });
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.setProperty('--before-color', 'yellow');

        document.getElementById('yellow-black-btn').addEventListener('DOMNodeInserted', changeTextColor);
        
        kontrastEnabled = true;
    } 
    else {
        resetStyles();
    }
}



function changeThemeBlackYellow() {
    if (!kontrast1Enabled) {
        document.documentElement.style.filter = 'none';
        document.documentElement.style.backgroundColor = 'yellow';
        document.body.style.color = 'black';
        document.getElementById('ins-logo').style.display = 'none' ;
        document.getElementById('bip-logo').style.display = 'none' ;
        const stylesheet = document.styleSheets[0];
    

        const elements = document.querySelectorAll('*:not(.accessibility-controls):not(.accessibility-controls *)');
        elements.forEach(function(element) {
            element.style.backgroundColor = 'yellow';
            element.style.borderColor = 'black';
            element.style.color = 'black';
        });
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.setProperty('--before-color', 'black');

        document.getElementById('black-yellow-btn').addEventListener('DOMNodeInserted', changeTextColor);
        
        kontrast1Enabled = true;
    } 
    else {
        resetStyles();
    }
}

var kontrast2Enabled = false;

function changeThemeWhiteBlack() {
    if (!kontrast2Enabled) {
        document.documentElement.style.filter = 'none';
        document.documentElement.style.backgroundColor = 'white';
        document.body.style.color = 'black';
        document.getElementById('ins-logo').style.display = 'none' ;
        document.getElementById('bip-logo').style.display = 'none' ;
        const stylesheet = document.styleSheets[0];
    

        const elements = document.querySelectorAll('*:not(.accessibility-controls):not(.accessibility-controls *)');
        elements.forEach(function(element) {
            element.style.backgroundColor = 'white';
            element.style.borderColor = 'black';
            element.style.color = 'black';
        });
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.setProperty('--before-color', 'black');

        document.getElementById('black-yellow-btn').addEventListener('DOMNodeInserted', changeTextColor);
        
        kontrast2Enabled = true;
    } 
    else {
        resetStyles();
    }
}



function changeThemeBlackWhite() {
    if (!kontrast3Enabled) {
        document.documentElement.style.filter = 'none';
        document.documentElement.style.backgroundColor = 'black';
        document.body.style.color = 'white';
        document.getElementById('ins-logo').style.display = 'none' ;
        document.getElementById('bip-logo').style.display = 'none' ;
        const stylesheet = document.styleSheets[0];
    

        const elements = document.querySelectorAll('*:not(.accessibility-controls):not(.accessibility-controls *)');
        elements.forEach(function(element) {
            element.style.backgroundColor = 'black';
            element.style.borderColor = 'white';
            element.style.color = 'white';
        });
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.setProperty('--before-color', 'white');

        document.getElementById('black-yellow-btn').addEventListener('DOMNodeInserted', changeTextColor);
        
        kontrast3Enabled = true;
    } 
    else {
        resetStyles();
    }
}



function changeThemeNormal() {
    if (!kontrast4Enabled) {
        resetStyles();
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