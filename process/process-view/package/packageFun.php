<?php

require_once __DIR__."/../../../products/prodFun.php";
require_once __DIR__."/../../../boxes/boxFun.php";
require_once __DIR__."/tagFun.php";
require_once __DIR__."/../tracFun.php";
//require_once __DIR__."/../../../protocols/tagType/tagTypeFun.php";

function addPackage($product, $quantity, $box, $tag_type, $date) {
    $db = connectdb();
    $trac_code = $_SESSION['trac'];
    $user = $_SESSION['num'];

    try {
        $stmt = $db->prepare("CALL packing_process(?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            throw new Exception('Error en la preparación de la sentencia: ' . htmlspecialchars($db->error));
        }

        $stmt->bind_param("isissii", $quantity, $product, $box, $tag_type, $date, $trac_code, $user);

        $result = $stmt->execute();
        if ($result === false) {
            throw new Exception('Error al ejecutar la sentencia: ' . htmlspecialchars($stmt->error));
        }

        $stmt->close();
    } catch (Exception $e) {
        error_log("Error adding a package: " . $e->getMessage());
        return false;
    } finally {
        $db->close();
    }

    return $result;
}


function loadInfo(){
    $db = connectdb();

    $query = "SELECT * FROM package WHERE packaging = ".$_SESSION['trac'];
}
