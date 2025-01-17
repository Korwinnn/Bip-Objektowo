document.addEventListener('DOMContentLoaded', function() {
    const categoryList = document.getElementById('sortable-categories');
    
    if (categoryList) {
        // Inicjalizacja dla głównych kategorii
        new Sortable(categoryList, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            group: 'nested',
            filter: '.list-group, hr', // Ignoruj elementy, które nie powinny być sortowalne
            onEnd: function(evt) {
                const item = evt.item;
                
                // Pobierz wszystkie elementy kategorii (bez hr i innych elementów)
                const categoryItems = Array.from(categoryList.children)
                    .filter(el => el.classList.contains('category-item'));
                
                // Znajdź rzeczywisty index elementu wśród kategorii
                const newIndex = categoryItems.indexOf(item);
                
                console.log('Wysyłanie danych dla głównej kategorii:', {
                    categoryId: item.getAttribute('data-id'),
                    newPosition: newIndex,
                    parentId: null
                });

                fetch('/admin/categories/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        categoryId: item.getAttribute('data-id'),
                        newPosition: newIndex,
                        parentId: null
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('✅ Kolejność głównej kategorii zaktualizowana pomyślnie');
                    } else {
                        console.error('❌ Błąd podczas aktualizacji głównej kategorii:', data.error);
                    }
                })
                .catch(error => {
                    console.error('❌ Błąd podczas wysyłania żądania dla głównej kategorii:', error);
                });
            }
        });

        // Inicjalizacja dla podkategorii (bez zmian)
        document.querySelectorAll('.subcategory-list').forEach(list => {
            new Sortable(list, {
                handle: '.drag-handle',
                animation: 150,
                group: 'nested',
                ghostClass: 'sortable-ghost',
                dragClass: 'sortable-drag',
                filter: 'hr',
                onEnd: function(evt) {
                    const item = evt.item;
                    const parentList = evt.to;
                    const categoryItems = Array.from(parentList.children)
                        .filter(el => el.classList.contains('subcategory-item'));
                    const newIndex = categoryItems.indexOf(item);
                    const parentId = parentList.getAttribute('data-parent');

                    console.log('Wysyłanie danych dla podkategorii:', {
                        categoryId: item.getAttribute('data-id'),
                        newPosition: newIndex,
                        parentId: parentId
                    });

                    fetch('/admin/categories/reorder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            categoryId: item.getAttribute('data-id'),
                            newPosition: newIndex,
                            parentId: parentId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('✅ Kolejność podkategorii zaktualizowana pomyślnie');
                        } else {
                            console.error('❌ Błąd podczas aktualizacji podkategorii:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('❌ Błąd podczas wysyłania żądania dla podkategorii:', error);
                    });
                }
            });
        });
    }
});