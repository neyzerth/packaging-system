<?php
    require_once("../config.php");
    require "materialFun.php";
    $materials = getMaterial();
?>
    <main class="tables">
        <div class="background">
        <?php $link="addMaterial.php"; include HEADER; ?>
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
                            <span>Edit material</span>
                            <span class="column-order"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materials as $material): ?>
                    <tr>
                        <td><?php echo $material['code']; ?></td>
                        <td><?php echo $material['name']; ?></td>
                        <td><?php echo $material['description']; ?></td>
                        <td><?php echo $material['available_quantity'].$material['unit_of_measure']; ?></td>
                        <td>
                            <a href="editMaterial.php?code=<?php echo $material['code']; ?>">Edit</a>
                            <a href="disableMaterial.php?code=<?php echo $material['code']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar este material?');">Disable</a>
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
            <?php include FOOTER ?>
        </div>
    </main>