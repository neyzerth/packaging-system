<?php
    require_once("../../config.php");
    require "materialFun.php";
    $materials = getMaterial();
?>
<body style="display: flex; flex-direction: column;">
    <div class="table">
        <?php include HEADER; ?>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actual Quantity</th>
                        <th>Unit Measure</th>
                        <th>Actions</th>
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
                            <a class="btn1" href="?a=edit&code=<?php echo $material['code']; ?>" class="btn">Edit</a>
                        </td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php include FOOTER ?>
        </div>
    </div>