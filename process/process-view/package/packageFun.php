<?php

require_once __DIR__."/../../../products/prodFun.php";
require_once __DIR__."/../../../boxes/boxFun.php";
require_once __DIR__."/../../../protocols/tag/tagFun.php";
//require_once __DIR__."/../../../protocols/tagType/tagTypeFun.php";

function startProccess($product, $quantity, $box, $tag_type, $date){
    $db = connectdb();
    $querypack = "call addPackage($quantity, NULL, '$product', NULL, $box, '$tag_type', '$date')";

    try {
        return mysqli_query($db, $querypack);
    } catch (Exception $e) {
        error_log("Error adding a package: ".$e->getMessage());
        error_log($querypack);
        return false;
    }

}
