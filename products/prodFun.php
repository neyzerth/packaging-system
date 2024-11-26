<?php
require_once __DIR__ . "/../config.php";
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
    $query = "SELECT * FROM product WHERE active = 1;";

        $result = mysqli_query($db, $query);
        $products = [];
        while($row = mysqli_fetch_assoc($result)){
            $products[] = $row;
            }
            mysqli_close($db);
            return $products;
}

function getProtocols(){
    $db = connectdb();
    $query = "SELECT num, name, file_name".
        " FROM packaging_protocol;";

        //echo $query;
    return $result = mysqli_query($db, $query);
}

function getProductByCode($code) {
    $db = connectdb();
    $query = "SELECT code, name, description, height, width, length, weight, packaging_protocol FROM vw_product_info WHERE code = '$code';";
    $result = mysqli_query($db, $query);
    $product = mysqli_fetch_assoc($result);
    mysqli_close($db);
    return $product;
}

function updateProduct($code, $name, $description, $height, $width, $length, $weight, $active, $packaging_protocol) {
    $db = connectdb();
    $stmt = $db ->prepare("CALL UpdateProduct (?,?,?,?,?,?,?,?,?)");

    if($stmt === false){
        die('Error in query preparation:'.htmlspecialchars($db->error));
    }

    //s->string , i->integer, d->double
    $stmt->bind_param("sssddddii", $code, $name, $description, $height, $width, $length, $weight, $active, $packaging_protocol);
    if ($stmt->execute()){
        $result = true;
    } else {
        $result = false;
    }

    $stmt->close();
    $db->close();

    return $result;
}

function disableProduct($code) {
    $db = connectdb();
    
    $stmt = $db->prepare("CALL dropProduct(?)");
    
    if ($stmt === false) {
        die('Error in query preparation:'. htmlspecialchars($db->error));
    }

    $stmt->bind_param("s", $code);
    
    // Ejecutar el procedimiento
    if ($stmt->execute()) {
        $result = true; 
    } else {
        $result = false; 
    }
    
    $stmt->close();
    $db->close();
    
    return $result; 
}