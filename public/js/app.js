function highlightCurrentPage() {

    var currentPage = window.location.pathname;
    var links = document.querySelectorAll('aside a');

    links.forEach(function(link) {
        if (link.getAttribute('href') === currentPage) {
            link.innerHTML = `<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>` + link.innerHTML;
            link.classList.add('text-gray-800');
        }
    });
}
document.addEventListener('DOMContentLoaded', highlightCurrentPage);

$(document).ready(function() {
    $('.client-select').select2({
        placeholder: "Pasirinkite klientą",
        allowClear: true
    });
});

$(document).ready(function() {
    $('.vehicle-select').select2({
        placeholder: "Pasirinkite automobilį",
        allowClear: true,
    });
});

