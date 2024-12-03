<?php
    require "outFun.php";
    $outs = getOuts();
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
                    <th>Num</th>
                    <th>Date</th>
                    <th>Exit quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outs as $out): ?>
                <tr>
                    <td><?php echo $out['num']; ?></td>
                    <td><?php echo $out['date']; ?></td>
                    <td><?php echo $out['exit_quantity']; ?></td>
                    <?php if(validateUser("ADMIN", "SUPER")):?>
                    <td>
                        <a class="btn1" href="?a=edit&num=<?php echo $out['num'];?>">Edit</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>