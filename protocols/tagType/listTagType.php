<?php
    require_once "../../config.php";
    require "tagTypeFun.php";
    $tagTypes = getTagTypes();
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
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tagTypes as $tagType): ?>
                <tr>
                    <td><?php echo $tagType['code']; ?></td>
                    <td><?php echo $tagType['description']; ?></td>
                    <?php if(validateUser("ADMIN")):?>
                    <td>
                        <a class="btn1" href="?a=edit&code=<?php echo $tagType['code'];?>">Edit</a>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>