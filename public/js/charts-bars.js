/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */

const barConfig = {
    type: 'bar',
    data: {
        datasets: [
            {
                data: top3BrandCounts,
                backgroundColor: ['#003f5c', '#58508d', '#bc5090', '#ff6361', '#ffa600'], // Customize colors as needed
                label: 'Dataset 1',
            },
        ],
        labels: top3BrandLabels,
    },
    options: {
        responsive: true,
        cutoutPercentage: 70,
        legend: {
            display: false, // Display the legend
        },
    },
}

const barsCtx = document.getElementById('bars')
window.myBar = new Chart(barsCtx, barConfig)
