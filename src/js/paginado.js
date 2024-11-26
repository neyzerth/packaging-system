
document.addEventListener('DOMContentLoaded', function () {
    const rowsPerPage = 2; 
    const table = document.querySelector('table'); 
    const rows = table.querySelectorAll('tbody tr');
    const footer = document.querySelector('.footer'); 
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    let currentPage = 1;

    
    function renderTable() {
    
        rows.forEach((row) => {
            row.style.display = 'none';
        });

    
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = '';
            }
        });

        updateFooter();
    }


    function updateFooter() {
        footer.innerHTML = `
            <ul>
                <li>
                    <a href="#" class="prev ${currentPage === 1 ? 'disabled' : ''}">
                        <img src="<?php echo SVG . 'chevron-left.svg'; ?>">
                    </a>
                </li>
                <li>
                    <span>Page ${currentPage} of ${totalPages}</span>
                </li>
                <li>
                    <a href="#" class="next ${currentPage === totalPages ? 'disabled' : ''}">
                        <img src="<?php echo SVG . 'chevron-right.svg'; ?>">
                    </a>
                </li>
            </ul>
        `;


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
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
        }
    }

    if (rows.length > 0) {
        renderTable();
    } else {
        footer.innerHTML = '<p>No data available</p>';
    }
});

