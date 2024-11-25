<?php

require_once __DIR__."/../../../products/prodFun.php";
require_once __DIR__."/../../../boxes/boxFun.php";
require_once __DIR__."/../../../protocols/tag/tagFun.php";

function addPackage($product, $quantity, $box){
    $db = connectdb();
    $querypack = "INSERT INTO package (product_quantity, product, box) VALUES ($quantity, '$product', '$box')";

    echo $querypack;
    $result = mysqli_query($db, $querypack);

    if($result){
        return true;
    } else {
        return false;
    }

}
