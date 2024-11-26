<?php
    require "outFun.php";
    $outs = getOuts();
?>
    <main class="tables">
        <div class="background">
            <?php 
            $link="?a=add";
            include HEADER;
            ?>
            <h1>Outbounds</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span>Num</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Date</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Exit quantity</span>
                            <span class="column-order"></span>
                        </th>
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
                            <a class="btn" href="?a=edit&num=<?php echo $out['num'];?>">Edit</a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
            </table>
            <?php include FOOTER ?>
        </div>
    </main>