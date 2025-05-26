
// Toggle calendario
document.querySelectorAll('.calendar-day').forEach(day => {
    day.addEventListener('click', function() {
        if (this.classList.contains('empty')) return;
        
        // Rimuovi selezione precedente
        document.querySelectorAll('.calendar-day.selected').forEach(selected => {
            if (!selected.classList.contains('today')) {
                selected.classList.remove('selected');
            }
        });
        
        // Aggiungi selezione corrente
        if (!this.classList.contains('today')) {
            this.classList.add('selected');
        }
    });
});

// Ricerca
if (document.querySelector('.search-input')) {
    document.querySelector('.search-input').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.order-row');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
}

// Hover effects per le card
document.querySelectorAll('.order-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px) scale(1.02)';
        this.style.transition = 'transform 0.2s ease';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});

// Funzioni per gestire gli ordini
function viewOrder(orderId) {
    // Implementa la visualizzazione dettagli ordine
    window.location.href = `view_order.php?id=${orderId}`;
}

function updateOrderStatus(orderId, newStatus) {
    if (confirm(`Vuoi davvero cambiare lo stato dell'ordine #${orderId} a "${newStatus}"?`)) {
        // Implementa l'aggiornamento dello stato
        fetch('ajax/update_order_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                orderId: orderId,
                status: newStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Ricarica la pagina per aggiornare i dati
            } else {
                alert('Errore nell\'aggiornamento dello stato');
            }
        })
        .catch(error => {
            console.error('Errore:', error);
            alert('Errore di connessione');
        });
    }
}

// Filtro per stato ordini
function filterByStatus(status) {
    const rows = document.querySelectorAll('.order-row');
    rows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
