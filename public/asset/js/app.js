/*
// Graphique des emprunts par mois
const moisData = <?= json_encode($emprunts_par_mois) ?>;
const ctx1 = document.getElementById('loansChart').getContext('2d');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: moisData.map(item => item.mois),
        datasets: [{
            label: 'Nombre d\'emprunts',
            data: moisData.map(item => item.total),
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            borderWidth: 3,
            pointBackgroundColor: '#764ba2',
            pointBorderColor: '#fff',
            pointRadius: 5,
            pointHoverRadius: 7,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                labels: { color: '#fff' }
            }
        },
        scales: {
            y: {
                grid: { color: 'rgba(255,255,255,0.1)' },
                ticks: { color: '#fff' }
            },
            x: {
                grid: { color: 'rgba(255,255,255,0.1)' },
                ticks: { color: '#fff' }
            }
        }
    }
});

// Graphique des catégories
const categorieData = <?= json_encode($livres_par_categorie) ?>;
const ctx2 = document.getElementById('categoryChart').getContext('2d');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: categorieData.map(item => item.nom),
        datasets: [{
            data: categorieData.map(item => item.total),
            backgroundColor: [
                '#667eea', '#764ba2', '#f093fb', '#4facfe', '#43e97b', '#fa709a'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { color: '#fff', font: { size: 11 } }
            }
        }
    }
});

*/