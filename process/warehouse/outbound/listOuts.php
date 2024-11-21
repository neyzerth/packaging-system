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
                        <td>
                            <a href="?a=edit&num=<?php echo $out['num'];?>">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            <span>Num</span>
                        </th>
                        <th>
                            <span>Date</span>
                        </th>
                        <th>
                            <span>Exit quantity</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <?php include FOOTER ?>
        </div>
    </main>