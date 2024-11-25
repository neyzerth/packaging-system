<?php

require_once __DIR__."/../../../products/prodFun.php";
require_once __DIR__."/../../../boxes/boxFun.php";
require_once __DIR__."/../../../protocols/tag/tagFun.php";
//require_once __DIR__."/../../../protocols/tagType/tagTypeFun.php";

function startProccess($product, $quantity, $box, $weight, $tag_type, $date){
    $db = connectdb();
    $querypack = "call addPackage($quantity, $weight, '$product', NULL, $box, '$tag_type', '$date')";

    $result = mysqli_query($db, $querypack);

    if($result){
        return true;
    } else {
        return false;
    }

}
