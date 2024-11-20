<?php
    require_once("../config.php");
    require "boxFun.php";
    $boxes = getBoxes();
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
                            <span>Height</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Width</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Length</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Volume</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Weight</span>
                            <span class="column-order"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($boxes as $box): ?>
                    <tr>
                        <td><?php echo $box['num'] ?></td>
                        <td><?php echo $box['height'].'cm' ?></td>
                        <td><?php echo $box['width'].'cm' ?></td>
                        <td><?php echo $box['length'].'cm' ?></td>
                        <td><?php echo $box['volume'].'cm2' ?></td>
                        <td><?php echo $box['weight'].'g' ?></td>
                        <td>
                            <a href="?a=edit&num=<?php echo $box['num'];?>">Edit</a>
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
                            <span>Height</span>
                        </th>
                        <th>
                            <span>Width</span>
                        </th>
                        <th>
                            <span>Length</span>
                        </th>
                        <th>
                            <span>Volume</span>
                        </th>
                        <th>
                            <span>Weight</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <?php include FOOTER ?>
        </div>
    </main>