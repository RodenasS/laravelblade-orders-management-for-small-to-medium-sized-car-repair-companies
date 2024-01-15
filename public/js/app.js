function highlightCurrentPage() {
    var currentPage = window.location.pathname;
    var links = document.querySelectorAll('aside a');

    links.forEach(function (link) {
        if (link.getAttribute('href') === currentPage) {
            link.innerHTML = `<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>` + link.innerHTML;
            link.classList.add('text-gray-800', 'dark:text-gray-100');
        }
    });
}

document.addEventListener('DOMContentLoaded', highlightCurrentPage);

$(document).ready(function () {
    $('.client-select').select2({
        placeholder: "Pasirinkite klientą",
        allowClear: true
    });
});

$(document).ready(function () {
    $('.vehicle-select').select2({
        placeholder: "Pasirinkite automobilį",
        allowClear: true,
    });
});

flatpickr("#end_date", {
    enableTime: true,
    dateFormat: "Y-m-d",
    locale: "lt",
});

flatpickr("#start_date", {
    enableTime: true,
    dateFormat: "Y-m-d",
    locale: "lt",
});

document.addEventListener('DOMContentLoaded', function () {
    const flashCard = document.getElementById('flash-card');
    if (flashCard) {
        flashCard.classList.add('appear-transition');

        setTimeout(function () {
            flashCard.classList.remove('opacity-0');
        }, 100);

        setTimeout(function () {
            flashCard.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
            setTimeout(function () {
                flashCard.remove();
            }, 3000);
        }, 3000);
    }
});

// MODALS CLIENT
function openClientModal(clientId) {
    const modal = document.getElementById(`confirmation-modal-${clientId}`);
    const overlay = document.getElementById('modal-overlay');
    if (modal && overlay) {
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
        document.body.classList.add('modal-open');
    }
}

function closeClientModal(clientId) {
    const modal = document.getElementById(`confirmation-modal-${clientId}`);
    const overlay = document.getElementById('modal-overlay');
    if (modal && overlay) {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
        document.body.classList.remove('modal-open');
    }
}

function exitClientModal(clientId) {
    closeClientModal(clientId);
}

const deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const clientId = event.currentTarget.getAttribute('data-client-id');
        openClientModal(clientId);
    });
});

const cancelButtons = document.querySelectorAll('[id^="cancel-button-"]');
cancelButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const clientId = event.currentTarget.getAttribute('id').replace('cancel-button-', '');
        closeClientModal(clientId);
    });
});

const exitButtons = document.querySelectorAll('[id^="modal-close-button-"]');
exitButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const clientId = event.currentTarget.getAttribute('id').replace('modal-close-button-', '');
        exitClientModal(clientId);
    });
});

// MODALS VEHICLE
function openVehicleModal(vehicleId) {
    const modal = document.getElementById(`confirmation-modal-${vehicleId}`);
    const overlay = document.getElementById('modal-overlay');
    if (modal && overlay) {
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
        document.body.classList.add('modal-open');
    }
}

function closeVehicleModal(vehicleId) {
    const modal = document.getElementById(`confirmation-modal-${vehicleId}`);
    const overlay = document.getElementById('modal-overlay');
    if (modal && overlay) {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
        document.body.classList.remove('modal-open');
    }
}

function exitVehicleModal(vehicleId) {
    closeVehicleModal(vehicleId);
}

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button-vehicle');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const vehicleId = event.currentTarget.getAttribute('data-vehicle-id');
            openVehicleModal(vehicleId);
        });
    });

    const cancelButtons = document.querySelectorAll('[id^="cancel-button-vehicle-"]');
    cancelButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const vehicleId = event.currentTarget.getAttribute('id').replace('cancel-button-vehicle-', '');
            closeVehicleModal(vehicleId);
        });
    });

    const exitButtons = document.querySelectorAll('[id^="modal-close-button-vehicle-"]');
    exitButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const vehicleId = event.currentTarget.getAttribute('id').replace('modal-close-button-vehicle-', '');
            exitVehicleModal(vehicleId);
        });
    });
});
// MODALS ORDER
function openOrderModal(orderId) {
    const modal = document.getElementById(`confirmation-modal-order-${orderId}`);
    const overlay = document.getElementById('modal-overlay');
    if (modal && overlay) {
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
        document.body.classList.add('modal-open');
    }
}

function closeOrderModal(orderId) {
    const modal = document.getElementById(`confirmation-modal-order-${orderId}`);
    const overlay = document.getElementById('modal-overlay-order');
    if (modal && overlay) {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
        document.body.classList.remove('modal-open');
    }
}

function exitOrderModal(orderId) {
    closeOrderModal(orderId);
}

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button-order');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const orderId = event.currentTarget.getAttribute('data-order-id');
            openOrderModal(orderId);
        });
    });

    const cancelButtons = document.querySelectorAll('[id^="cancel-button-order-"]');
    cancelButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const orderId = event.currentTarget.getAttribute('id').replace('cancel-button-order-', '');
            closeOrderModal(orderId);
        });
    });

    const exitButtons = document.querySelectorAll('[id^="modal-close-button-order-"]');
    exitButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const orderId = event.currentTarget.getAttribute('id').replace('modal-close-button-order-', '');
            exitOrderModal(orderId);
        });
    });
});
