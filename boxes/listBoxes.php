<?php
    require_once("../config.php");
    require "boxFun.php";
    $boxes = getBoxes();
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
                    <th>Code</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Volume</th>
                    <th>Weight</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($boxes as $box): ?>
                <tr>
                    <td><?php echo $box['num'] ?></td>
                    <td><?php echo $box['height'].'cm' ?></td>
                    <td><?php echo $box['width'].'cm' ?></td>
                    <td><?php echo $box['length'].'cm' ?></td>
                    <td><?php echo $box['volume'].'cm3' ?></td>
                    <td><?php echo $box['weight'].'g' ?></td>
                    <?php if(validateUser("ADMIN", "SUPER")):?>
                    <td>
                        <a class="btn1" href="?a=edit&num=<?php echo $box['num'];?>">Edit</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>