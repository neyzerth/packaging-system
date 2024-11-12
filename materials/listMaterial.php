<?php
    require_once("../config.php");
    require "materialFun.php";
    $materials = getMaterial();
?>
<main class="tables">
    <table class="table">
        <colgroup>
            <col width="">
            <col width="">
            <col width="">
            <col width="">
        </colgroup>
        <thead>
            <tr>
                <th>
                    <span>Code</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Name</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Description</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Actual Quantity</span>
                    <span class="column-order"></span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $material): ?>
            <tr>
                <td><?php echo $material['code']; ?></td>
                <td><?php echo $material['material_name']; ?></td>
                <td><?php echo $material['description']; ?></td>
                <td><?php echo $material['available_quantity'].$material['unit_of_measure']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <span>Code</span>
                </th>
                <th>
                    <span>Name</span>
                </th>
                <th>
                    <span>Description</span>
                </th>
                <th>
                    <span>Actual Quantity</span>
                </th>
            </tr>
        </tfoot>
    </table>
</main>