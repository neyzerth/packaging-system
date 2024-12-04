<?php
    require_once "reportFun.php";
    $reports = getReports();

    //$search = isset($_GET['search']) ? $_GET['search'] : '';
    //$reports = empty($search) ? getReports() : searchReport($search);
?>
<script>
    async function fetchTableData(viewName) {
        try {
            const response = await fetch(`fetchData.php?view=${viewName}`);
            const data = await response.json();

            // Actualizar encabezados
            const headers = Object.keys(data[0] || {});
            const tableHeaders = document.getElementById('table-headers');
            tableHeaders.innerHTML = headers.map(header => `<th>${header}</th>`).join('');

            const tableRows = document.getElementById('table-rows');
            tableRows.innerHTML = data.map(row => `
                <tr>${headers.map(header => `<td>${row[header]}</td>`).join('')}</tr>
            `).join('');
        } catch (error) {
            console.error('Error fetching table data:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', () => fetchTableData('top_packaged_products'));
</script>

    <main class="tables">
        <div class="background">
            <?php 
            include HEADER 
            ?>
            <h1>Reports</h1>
            <div>
                <label for="view-select">Select View:</label>
                <select id="view-select" onchange="fetchTableData(this.value)">
                    <option value="top_packaged_products">Products Most Packaged</option>
                    <option value="packaging_no_rotation">Packaging No Rotation</option>
                    <option value="top_employees">Top Employees</option>
                </select>
            </div>
            <table class="table">
                <thead id="table-headers">

                </thead>
                <tbody id="table-rows">

                </tbody>
            </table>
            <?php include FOOTER ?>
        </div>
    </main>