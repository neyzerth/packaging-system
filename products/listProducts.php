<?php
    require_once "prodFun.php";
    $products = getProducts();
?>
<body style="display: flex; flex-direction: column;">
    <div class="table">
        <?php 
        include HEADER 
        ?>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Protocol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                <tr>
                    <td><?php echo $product['code'] ?></td>
                    <td><?php echo $product['name'] ?></td>
                    <td><?php echo $product['description'] ?></td>
                    <td><?php echo $product['weight'] ?></td>
                    <td><?php echo $product['height'] ?></td>
                    <td><?php echo $product['width'] ?></td>
                    <td><?php echo $product['length'] ?></td>
                    <td><?php echo $product['packaging_protocol'] ?></td>
                    <?php if(validateUser("ADMIN", "SUPER") && $action != 'addProduct'):?>
                    <td>
                        <a class="btn1" href="?a=edit&code=<?php echo $product['code']; ?>">Edit</a>
                    </td>
                    <?php endif;?>
                    <?php if($action == 'addProduct'):?>
                    <td>
                        <a class="btn1" href="?product=<?php echo $product['code']; ?>">Select</a>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>