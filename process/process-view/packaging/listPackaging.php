<?php
    require_once("../../config.php");
    require "packagingFun.php";
    $packagings = getPackagings();
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
                    <th>Package quantity</th>
                    <th>Zone</th>
                    <th>Outbound</th>
                    <th>Tag</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packagings as $packaging): ?>
                <tr>
                    <td><?php echo $packaging['code']; ?></td>
                    <td><?php echo $packaging['height']; ?></td>
                    <td><?php echo $packaging['width']; ?></td>
                    <td><?php echo $packaging['length']; ?></td>
                    <td><?php echo $packaging['volume']; ?></td>
                    <td><?php echo $packaging['weight']; ?></td>
                    <td><?php echo $packaging['package_quantity']; ?></td>
                    <td><?php echo $packaging['zone']; ?></td>
                    <td><?php echo $packaging['outbound']; ?></td>
                    <td><?php echo $packaging['tag']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>