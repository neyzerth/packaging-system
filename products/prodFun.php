<?php
function getProducts(){
    $db = connectdb();
    $query = "SELECT code, name, description,". 
        "height, width, length, weight, packaging_protocol".
        " FROM product;";

        //echo $query;
    return $result = mysqli_query($db, $query);
}