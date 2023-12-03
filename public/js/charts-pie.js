const pieConfig = {
    type: 'doughnut',
    data: {
        datasets: [
            {
                data: top5BrandModelCounts,
                backgroundColor: ['#003f5c', '#58508d', '#bc5090', '#ff6361', '#ffa600'], // Customize colors as needed
                label: 'Dataset 1',
            },
        ],
        labels: top5BrandModelLabels,
    },
    options: {
        responsive: true,
        cutoutPercentage: 70,
        legend: {
            display: true, // Display the legend
            position: 'right', // Adjust the legend position as needed
        },
    },
}


// Change this to the id of your chart element in HTML
const pieCtx = document.getElementById('pie')
window.myPie = new Chart(pieCtx, pieConfig)

var orderStatusPieConfig = {
    type: 'doughnut',
    data: {
        datasets: [
            {
                data: orderStatusCounts,
                backgroundColor: [
                    '#0694a2', '#ff6361', '#ffa600',
                ],
                label: 'Order Status',
            },
        ],
        labels: orderStatuses,
    },
    options: {
        responsive: true,
        cutoutPercentage: 70,
        legend: {
            display: true,
            position: 'right',
        },
    },
};
const orderStatusPieChart = document.getElementById('orderStatusPieChart');
window.myPie = new Chart(orderStatusPieChart, orderStatusPieConfig);
