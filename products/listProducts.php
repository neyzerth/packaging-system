<?php
    require_once("../config.php");
    require_once "prodFun.php";
    $products = getProducts();
?>
    <main class="tables">
        <div class="background">
            <?php 
            $link = "?a=add";
            include HEADER 
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span>Code</span>    
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Product</span>    
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Description</span>    
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Weight</span>    
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
                            <span>Protocol</span>
                            <span class="column-order"></span>
                        </th>
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
                        <td>
                            <a href="?a=edit&code=<?php echo $product['code']; ?>">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            <span>Code</span>
                        </th>
                        <th>
                            <span>Product</span>
                        </th>
                        <th>
                            <span>Description</span>
                        </th>
                        <th>
                            <span>Weight</span>
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
                            <span>Protocol</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <?php include FOOTER ?>
        </div>
    </main>