<?php
    require_once("../../config.php");
    require "unitFun.php";
    $units = getUnits();
?>
<body style="display: flex; flex-direction: column;">
    <div class="table">
        <?php include HEADER; ?>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($units as $unit): ?>
                    <tr>
                        <td><?php echo $unit['code']; ?></td>
                        <td><?php echo $unit['description']; ?></td>

                        <?php if(validateUser("ADMIN", "SUPER")):?>
                        <td>
                            <a class="btn1 href="?a=edit&code=<?php echo $unit['code']; ?>" class="btn">Edit</a>
                        </td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php include FOOTER ?>
        </div>
    </div>