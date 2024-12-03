<?php
    require_once "reportFun.php";
    $reports = getReports();
?>
<body style="display: flex; flex-direction: column;">
    <div class="table">
        <?php 
        include HEADER 
        ?>
        <table>
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Report date</th>
                    <th>Packed products</th>
                    <th>Observations</th>
                    <th>Traceability</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reports as $report): ?>
                <tr>
                    <td><?php echo $report['folio'] ?></td>
                    <td><?php echo $report['start_date'] ?></td>
                    <td><?php echo $report['end_date'] ?></td>
                    <td><?php echo $report['report_date'] ?></td>
                    <td><?php echo $report['packed_products'] ?></td>
                    <td><?php echo $report['observations'] ?></td>
                    <td><?php echo $report['traceability'] ?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>