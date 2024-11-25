<?php
    require_once("../config.php");
    require "materialFun.php";
    $materials = getMaterial();
?>
    <main class="tables">
        <div class="background">
        <?php include HEADER; ?>
        <h1>Materials</h1>
            <table class="table">
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
                        <th>
                            <span>Unit Measure</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materials as $material): ?>
                    <tr>
                        <td><?php echo $material['code']; ?></td>
                        <td><?php echo $material['name']; ?></td>
                        <td><?php echo $material['description']; ?></td>
                        <td><?php echo $material['available_quantity']; ?></td>
                        <td><?php echo $material['unit_of_measure']; ?></td>
                        <?php if(validateUser("ADMIN", "SUPER")):?>
                        <td>
                            <a href="?a=edit&code=<?php echo $material['code']; ?>" class="btn">Edit</a>
                        </td>
                        <?php endif;?>
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
            