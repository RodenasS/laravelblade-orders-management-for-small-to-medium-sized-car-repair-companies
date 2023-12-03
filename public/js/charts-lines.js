const monthsMap = {
    'january': 'Sausis',
    'february': 'Vasaris',
    'march': 'Kovas',
    'april': 'Balandis',
    'may': 'Gegužė',
    'june': 'Birželis',
    'july': 'Liepa',
    'august': 'Rugpjūtis',
    'september': 'Rugsėjis',
    'october': 'Spalis',
    'november': 'Lapkritis',
    'december': 'Gruodis',
};

const lineConfig = {
    type: 'line',
    data: {
        labels: newClientsData.months.map(month => {
            const monthName = month.toLowerCase();
            return monthsMap[monthName] || monthName; // Jei nerandamas, paliekam originalų pavadinimą
        }),
        datasets: [
            {
                label: 'Klientų:',
                backgroundColor: '#0694a2',
                borderColor: '#0694a2',
                data: newClientsData.data,
                fill: false,
            },
        ],
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true,
        },
        scales: {
            x: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                },
            },
            y: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value',
                },
            },
        },
    },
}
const lineCtx = document.getElementById('line');
window.myLine = new Chart(lineCtx, lineConfig);

const orderlineConfig = {
    type: 'line',
    data: {
        labels: newOrdersData.months.map(month => {
            const monthName = month.toLowerCase();
            return monthsMap[monthName] || monthName;
        }),
        datasets: [
            {
                label: 'Užsakymai:',
                backgroundColor: '#0694a2',
                borderColor: '#0694a2',
                data: newOrdersData.data,
                fill: false,
            },
        ],
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true,
        },
        scales: {
            x: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                },
            },
            y: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value',
                },
            },
        },
    },
};

const orderlineCtx = document.getElementById('orderlineConfig');
window.myLine = new Chart(orderlineCtx, orderlineConfig);
