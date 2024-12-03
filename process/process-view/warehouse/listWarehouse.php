<?php
    require_once("../../config.php");
    require "warehouseFun.php";
    $zones = getZones();
?>
<body style="display: flex; flex-direction: column;">
    <div class="table">
        <?php 
        $link="?a=add";
        include HEADER;
        ?>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Area</th>
                    <th>Available capacity</th>
                    <th>Total capacity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($zones as $zone): ?>
                <tr>
                    <td><?php echo $zone['code']; ?></td>
                    <td><?php echo $zone['area']; ?></td>
                    <td><?php echo $zone['available_capacity']; ?></td>
                    <td><?php echo $zone['total_capacity']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>