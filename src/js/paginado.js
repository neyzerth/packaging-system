
const SVG = "/src/svg/";

document.addEventListener('DOMContentLoaded', function () {
    const rowsPerPage = 9; // Cantidad de filas por página
    const table = document.querySelector('table');
    const rows = Array.from(table.querySelectorAll('tbody tr')); // Todas las filas originales
    const footer = document.querySelector('.footer');
    const searchInput = document.querySelector('.search');

    let filteredRows = rows; // Inicialmente todas las filas están visibles
    let currentPage = 1;

    function renderTable() {
        // Ocultar todas las filas
        rows.forEach((row) => {
            row.style.display = 'none';
        });

        // Calcular el rango de filas visibles
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        // Mostrar las filas del rango correspondiente
        filteredRows.slice(start, end).forEach((row) => {
            row.style.display = '';
        });

        // Actualizar el pie de paginación
        updateFooter();
    }

    function updateFooter() {
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage); // Total de páginas según las filas filtradas

        footer.innerHTML = `
            <ul>
                <li>
                    <a href="#" class="prev ${currentPage === 1 ? 'disabled' : ''}">
                        <img class="bi" src="${SVG}chevron-left.svg" alt="Previous">
                    </a>
                </li>
                <li>
                    <span>${currentPage} of ${totalPages}</span>
                </li>
                <li>
                    <a href="#" class="next ${currentPage === totalPages ? 'disabled' : ''}">
                        <img class="bi" src="${SVG}chevron-right.svg" alt="Next">
                    </a>
                </li>
            </ul>
        `;

        attachPaginationEvents();
    }

    function attachPaginationEvents() {
        const prevButton = footer.querySelector('.prev');
        const nextButton = footer.querySelector('.next');

        if (prevButton) {
            prevButton.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', (e) => {
                e.preventDefault();
                const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
        }
    }

    searchInput.addEventListener('input', () => {
        const filterText = searchInput.value.toLowerCase();

        if (filterText.trim() === '') {
            // Restaurar filas originales al limpiar el buscador
            filteredRows = rows;
        } else {
            // Filtrar las filas según el texto de búsqueda
            filteredRows = rows.filter((row) => {
                const cells = Array.from(row.getElementsByTagName('td'));
                return cells.some((cell) =>
                    cell.textContent.toLowerCase().includes(filterText)
                );
            });
        }

        // Reiniciar a la primera página y volver a renderizar
        currentPage = 1;
        renderTable();
    });

    // Renderizar la tabla inicialmente
    if (rows.length > 0) {
        renderTable();
    } else {
        footer.innerHTML = '<p>No data available</p>';
    }
});
