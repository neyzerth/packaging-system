<?php
    require_once "../../config.php";
    require "tagFun.php";
    $tags = getTags();
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
                        <th>Date</th>
                        <th>Barcode</th>
                        <th>Tag type</th>
                        <th>Destination</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tags as $tag): ?>
                    <tr>
                        <td><?php echo $tag['date']; ?></td>
                        <td><?php echo $tag['barcode']; ?></td>
                        <td><?php echo $tag['tag_type']; ?></td>
                        <td><?php echo $tag['destination']; ?></td>
                        <?php if(validateUser("ADMIN")):?>
                        <td>
                            <a class="btn1" href="?a=edit&num=<?php echo $tag['num'];?>">Edit</a>
                        </td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php include FOOTER ?>
        </div>