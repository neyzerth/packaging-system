<?php
    require_once("../config.php");
    require "materialFun.php";

    $materials = getMaterial();
?>
<div>
    <!-- Tabla 1 -->
    <table id="table1">
        <thead>
            <tr>
                <!--<th><input type="checkbox" id="checkboxMaestro1" onclick="toggleAllCheckboxes(this, 'table1')"></th>-->
                <th> </th>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actual Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $material): ?>
            <tr>
                <!--<td><input type="checkbox"></td>-->
                <td onclick="toggleInfo(this)">^</td>
                <td><?php echo $material['code']; ?></td>
                <td><?php echo $material['material_name']; ?></td>
                <td><?php echo $material['description']; ?></td>
                <td><?php echo $material['available_quantity'].$material['unit_of_measure']; ?></td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Fin de la Tabla 1 -->

    
</div>

