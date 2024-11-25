<?php
    require_once "../../config.php";
    require "tagFun.php";
    $tags = getTags();
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
                            <span>Date</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Barcode</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Tag type</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Destination</span>
                            <span class="column-order"></span>
                        </th>
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
                            <a href="?a=edit&num=<?php echo $tag['num'];?>">Edit</a>
                        </td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                        <th>
                            <span>Date</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Barcode</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Tag type</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Destination</span>
                            <span class="column-order"></span>
                        </th>
                    </tr>
                    </tbody>
                </tfoot>
            </table>
            <?php include FOOTER ?>
        </div>
    </main>