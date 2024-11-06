<?php
require_once "prodFun.php";
    $products = getProducts();
?>
<table>
    <thead>
        <tr>
            <th> </th>
            <th>Code</th>
            <th>Product</th>
            <th>Description</th>
            <th>Weight</th>
            <th>Height</th>
            <th>Width</th>
            <th>Length</th>
            <th># Protocol</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($products as $product): ?>
        <tr>
            <td>^</td>
            <td><?php echo $product['code'] ?></td>
            <td><?php echo $product['name'] ?></td>
            <td><?php echo $product['description'] ?></td>
            <td><?php echo $product['weight'] ?></td>
            <td><?php echo $product['height'] ?></td>
            <td><?php echo $product['width'] ?></td>
            <td><?php echo $product['length'] ?></td>
            <td><?php echo $product['packaging_protocol'] ?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>