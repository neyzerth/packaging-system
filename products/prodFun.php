<?php
    require_once "../config.php";
function addProduct($code, $name, $description, $height, $width, $length, $weight, $packaging_protocol) {
    $db = connectdb(); 

    $query = "CALL addProduct(".
        "'$code',".
        "'$name',".
        "'$description',".
        "$height,".
        "$width,".
        "$length,".
        "$weight,".
        "$packaging_protocol".
    ");";

    echo "<p>$query</p>"; 

    try {
        return mysqli_query($db, $query);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}




function getProducts(){
    $db = connectdb();
    $query = "SELECT code, name, description,". 
        "height, width, length, weight, packaging_protocol".
        " FROM product;";

        //echo $query;
    return $result = mysqli_query($db, $query);
}