<?php
    require_once("../../../config.php");
    require "zoneFun.php";
    $zones = getZones();
?>
    <main class="tables">
        <div class="background">
            <?php 
            $link="?a=add";
            include HEADER;
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span>Code</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Area</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Available capacity</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Total capacity</span>
                            <span class="column-order"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($zones as $zone): ?>
                    <tr>
                        <td><?php echo $zone['code']; ?></td>
                        <td><?php echo $zone['area']; ?></td>
                        <td><?php echo $zone['available_capacity']; ?></td>
                        <td><?php echo $zone['total_capacity']; ?></td>
                        <td>
                            <a href="?a=edit&code=<?php echo $zone['code'];?>">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            <span>Code</span>
                        </th>
                        <th>
                            <span>Area</span>
                        </th>
                        <th>
                            <span>Available capacity</span>
                        </th>
                        <th>
                            <span>Total capacity</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
            