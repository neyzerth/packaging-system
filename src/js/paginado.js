
const SVG = "/src/svg/";

document.addEventListener('DOMContentLoaded', function () {
    const rowsPerPage = 10; 
    const table = document.querySelector('table');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const footer = document.querySelector('.footer');
    const searchInput = document.querySelector('.search');

    let filteredRows = rows; 
    let currentPage = 1;

    function renderTable() {
    
        rows.forEach((row) => {
            row.style.display = 'none';
        });

    
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.slice(start, end).forEach((row) => {
            row.style.display = '';
        });

        
        updateFooter();
    }

    function updateFooter() {
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage); 

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

        if (filterText === '') {
            filteredRows = rows;
        } else {
            filteredRows = rows.filter((row) => {
                const cells = Array.from(row.getElementsByTagName('td'));
                return cells.some((cell) =>
                    cell.textContent.toLowerCase().includes(filterText)
                );
            });
        }

    
        currentPage = 1;
        renderTable();
    });

    
    if (rows.length > 0) {
        renderTable();
    } else {
        footer.innerHTML = '<p>No data available</p>';
    }
});
